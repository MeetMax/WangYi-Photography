<?php
namespace common\models;

use frontend\models\Comment;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Login form
 */
class Album extends ActiveRecord
{
    public $code;
    public static function tableName()
    {
        return '{{album}}';
    }

    public function rules()
    {
        return [
            // username and password are both required
            [['album_name','cat_id','camera','lens','address','cover'], 'required','message'=>'表单不能为空'],
            ['code','captcha','message'=>'验证码错误'],
            ['album_name','string','max'=>18],
            ['album_desc','string','max'=>1000],
        ];
    }
    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id']);
    }
    public function getPhoto()
    {
        return $this->hasMany(Photo::className(),['album_id'=>'id']);
    }
    public function getComment()
    {
        return $this->hasMany(Comment::className(),['album_id'=>'id']);
    }

}
