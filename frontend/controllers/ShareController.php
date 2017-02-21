<?php

namespace frontend\controllers;
use common\models\Album;
use common\models\Photo;
use frontend\models\PersonInfo;
use frontend\models\UploadForm;
use yii\web\Controller;
use Yii;
use yii\helpers\Json;
use yii\web\UploadedFile;

class ShareController extends Controller
{
    public $enableCsrfValidation = false;
    /**
     * 照片上传页面
     */
    public function actionIndex()
    {
        $albumModel=new Album();
        $photoModel=new Photo();
        $token=$this->getToken();
        if($this->isPost()&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
        {
            //设置默认时区：北京
            date_default_timezone_set("PRC");
            //获取时间戳
            $albumModel->release_time=time();
            $albumModel->user_id=Yii::$app->user->id;
            if($albumModel->load(Yii::$app->request->post())&&$albumModel->save())
            {
                Yii::$app->session->setFlash('album_id',$albumModel->getPrimaryKey());
                if($photoModel->saveInfo())
                {
                    //获得用户id
                    $user=(string)Yii::$app->user->getId();
                    Yii::$app->cache->delete($user);
                    return $this->redirect(Yii::$app->urlManager->createUrl(['home/index','id'=>Yii::$app->user->id]));
                }
            }
        }
        if(!(Yii::$app->user->isGuest))
        {
            $uploadModel=new UploadForm();
            $uploadModel->clearPhoto();
            $person='';
            if(!Yii::$app->user->isGuest)
            {
                $person=PersonInfo::find()->where(['user_id'=>Yii::$app->user->getId()])->one();
            }
            return $this->render('index',[
                'model'=>$albumModel,
                'person'=>$person,
            ]);
        }else
        {
            //若没有登录，跳转至登录页面
            return $this->redirect(Yii::$app->urlManager->createUrl(['site/login']));
        }

    }
    /**
     * Ajax上传照片
     */
    public function actionAjax()
    {
        $model=new UploadForm();
        $token=$this->getToken();
        if($this->isAjax()&&$this->isPost()&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
        {
            $model->imageFiles=UploadedFile::getInstancesByName('imageFiles');
            if($model->upload())
            {
                $path=Yii::$app->session->getFlash('path');
                $arr=['path'=>$path];
                return Json::encode($arr);
            }
        }
    }

    /**
     * AJAX移除照片
     */
    public function actionRemovePhoto()
    {
        $token=$this->getToken();
        if($this->isAjax()&&$token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
        {
            $user_id=Yii::$app->user->getId();
            $i=Yii::$app->request->post('i');
            $cache=Yii::$app->cache->get((string)$user_id);
            $root=Yii::getAlias('@webroot');
            //删除图片
            unlink($root.$cache[$i]['sm_path']);
            unlink($root.$cache[$i]['big_path']);
            //重新设定缓存
            unset($cache[$i]);
            Yii::$app->cache->set((string)$user_id,$cache);
            return true;
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
    /**
     * 判断是否是POST请求
     */
    protected function isPost()
    {
        return Yii::$app->request->isPost;
    }
}