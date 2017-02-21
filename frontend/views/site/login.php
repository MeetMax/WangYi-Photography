<?php
    $this->title="登录";
?>
<?php
use \yii\widgets\ActiveForm;
use \yii\helpers\Html;
?>
<div class="g-hd">
        <div class="g-in">
            <div class="m-tr-block">
                没有帐号？去
                <a id="btn_Login" href="<?=Yii::$app->urlManager->createUrl(['site/signup','id'=>'1'])?>">
                    注册
                </a>
            </div>
        </div>
    </div>
    <div id="reg_block" class="g-bd">
        <div class="top_tlt">
            登录网易摄影
        </div>
        <!--Regular if0-->
        <div class="m-opr clearfix">
            <?php $form=ActiveForm::begin([
                    'id'=>'bind-phone-form',
                    'enableClientScript'=>false,
                    'enableClientValidation' => false,
                    'enableAjaxValidation' => false,
                ]
            )?>
                <div class="u-input firstelem">
                    <label for="inpt-account" class="u-label">
                        帐号：
                    </label>
                    <?=$form->field($model,'username',['inputOptions'=>[
                        'id'=>'inpt-account',
                        'placeholder'=>'账号',
                        'class'=>'i-inpt'
                    ]])->label('')?>
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
                        'class'=>'i-inpt'
                    ]])->passwordInput()->label('')?>
                    <div class="u-tip f-dn">
                        <div class="spritebg u-clear" id="auto-id-1480475713774">
                        </div>
                    </div>
                </div>
               <div class="u-input">
                    <label for="inpt-pw" class="u-label">
                       记住我：
                    </label>
                    <?=$form->field($model,'rememberMe')->checkbox([
                        'class'=>'remember',
                    ],['enclosedByLabel'=>false])->label(false)?>
                </div>
                <div class="u-input" style="height: 58px;">
                    <label class="u-label">
                        &nbsp;
                    </label>
                    <?=Html::submitButton('登&nbsp;&nbsp;录',[
                        'class'=>'b-btn btn-reg btn-red btndisabled',
                        'name'=>'login-name',
                    ])?>
                </div>
            <?php ActiveForm::end()?>
            <!--Regular if25-->
        </div>
    </div>
