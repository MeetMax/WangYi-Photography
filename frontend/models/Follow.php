<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2016/12/15
 * Time: 11:04
 */

namespace frontend\models;

use yii\db\ActiveRecord;

class Follow extends ActiveRecord
{
    public static function tableName()
    {
        return '{{follow_byfollow}}';
    }
    public function rules()
    {
        return   [
                [['follow_id','byfollow_id'], 'required'],
        ];
    }
}