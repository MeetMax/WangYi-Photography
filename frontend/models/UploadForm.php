<?php

namespace frontend\models;
use yii\base\Model;
use Yii;
use yii\web\Cookie;
use yii\web\UploadedFile;
use \yii\imagine\Image;

/**
 * ContactForm is the model behind the contact form.
 */
class UploadForm extends Model
{
   public $imageFiles;
   public $id;
   public $path;
   public $imgName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['imageFiles','image','extensions'=>'jpg,png','minWidth'=>'200','minHeight'=>'200', 'maxFiles' => '32','maxSize'=>'214748364800']
        ];
    }
    public function upload()
    {
        if($this->validate())
        {
            $arr=array();
            $no_data='无数据';
            //遍历图片
            foreach ($this->imageFiles as $file) {
                //设置时区为北京时间
                date_default_timezone_set('PRC');
                //格式化时间戳
                $date = date('Y-m-d', time());
                //目录名称
                $dirname = Yii::$app->basePath . '/web/upload/' . $date;
                //获得当前域名下上传文件夹
                $homeUrl = '/upload/' . $date . '/';
                //获取图片的名字
                $fileName = Yii::$app->security->generateRandomString();
                //获取图片原名
                $ogn_name=$file->baseName;
                //判断是都存在文件夹
                if (!is_dir($dirname)) {
                    //若目录不存在，创建新目录
                    mkdir($dirname, 0777, true);
                }
                $extension = $file->extension;
                //获取文件的绝对路径
                $route = Yii::getAlias('@webroot/upload/' . $date . '/');
                //存储图片
                $file->saveAs($route . '960' . $fileName . '.' . $extension);
                //获取EXIF信息
                $exif = exif_read_data($route . '960' . $fileName . '.' . $extension);
                //根据EXIF信息自动旋转图片
                Image::autorotate($route . '960' . $fileName . '.' . $extension, '000000')->save($route . '960' . $fileName . '.' . $extension, ['quality' => 90]);
                //判断图片的长宽比
                if ($exif['COMPUTED']['Width'] > $exif['COMPUTED']['Height']) {
                    //如果图片为横向
                    Image::thumbnail($route . '960' . $fileName . '.' . $extension, 960, null)->save($route . '960' . $fileName . '.' . $extension, ['quality' => 90]);
                } else {
                    //如果图片为纵向
                    Image::thumbnail($route . '960' . $fileName . '.' . $extension, null, 960)->save($route . '960' . $fileName . '.' . $extension, ['quality' => 90]);
                }
                //生成300的缩略图
                Image::thumbnail($route . '960' . $fileName . '.' . $extension, 300, 300)->save($route . '300' . $fileName . '.' . $extension, ['quality' => 90]);
                //判断是否存在拍摄时间信息
                if (!empty($exif['DateTimeOriginal'])) {
                    //格式化拍摄时间
                    $shutter_time = date('Y/m/d H:m:s', strtotime($exif['DateTimeOriginal']));
                }
                //生成需要缓存的数组
                $arr[]= [
                    //小图路径
                    'sm_path' => $homeUrl.'300'.$fileName.'.'.$extension,
                    //小图名字
                    'sm_name' => '300'.$fileName.'.'.$extension,
                    //大图路径
                    'big_path' => $homeUrl.'960'.$fileName.'.'.$extension,
                    //大图名字
                    'big_name' => '960'.$fileName.'.'.$extension,
                    //原图名字
                    'ogn_name' => $ogn_name,
                    //相机品牌
                    'camera_brand' => !empty($exif['Make']) ? $exif['Make'] : $no_data,
                    //相机型号
                    'camera_model' => !empty($exif['Model']) ? $exif['Model'] : $no_data,
                    //焦距
                    'focus' => !empty($exif['FocalLength']) ? $exif['FocalLength'] : $no_data,
                    //光圈
                    'aperture' => !empty($exif['COMPUTED']['ApertureFNumber']) ? $exif['COMPUTED']['ApertureFNumber'] : $no_data,
                    //快门速度
                    'shutter_speed' => !empty($exif['ExposureTime']) ? $exif['ExposureTime'] : $no_data,
                    //感光度
                    'iso' => !empty($exif['ISOSpeedRatings']) ? $exif['ISOSpeedRatings'] : $no_data,
                    //曝光补偿
                    'exposure_compensation' => !empty($exif['ExposureBiasValue']) ? $exif['ExposureBiasValue'] : $no_data,
                    //拍摄时间
                    'shoot_time' => !empty($shutter_time) ? $shutter_time : $no_data,
                    //镜头
                    'lens' => !empty($exif['UndefinedTag:0xA434']) ? $exif['UndefinedTag:0xA434'] : $no_data,
                    //绝对路径
                    'absolute_path' => $route,
                ];
                $sm_path=[ 'sm_path' => $homeUrl . '300' . $fileName . '.' . $extension];
                Yii::$app->session->setFlash('path', $sm_path['sm_path']);
            }

            //根据userID设置缓存
            $cache=Yii::$app->cache;
            //将user转换成字符串类型
            $user=(string)Yii::$app->user->getId();
            //判断该缓存是否存在
            if(!empty($cache->get($user)))
            {
                //如果缓存存在，合并原数组和新增的数组
                $arr=array_merge($arr,$cache->get($user));
                //再次添加到缓存中
                $cache->set((string)$user,$arr);
            }else
            {
                //若缓存不存在，直接添加缓存
                $cache->set((string)$user,$arr);
            }
            return true;
        }else{
            return false;
        }
    }
    /**
     * 删除照片，清理缓存
     */
    public function clearPhoto()
    {
        $token=$this->getToken();
        if($token===$this->getUserToken()&&$this->isGuest()&&!empty($token))
        {
            //获得用户id
            $user=(string)Yii::$app->user->id;
            //获取缓存
            $cache=Yii::$app->cache->get($user);
            if(!empty($cache))
            {
                //删除照片
                foreach ($cache as $v)
                {
                    if(file_exists($v['absolute_path'].$v['big_name']))
                    {
                        unlink($v['absolute_path'].$v['big_name']);
                    }
                    if(file_exists($v['absolute_path'].$v['sm_name']))
                    {
                        unlink($v['absolute_path'].$v['sm_name']);
                    }
                }
            }
            //删除照片信息缓存
            Yii::$app->cache->delete($user);
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
