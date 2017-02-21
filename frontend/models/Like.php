<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/12/15
 * Time: 11:04
 */

namespace frontend\models;

use yii\db\ActiveRecord;

class Like extends ActiveRecord
{
    public static function tableName()
    {
        return '{{like_bylike}}';
    }
    public function rules()
    {
        return   [
                [['like_user_id','bylike_user_id'], 'required'],
        ];
    }
}