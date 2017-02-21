<?php
namespace frontend\models;
use yii\db\ActiveRecord;

class PgyData extends ActiveRecord
{
    public static function tableName()
    {
        return '{{photography_info}}';
    }
    public function rules()
    {
        return [
            ['user_id','required']
        ];
    }
}