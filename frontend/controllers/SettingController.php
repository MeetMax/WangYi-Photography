<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/12/8
 * Time: 15:56
 */

namespace frontend\controllers;
use common\models\Album;
use common\models\BgImage;
use common\models\Category;
use common\models\User;
use frontend\models\Follow;
use frontend\models\Like;
use frontend\models\PersonInfo;
use frontend\models\PgyData;
use frontend\models\SetImage;
use frontend\models\UploadForm;
use yii;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\helpers\Json;

class SettingController extends Controller
{
    public $enableCsrfValidation = false;
    public function actionIndex()
    {
        $this->layout='homeLayout';
        $token=$this->getToken();
        if (Yii::$app->request->get('id')&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
        {
            //清除缓存&&删除照片
            $uploadModel=new UploadForm();
            $uploadModel->clearPhoto();
            //获取主页用户id
            $home_user_id=Yii::$app->request->get('id');
            //查询登录用户id
            $user_id=Yii::$app->user->getId();
            //获取个人资料信息
            $person=PersonInfo::find()->with('bg_image')->where(['user_id'=>$home_user_id])->one();
            //获取用户模型
            $user=User::find()->where(['id'=>$home_user_id])->one();
            //查找背景图片
            $bg=BgImage::find()->all();
            //所有照片一级分类
            $allCat=Category::find()->where(['parent_id'=>0])->all();
            //获取用户摄影资料
            $pgy=PgyData::find()->where(['user_id'=>$home_user_id])->one();
            //作品数量
            $album_count=Album::find()->where(['user_id'=>$home_user_id])->count();
            //被关注数量
            $byfollow_count=Follow::find()->where(['byfollow_id'=>$home_user_id])->count();
            //被喜欢数量
            $bylike_count=Like::find()->where(['bylike_user_id'=>$home_user_id])->count();
            //总访问量统计
            $album=Album::find()->where(['user_id'=>$home_user_id])->select('visit_num')->all();
            $visit_total=0;
            foreach ($album as $v)
            {
                $visit_total+=$v->visit_num;
            }
            //判断请求的userId是否等于登录用户的id
            if($user_id==Yii::$app->user->getId())
            {
                Yii::$app->cache->delete('imgUrl');
                return $this->render('index',[
                    'user'=>$user,
                    'person'=>$person,
                    'bg'=>$bg,
                    'allCat'=>$allCat,
                    'pgy'=>$pgy,
                    'album_count'=>$album_count,
                    'byfollow_count'=>$byfollow_count,
                    'bylike_count'=>$bylike_count,
                    'visit_total'=>$visit_total,
                ]);
            }
        }
        else
        {
            $this->goHome();
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
     * AJAX保存头像
     */
    public function actionSetimage()
    {
        $token=$this->getToken();
        if(Yii::$app->request->isAjax&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
        {
            $width=Yii::$app->request->post('width');
            $height=Yii::$app->request->post('height');
            $x=Yii::$app->request->post('x');
            $y=Yii::$app->request->post('y');
            $model=new SetImage();
            $model->imageFile=UploadedFile::getInstanceByName('imageFile');
            if($model->upload($width,$height,$x,$y))
            {
                //读取缓存
                $url=Yii::$app->cache->get('imgUrl');
                //获取登录用户ID
                $user_id=Yii::$app->user->getId();
                //获取模型
                $personInfo=PersonInfo::find()->where(['user_id'=>$user_id])->one();
                //获取原头像URL
                $oUrl=$personInfo->head_img;
                //设置头像URL
                $personInfo->head_img=$url;
                //修改头像URL
                $personInfo->save();
                //返回URL给前台
                $arr=['url'=>$url];
                //删除缓存
                Yii::$app->cache->delete('imgUrl');
                //删除原头像
             /*   if($oUrl!='/upload/headImg/default.png')
                {
                    //获取文件绝对路径
                    $absUrl=Yii::getAlias('@webroot'.$oUrl);
                    //判断文件是否存在
                    if(file_exists($absUrl))
                    {
                        //删除文件
                        unlink($absUrl);
                    }
                }*/
                return Json::encode($arr);
            }
        }

    }
    /**
     * AJAX保存个人资料
     */
    public function actionAjaxPersonInfo()
    {
        $token=$this->getToken();
        if (Yii::$app->request->isAjax&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
        {
            $post=Yii::$app->request->post();
            $id=Yii::$app->user->getId();
            $model=PersonInfo::find()->where(['user_id'=>$id])->one();
            if($model->load($post)&&$model->save())
            {
                $arr=['message'=>'保存成功'];
                return  Json::encode($arr);
            }else
            {
                $arr=['message'=>$post];
                return  Json::encode($arr);
            }
        }
    }
    /**
     * AJAX保存背景和字体颜色
     */
    public function actionAjaxBgImage()
    {
        $token=$this->getToken();
        if(Yii::$app->request->isAjax&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
        {
            $id=Yii::$app->user->getId();
            $person=PersonInfo::find()->where(['user_id'=>$id])->one();
            $person->bg_id=Yii::$app->request->post('bg_id');
            $person->font_color=Yii::$app->request->post('fontColor');
            if($person->save())
            {
                $arr=['message'=>'保存成功'];
                return  Json::encode($arr);
            }else
            {
                $arr=['message'=>'保存失败'];
                return  Json::encode($arr);
            }
        }
    }
    /**
     * AJAX保存摄影资料
     */
    public function actionAjaxPgyData()
    {
        $token=$this->getToken();
        if(Yii::$app->request->isAjax&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
        {
            $camera=Yii::$app->request->post('camera');
            $lens=Yii::$app->request->post('lens');
            $preference=Yii::$app->request->post('preference');
            $homepage=Yii::$app->request->post('homepage');
            $sign=Yii::$app->request->post('sign');
            $user_id=Yii::$app->user->id;
            //找到模型
            $pgy=PgyData::find()->where(['user_id'=>$user_id])->one();
            //修改值
            !empty($camera)?$pgy->camera=implode(',',$camera):$pgy->camera=$camera;
            !empty($lens)?$pgy->lens=$pgy->lens=implode(',',$lens):$pgy->lens=$lens;
            !empty($preference)?$pgy->preference=implode(',',$preference):$pgy->preference=$preference;
            $pgy->homepage=$homepage;
            $pgy->sign=$sign;
            if($pgy->save())
            {
                return true;
            }

        }
    }
}