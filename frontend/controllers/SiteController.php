<?php
namespace frontend\controllers;


use common\models\Album;
use common\models\Category;
use common\models\Photo;
use common\models\User;
use frontend\models\PersonInfo;
use frontend\models\PgyData;
use frontend\models\UploadForm;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Cookie;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public function init(){
        $this->enableCsrfValidation = false;
    }
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
          /*  'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'backColor'=>0xf4f4f4,
                'padding'=>0,
                'height'=>28,
                'width'=>60,
                'minLength' => 4,
                'maxLength' => 4
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $ret=array();
        if(!Yii::$app->user->isGuest)
        {
            $uploadModel=new UploadForm();
            $uploadModel->clearPhoto();
            $user_id=Yii::$app->user->getId();
            $person=PersonInfo::find()->where(['user_id'=>$user_id])->one();
            $ret['person']=$person;
        }else
        {
            $ret['person']='';
        }
        $photoNum=Photo::find()->count();
        $album=Album::find()
            ->with('photo')
            ->with('user.person_info')
            ->where(['recommend'=>1])
            ->orderBy(['album.id'=>SORT_DESC])
            ->all();
        $category=Category::find()->all();
        $ret['album']=$album;
        $ret['category']=$category;
        $ret['photoNum']=$photoNum;
        return $this->render('index',$ret);
    }
    /**
     * 用户登录     *
     * @return mixed
     */
    public function actionLogin()
    {
        $this->layout='LRCommon';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $new_user=new User();
            $user=User::find()->where(['id'=>Yii::$app->user->id])->one();
            $user->access_token=$new_user->generateAccessToken();
            if($user->save())
            {
                $cookies=Yii::$app->response->cookies;
                $cookies_request=Yii::$app->request->cookies;
                if( $cookies_request->has('access_token'))
                {
                    $cookies->remove('access_token');
                }
                $cookies->add(new Cookie([
                    'name'=>'access_token',
                    'value'=>$user->access_token,
                    'expire'=>time()+3600*24*30,
                ]));
            }
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        $id=Yii::$app->user->id;
        $user=User::find()->where(['id'=>$id])->one();
        $returnURL=Yii::$app->user->getReturnUrl();
        if(Yii::$app->user->logout())
        {
            $cookies=Yii::$app->response->cookies;
            $cookies->remove('access_token');
            $user->access_token=null;
            $user->save();
            return $this->redirect($returnURL);
        }

    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * 用户注册
     */
    public function actionSignup()
    {
        $this->layout="LRCommon";
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                //注册成功后在个人信息表和摄影资料表中插入数据
               $personInfo=new PersonInfo();
                $personInfo->user_id=$user->getPrimaryKey();
                $personInfo->nickname=$user->username;
                $personInfo->save(false);
                $pgyData=new PgyData();
                $pgyData->user_id=$user->getPrimaryKey();
                $pgyData->save(false);
                //注册成功后登录
                if (Yii::$app->user->login($user)) {
                    $cookies=Yii::$app->response->cookies;
                    $cookies->add(new Cookie([
                        'name'=>'access_token',
                        'value'=>$user->access_token,
                        'expire'=>time()+3600*24*30,
                    ]));
                    return $this->goBack();
                }
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
}
