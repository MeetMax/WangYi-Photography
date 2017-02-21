<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
use \yii\helpers\Url;

?>
<?php
$this->title="注册";
?>
<div class="g-hd">
        <div class="g-in">
            <div class="m-tr-block">
                已有帐号？去
                <a id="btn_Login" href="<?=Yii::$app->urlManager->createUrl(['site/login'])?>">
                    登录
                </a>
            </div>
        </div>
    </div>
    <div id="reg_block" class="g-bd">
        <div class="top_tlt">
            注册帐号
        </div>
        <!--Regular if0-->
        <div class="m-opr clearfix">
            <?php $form=ActiveForm::begin([
                'id'=>'bind-phone-form',
                'enableClientScript'=>false,
                'enableClientValidation' => false,
                'enableAjaxValidation' => false,
            ])?>
                <div class="u-input firstelem">
                    <label for="inpt-account" class="u-label">
                        帐号：
                    </label>
                    <?=$form->field($model,'username')->textInput([
                        'id'=>'inpt-account',
                        'placeholder'=>'用户名',
                        'class'=>'i-inpt'
                    ])->label(false)?>
                    <div class="u-tip f-dn">
                        <div class="spritebg u-clear" id="auto-id-1480475713773">
                        </div>
                    </div>
                </div>
                <div class="u-input firstelem">
                    <label for="inpt-account" class="u-label">
                       邮箱：
                    </label>
                    <?=$form->field($model,'email',['inputOptions'=>[
                            'id'=>'inpt-account',
                            'placeholder'=>'邮箱',
                            'class'=>'i-inpt',
                        ]
                    ])->label(false)?>
                    <div class="u-tip f-dn">
                        <div class="spritebg u-clear" id="auto-id-1480475713773">
                        </div>
                    </div>
                </div>
                <div class="u-input">
                    <label for="inpt-pw" class="u-label">
                        密码：
                    </label>
                    <?=$form->field($model,'password',['inputOptions'=>[
                        'id'=>'inpt-account',
                        'placeholder'=>'6-16位密码，区分大小写',
                        'class'=>'i-inpt',
                    ]])->passwordInput()->label(false)?>
                    <div class="u-tip f-dn">
                        <div class="spritebg u-clear" id="auto-id-1480475713774">
                        </div>
                    </div>
                    <!--Regular if5-->
                    <!--Regular if6-->
                </div>
                <div class="u-input">
                    <label for="inpt-pw2" class="u-label">
                        确认密码：
                    </label>
                    <?=$form->field($model,'rpassword',['inputOptions'=>[
                        'id'=>'inpt-account',
                        'placeholder'=>'再次输入密码',
                        'class'=>'i-inpt',
                    ]])->passwordInput()->label(false)?>
                    <div class="u-tip f-dn">
                        <div class="spritebg u-clear" id="auto-id-1480475713775">
                        </div>
                    </div>
                </div>
                <div class="u-input" style="height: 58px;">
                    <label class="u-label">
                        &nbsp;
                    </label>
                    <?=Html::submitButton('注&nbsp;&nbsp;册',[
                        'class'=>'b-btn btn-reg btn-red btndisabled',
                        'name'=>'signup-name',
                    ])?>
                </div>
                <div class="u-tips">
                    <label class="u-label">
                        &nbsp;
                    </label>
                    <span class="tip">
                        用户注册即代表同意
                        <a target="_blank" href="javascript:void(0)">
                            《服务条款》
                        </a>
                        和
                        <a target="_blank" href="javascript:void(0)">
                            《网络游戏用户隐私保护和个人信息利用政策》
                        </a>
                    </span>
                </div>
            <?php ActiveForm::end()?>
            <!--Regular if25-->
        </div>
    </div>