<?php
namespace frontend\models;
use yii\base\Model;
use Yii;
use yii\imagine\Image;

class SetImage extends Model
{
    public $imageFile;

    public function rules()
    {
        return [
            ['imageFile','image','extensions'=>'jpg,png','minWidth'=>'200','minHeight'=>'200', 'maxFiles' => '1','maxSize'=>'214748364800']
        ];
    }
    public function upload($width,$height,$x,$y)
    {
        if($this->validate())
        {
            $fileName=$this->imageFile->baseName.time();
            $extension=$this->imageFile->extension;
            $route=Yii::getAlias('@webroot/upload/headImg/');
            $this->imageFile->saveAs($route.$fileName.'.'.$extension);
            Image::autorotate($route.$fileName.'.'.$extension,'000000')->save($route.$fileName.'.'.$extension);
            Image::crop($route.$fileName.'.'.$extension,$width ,$height,[$x,$y])->save($route.$fileName.'.'.$extension);
            Image::thumbnail($route.$fileName.'.'.$extension, 200, 200)->save($route.$fileName.'.'.$extension);
            Yii::$app->cache->add('imgUrl','/upload/headImg/'.$fileName.'.'.$extension );
            return true;
        }else
        {
            return true;
        }
    }
}