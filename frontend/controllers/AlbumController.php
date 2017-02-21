<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/12/8
 * Time: 15:56
 */

namespace frontend\controllers;
use Codeception\Lib\Generator\Helper;
use common\models\Category;
use common\models\Photo;
use common\models\User;
use frontend\models\Comment;
use frontend\models\Follow;
use frontend\models\Like;
use frontend\models\PersonInfo;
use frontend\models\UploadForm;
use phpDocumentor\Reflection\Types\String_;
use yii;
use yii\helpers\Html;
use common\models\Album;
use yii\web\Controller;
use yii\helpers\Json;
use \yii\db\ActiveQuery;

class AlbumController extends Controller
{
    //关闭csrf
    public $enableCsrfValidation = false;
    /**
     * 照片详情页
     */
    public function actionDetails()
    {
        if(Yii::$app->request->isGet)
        {
            //该作品id
            $album_id=Yii::$app->request->get('id');
            //设置returnURL
            Yii::$app->user->setReturnUrl(Yii::$app->urlManager->createUrl(['album/details','id'=>$album_id]));
            //登录用户id
            $user_id=Yii::$app->user->getId();
            //该作品信息
            $album=Album::find()->with('comment')->where(['id'=>$album_id])->one();
            //作品用户信息
            $album_userInfo=PersonInfo::find()->where(['user_id'=>$album->user_id])->one();
            //该作品用户所有的作品
            $albumAll=Album::find()->select(['id','album_name','cover'])->where(['user_id'=>$album->user_id])->orderBy(['id'=>SORT_DESC])->all();
            //该作品所有照片的信息
            $photoInfo=Photo::find()->with('like_bylike')->where(['album_id'=>$album_id])->all();
            //该作品照片的数量
            $photoNum=count($photoInfo);
            //登录用户信息
            $login_userInfo=PersonInfo::find()->where(['user_id'=>$user_id])->one();
            //判断是否关注
            $followExist=false;
            //访问量统计
            $album->visit_num+=1;
            $album->save(false);
            //获取父极分类
            $cat=new Category();
            $parent_id=$cat->getChild($album->cat_id);
            //获取当前分类
            $curName=$cat->getCatName($album->cat_id);
            //获取负极分类
            $parName=$cat->getCatName($parent_id);
            $catArr=[
                'curName'=>$curName,
                'parName'=>$parName
            ];
            //用户登录状态下
            if(!Yii::$app->user->isGuest)
            {
                $follow_id=$user_id;
                $byfollow_id=$album_userInfo->id;
                $followExist=Follow::find()->where([
                    'follow_id'=>$follow_id,
                    'byfollow_id'=>$byfollow_id
                ])->exists();
                $uploadModel=new UploadForm();
                $uploadModel->clearPhoto();
            }
            //判断照片是否已赞
            $likeExist=false;
            $photo_arr=array();
            //用户登录状态下
            if(!Yii::$app->user->isGuest)
            {
                $like_user_id=Yii::$app->user->getId();
                $bylike_user_id=$album_userInfo->id;
                $likeExist=Like::find()->where([
                    'like_user_id'=>$like_user_id,
                    'bylike_user_id'=>$bylike_user_id,
                    'photo_id'=>0
                ])->exists();
                $condition=array();
                foreach ($photoInfo as $k=>$v)
                {
                    $condition[]=$v->id;
                }
                $byLike=Like::find()->where([
                    'and',
                    ['like_user_id'=>$like_user_id, 'bylike_user_id'=>$bylike_user_id],
                    ['in','photo_id',$condition]
                ])->select('photo_id')->all();
               foreach ($byLike as $v)
                {
                    $photo_arr[]=$v->photo_id;
                }
            }
            //被关注数量
            $byfollowNum=Follow::find()->where(['byfollow_id'=>$album->user_id])->count();
            //被喜欢总数量
            $bylikeNum=Like::find()->where(['bylike_user_id'=>$album->user_id])->count();
            //该作品所有评论
            $comment=Comment::find()->joinWith([
                'person_info'=>function(ActiveQuery $query){
                    $query->select(['nickname','user_id','head_img']);
                }
            ])->orderBy(['id'=>SORT_DESC])->where(['album_id'=>$album->id])->all();
            //返回给视图的数据
            $ret=[
                'album_userInfo'=>$album_userInfo,
                'album'=>$album,
                'photoInfo'=>$photoInfo,
                'photoNum'=>$photoNum,
                'login_userInfo'=>$login_userInfo,
                'albumAll'=>$albumAll,
                'followExist'=>$followExist,
                'likeExist'=>$likeExist,
                'photo_arr'=>$photo_arr,
                'byfollowNum'=>$byfollowNum,
                'bylikeNum'=>$bylikeNum,
                'comment'=>$comment,
                'catArr'=>$catArr
            ];
            return $this->render('details',$ret);
        }else
        {
            //若没有传递作品id，返回主页
            return $this->goHome();
        }

    }
    /**
     * AJAX加载照片
     */
    public function actionAjaxLoadPhoto()
    {
        if(Yii::$app->request->isAjax)
        {
            if (Yii::$app->request->isGet)
            {
                $id=Yii::$app->session->get('id');
                $arr=Photo::find()->where(['album_id'=>$id])->orderBy(['id'=>SORT_ASC])->asArray()->all();
                Yii::$app->session->remove('id');
                return Json::encode($arr);
            }
        }
    }

/**
 * AJAX关注
 */
public function actionAjaxFollow()
{
    $token=$this->getToken();
    if($this->isAjax()&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
    {
        if (!Yii::$app->user->isGuest) {
            $follow_id = Yii::$app->user->getId();
            $byfollow_id = Yii::$app->request->get('id');
            $exist = Follow::find()->where([
                'follow_id' => $follow_id,
                'byfollow_id' => $byfollow_id,
            ])->exists();
            if (!$exist) {
                $follow = new Follow();
                $follow->follow_id = $follow_id;
                $follow->byfollow_id = $byfollow_id;
                if ($follow->save()) {
                    return true;
                }
            }
        }
    }
}
/**
 * AJAX取消关注
 */
public function actionAjaxUnfollow()
{
    $token=$this->getToken();
    if($this->isAjax()&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
    {
        $follow_id=Yii::$app->user->getId();
        $byfollow_id=Yii::$app->request->get('id');
        if ($follow_id)
        {
            $exist=Follow::find()->where([
                'follow_id'=>$follow_id,
                'byfollow_id'=>$byfollow_id,
            ])->exists();
            if($exist)
            {
                $follow=Follow::find()->where([
                    'follow_id'=>$follow_id,
                    'byfollow_id'=>$byfollow_id,
                ])->one();
                if ($follow->delete())
                {
                    return true;
                }
            }
        }
    }
}
/**
 * AJAX点赞
 */
public function actionAjaxLike()
{
    $token=$this->getToken();
    if($this->isAjax()&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
    {

        $like_user_id=Yii::$app->user->getId();
        $bylike_user_id=Yii::$app->request->get('id');
        if(!Yii::$app->request->get('photo_id'))
        {
            $exist=Like::find()->where([
                'like_user_id'=>$like_user_id,
                'bylike_user_id'=>$bylike_user_id,
                'photo_id'=>0
            ])->exists();
            if (!$exist)
            {
                $like=new Like();
                $like->like_user_id=$like_user_id;
                $like->bylike_user_id=$bylike_user_id;
                if($like->save())
                {
                    return true;
                }
            }
        }else
        {
            $photo_id=Yii::$app->request->get('photo_id');
            $exist=Like::find()->where([
                'like_user_id'=>$like_user_id,
                'bylike_user_id'=>$bylike_user_id,
                'photo_id'=>$photo_id,
            ])->exists();
            if(!$exist)
            {
                $like=new Like();
                $like->like_user_id=$like_user_id;
                $like->bylike_user_id=$bylike_user_id;
                $like->photo_id=$photo_id;
                if($like->save())
                {
                    return true;
                }
            }
        }
    }
}
/**
 * AJAX取消赞
 */
    public function actionAjaxUnlike()
    {
        $token=$this->getToken();
        if($this->isAjax()&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
        {
            $like_user_id=Yii::$app->user->getId();
            $bylike_user_id=Yii::$app->request->get('id');
            //是否有照片id
            if(!Yii::$app->request->get('photo_id'))
            {
                $exist=Like::find()->where([
                    'like_user_id'=>$like_user_id,
                    'bylike_user_id'=>$bylike_user_id,
                ])->exists();
                if ($exist) {
                    $like = Like::find()->where([
                        'like_user_id' => $like_user_id,
                        'bylike_user_id' => $bylike_user_id,
                    ])->one();
                    //删除点赞
                    if($like->delete())
                    {
                        return true;
                    }
                }

            }else
            {
                $photo_id=Yii::$app->request->get('photo_id');
                $exist=Like::find()->where([
                    'like_user_id'=>$like_user_id,
                    'bylike_user_id'=>$bylike_user_id,
                    'photo_id'=>$photo_id,
                ])->exists();
                if($exist)
                {
                    //找到点赞模型
                    $like=Like::find()->where([
                        'like_user_id'=>$like_user_id,
                        'bylike_user_id'=>$bylike_user_id,
                        'photo_id'=>$photo_id,
                    ])->one();
                    //删除点赞记录
                    if($like->delete())
                    {
                        return true;
                    }
                }
            }
        }
    }
    /**
     * Ajax评论
     */
    public function actionAjaxComment()
    {
        $token=$this->getToken();
        if($this->isAjax()&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
        {
            //开启一个事务
            $transaction=Yii::$app->db->beginTransaction();
            try{
                $comment=new Comment();
                $comment->content=Html::encode(Yii::$app->request->post('content'));
                $comment->album_id=Html::encode(Yii::$app->request->post('album_id'));
                $comment->time=time();
                $comment->user_id=Yii::$app->user->getId();
                if($comment->save())
                {
                    //若save成功，提交事务
                    $transaction->commit();
                    $id=$comment->getPrimaryKey();
                    $data=Comment::find()->with('user.person_info')->where(['id'=>$id])->asArray()->one();
                    $data['hostInfo']=Yii::$app->request->hostInfo;
                    $data['date']=date('Y-m-d H:i',$data['time']);
                    return Json::encode($data);
                }else
                {
                    throw new \Exception('操作失败！');
                }
                //捕捉异常
            }catch (\Exception $e){
                $transaction->rollBack();
                throw $e;
            }

        }
    }
    /**
     * 获取请求TOKEN
     */
    protected function getToken()
    {
        $cookies=Yii::$app->request->cookies;
        return $cookies->getValue('access_token',null);
    }
    /**
     * 获取用户TOKEN
     */
    protected function getUserToken()
    {
        return Yii::$app->user->identity->access_token;
    }
    /**
     * 判断是否登录
     */
    protected function isGuest()
    {
        return !Yii::$app->user->isGuest;
    }
    /**
     * 判断是否是AJAX
     */
    protected function isAjax()
    {
        return Yii::$app->request->isAjax;
    }
}