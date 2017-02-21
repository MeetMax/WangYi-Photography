<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/12/8
 * Time: 15:56
 */

namespace frontend\controllers;
use common\models\Photo;
use common\models\User;
use frontend\models\Comment;
use frontend\models\Follow;
use frontend\models\Like;
use frontend\models\PersonInfo;
use frontend\models\PgyData;
use frontend\models\UploadForm;
use yii;
use common\models\Album;
use yii\web\Controller;

class HomeController extends Controller
{
    public $home_id=0;
    /**
     * 我的主页
     */
    public function actionIndex()
    {
        $this->layout='homeLayout';
        $user_id=Yii::$app->request->get('id');
        $this->home_id=$user_id;
        //设置returnURL
        Yii::$app->user->setReturnUrl(Yii::$app->urlManager->createUrl(['home/index','id'=>$user_id]));
        $user=User::find()->where(['id'=>$user_id])->one();
        if($user_id)
        {
            $exist='';
            if(!Yii::$app->user->isGuest)
            {
                $uploadModel=new UploadForm();
                $uploadModel->clearPhoto();
                $follow_id=Yii::$app->user->getId();
                $byfollow_id=$user_id;
                $exist=Follow::find()->where([
                    'follow_id'=>$follow_id,
                    'byfollow_id'=>$byfollow_id
                ])->exists();
            }
            //获取个人资料信息
            $person=PersonInfo::find()->with('bg_image')->where(['user_id'=>$user_id])->one();
            $album=Album::find()->with('comment')->with('photo.like_bylike')->where(['user_id'=>$user_id])->orderBy(['id'=>SORT_DESC])->all();
            //获取用户摄影资料
            $pgy=PgyData::find()->where(['user_id'=>$user_id])->one();
            //作品数量
            $album_count=Album::find()->where(['user_id'=>$user_id])->count();
            //被关注数量
            $byfollow_count=Follow::find()->where(['byfollow_id'=>$user_id])->count();
            //被喜欢数量
            $bylike_count=Like::find()->where(['bylike_user_id'=>$user_id])->count();
            //总访问量统计
            $visit_total=0;
            foreach ($album as $v)
            {
                $visit_total+=$v->visit_num;
            }
            //获取是否关注信息
            return $this->render('index',[
                'album'=>$album,
                'user'=>$user,
                'person'=>$person,
                'exist'=>$exist,
                'pgy'=>$pgy,
                'album_count'=>$album_count,
                'byfollow_count'=>$byfollow_count,
                'bylike_count'=>$bylike_count,
                'visit_total'=>$visit_total,
            ]);
        }
        else
        {
           return $this->goHome();
        }

    }
    /**
     * AJAX取消展示
     */
    public function actionAjaxRemoveAlbum()
    {
        $token=$this->getToken();
        if(Yii::$app->request->isAjax&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
        {
            $user_id=Yii::$app->user->id;
            $album_id=Yii::$app->request->get('id');
            //删除作品
            $album=Album::find()->where(['id'=>$album_id])->one();
            if($album->user_id==$user_id)
            {
                $album->delete();
                //删除服务器上的照片
                $photo=Photo::find()->where(['album_id'=>$album->id])->all();
                foreach ($photo as $v){
                    //获取文件路径
                    $big_path=Yii::getAlias('@webroot'.$v->big_path);
                    $sm_path=Yii::getAlias('@webroot'.$v->sm_path);
                    //判断文件是否存在
                    if(file_exists($big_path))
                    {
                        unlink($big_path);
                    }
                    if(file_exists($sm_path))
                    {
                        unlink($sm_path);
                    }
                    //照片id数组
                    $photo_id[]=$v->id;
                }
                //删除照片的赞
                Like::deleteAll(['in','photo_id',$photo_id]);
                //直接删除作品下的照片
                Photo::deleteAll(['album_id'=>$album->id]);
                return true;
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

}