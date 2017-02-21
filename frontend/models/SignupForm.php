<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $rpassword;
    public $access_token;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required','message'=>'账号不能为空'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => '账号已存在'],
            ['username', 'string', 'min' => 6, 'max' => 12,'message'=>'用户名必须在6-12位之间'],

            ['email', 'trim'],
            ['email', 'required','message'=>'邮箱不能为空'],
            ['email', 'email','message'=>'邮箱格式不正确'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '该邮箱已经被注册'],

            ['password', 'required','message'=>'密码不能为空'],
            ['password', 'string', 'min' => 6,'max'=>18,'message'=>'密码必须在6-18位之间'],

            ['rpassword','compare','compareAttribute'=>'password','message'=>'两次密码输入不一致'],
            ['rpassword', 'required','message'=>'请再次输入密码'],
            ['rpassword', 'string', 'min' => 6,'max'=>18,'message'=>'密码必须在6-18位之间'],

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = $this->username;
        $user->access_token=$user->generateAccessToken();
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        return $user->save() ? $user : null;
    }
}
