<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/12/13
 * Time: 11:10
 */

namespace frontend\models;
use common\models\BgImage;
use common\models\User;
use yii\db\ActiveRecord;

class PersonInfo extends ActiveRecord
{
    public static function tableName()
    {
        return '{{person_info}}';
    }
    public function rules()
    {
        return  [
            [['nickname','sex','user_id'],'required','message'=>'表单信息不全'],
            [['live_address','birth_date'],'string','length'=>[2,20]]
        ];
    }
    public function getBg_image()
    {
        return $this->hasOne(BgImage::className(),['id'=>'bg_id'] );
    }
    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
}