<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/15 0015
 * Time: 23:30
 */

namespace frontend\models;
use common\models\User;
use yii\db\ActiveRecord;

class Comment extends ActiveRecord
{
    public static function tableName()
    {
        return '{{comment}}';
    }
    public function rules()
    {
        return [
            [['user_id','time','album_id','content'],'required'],
        ];
    }
    public function optimisticLock()
    {
        return 'time';
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
    public function getPerson_info()
    {
        return $this->hasOne(PersonInfo::className(),['user_id'=>'user_id']);
    }
}