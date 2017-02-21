<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/13 0013
 * Time: 21:36
 */

namespace common\models;


use yii\db\ActiveRecord;

class BgImage extends ActiveRecord
{
    public static function tableName()
    {
        return '{{bg_image}}';
    }
    public function getPerson_info()
    {
        return $this->hasMany(BgImage::className(),['id'=>'bg_id']);
    }
}