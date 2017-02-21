<?php
    $this->registerCssFile('@web/css/shareUpload.css',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->registerCssFile('@web/css/sharePoint.css',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->registerJsFile('@web/js/upload.js',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->title='上传照片';
    use \yii\widgets\ActiveForm;
    use \yii\helpers\Html;
?>
<?php
    $this->params['breadcrumbs']['person']=$person;
?>
<!-- 照片发布 start -->
<div class="g-prev">
    <div class="g-mainwraper">
        <div class="m-title">
            <h2 class="title" id="J-shareupload-title">
                发布组图
            </h2>
        </div>
        <div id="J-mainArea" class="m-mainarea">
            <div class="main-cell" id="J-defaultArea" style="z-index: 1;">
                <div class="m-editPicArea">
                    <div class="edit-inner f-clear z-tag">

                        <div class="go-Upload z-tag" style="visibility: visible;position: relative">
                            <p>
                                <span href="#" onclick="return false;" title="点击上传" class="w-btnFmOk z-tag"
                                   style="position: relative; z-index: 0; ">
                                    点击上传
                                    </span>
                                <input type="file" id="file" multiple name="imageFiles[]"
                                               style="position: absolute;top: 35px;left:31px;height: 30px;width:80px;opacity: 0">
                            </p>
                            <p>
                                或
                                <a href="#m=getFromPhoto" title="调用相册相片" class="photo-link z-tag">
                                    调用相册相片&gt;&gt;
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- 照片发布 end -->
<!--白色背景-->

<!-- 照片描述 start -->
<div class="g-mainwraper">

    <div class="m-lineBox m-lineBox-form">
        <div class="o-box o-box-fill">
            <div class="m-form m-form-fill">
                <div class="fm-item" id="J-select-dir">
                    <span class="fm-label fm-label-middle">
                        展区：
                    </span>
                    <div class="fm-content">
                        <div title="选择展区">
                            <span id="J-dir-con" class="f-lineBlock">
                                <b title="[选择展区]" class="w-selectTouch">
                                    [选择展区]
                                </b>
                            </span>
                            <span class="fm-required f-lineBlock f-ml5">
                                *
                            </span>
                        </div>
                        <div class="fm-explain">
                            请选择展区
                        </div>
                    </div>
                </div>
                <?php $form=ActiveForm::begin([
                    'id'=>'shareForm',
                    'enableClientScript'=>false,
                    'enableClientValidation' => false,
                    'enableAjaxValidation' => false,
                ])?>
                <div class="fm-item" id="J-shareset-title">
                    <label class="fm-label" for="J-shareUploadForm-title">
                        标题：
                    </label>
                    <div class="fm-content">
                        <div class="text-container">
                         <!--   <input type="text" class="i-text i-text-title" autocomplete="off" id="J-shareUploadForm-title"
                            name="J-shareUploadForm-title" value="" maxlength="18" title="标题" data-explain="标题最多18个字符"
                            data-isempty="请填写标题" required="required">-->
                           <?=$form->field($model,'album_name',['inputOptions'=>[
                                'id'=>'J-shareUploadForm-title',
                                'maxlength'=>'18',
                                'title'=>'标题',
                                'required'=>'required',
                                'class'=>'i-text i-text-title',
                            ]
                            ])->label(false)?>
                            <span class="f-ml5 fm-required">
                                *
                            </span>
                        </div>
                        <div class="fm-explain" id="J-title-error">
                            请填写标题
                        </div>
                    </div>
                </div>
                <div class="fm-item" id="J-shareset-desc">
                    <label class="fm-label" for="J-upload-info">
                        描述：
                    </label>
                    <div class="fm-content">
                        <div class="text-container">
                            <?=$form->field($model,'album_desc')->textarea([
                                'class'=>'i-textarea i-textarea-desc',
                                'id'=>'J-upload-info',
                                'maxlength'=>'1000',
                            ])->label(false)?>
                        </div>
                        <div class="fm-explain" id="J-desc-error">
                            描述最多1000个字
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--隐藏域 start-->
        <input name="Album[cat_id]" type="hidden" id="cat_id">
        <input name="Album[camera]" type="hidden" id="camera">
        <input name="Album[lens]" type="hidden" id="lens">
        <input name="Album[address]" type="hidden" id="address">
        <input name="Album[cover]" type="hidden" id="cover">
        <!--隐藏域 end-->
        <div class="o-box o-box-select">
            <div class="m-form m-form-select">
                <div class="fm-item">
                    <span class="fm-label fm-label-middle">
                        <b class="w-camera">
                        </b>
                        器材：
                    </span>
                    <div class="fm-content" title="选择相机" id="J-camer-con">
                        <b title="[选择相机]" class="w-selectTouch">
                            [选择相机]
                        </b>
                        <b title="[选择镜头]" class="w-selectTouch f-ml10">
                            [选择镜头]
                        </b>
                    </div>
                </div>
                <div class="fm-item fm-item-history">
                    <span class="fm-label fm-label-middle">
                        常用：
                    </span>
                    <div class="fm-content" id="J-equments-history">
                        <a href="#" title="佳能-EOS 5D Mark II" hidefocus="hideFocus">
                            佳能-EOS 5D Mark II
                        </a>
                        <a href="#" title="佳能-50 F1.8 " hidefocus="hideFocus">
                            佳能-50 F1.8
                        </a>
                        <a href="#" title="尼康-18-105 F3.5-5.6G VR" hidefocus="hideFocus">
                            尼康-18-105 F3.5-5.6G VR
                        </a>
                    </div>
                </div>
                <div class="fm-item">
                    <span class="fm-label fm-label-middle">
                        <b class="w-address">
                        </b>
                        地点：
                    </span>
                    <div class="fm-content" title="选择地点" id="J-address-con">
                        <b title="[选择地点]" class="w-selectTouch">
                            [选择地点]
                        </b>
                    </div>
                </div>
                <div class="fm-item fm-item-history">
                    <span class="fm-label fm-label-middle">
                        常用：
                    </span>
                    <div class="fm-content" id="J-address-history">
                        <a href="#" title="天津市" hidefocus="hideFocus">
                            天津市
                        </a>
                        <a href="#" title="绍兴市" hidefocus="hideFocus">
                            绍兴市
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div id="saveUploadArea" class="saveUploadArea">
            <div id="valCodeArea" class="m-valcode">
                <label class="step">
                    验证码：
                </label>
                <?=$form->field($model,'code')->widget(\yii\captcha\Captcha::className(),[
                    'id'=>'album-code',
                    'options'=>[
                        'class'=>'txtcode'
                    ],
                    'imageOptions'=>['class'=>'codeimg']
                ])->label(false)?>
            </div>
            <a id="savebtn" style="display:none;" class="savebtn" href="#" hidefocus="true">保存</a>
        </div>
        <div class="o-box o-box-weibo">
            <a href="#" onclick="return false;" title="发 布" class="w-btnBFmOk"
            id="J-submit-shareset">发 布</a>
        </div>
    </div>
</div>
<?php ActiveForm::end();?>
<!-- 照片描述 end -->
<!--选择分类 start-->
<div class="point-wrap npw-win zbwin">
    <div class="zwrp">
        <a href="javascript:;" class="zcls zflg" title="关闭">
        </a>
        <div class="ztbr noselect zmov">
            <div class="zttl thide fc1 zflg">
                选择分类
            </div>
        </div>
        <div class="zcnt fc2 zflg">
            <div class="">
                <div class="0 pk0 bdwb bds2 bdc4 t clearfix" style="display:none;">
                    <div class="crumb 1 l t">
                    </div>
                    <a href="javascript:void(0);" class="2 r t" onclick="return false;" hidefocus="true">
                        返回上级分类
                    </a>
                </div>
                <div class="pk1 fc1">
                    <div class="3 t region clearfix" style="display:none;">
                    </div>
                    <div class="4 t foreign foreign2 clearfix" style="display:none;">
                    </div>
                    <ul class="5 t clearfix data-list">
                       
                    </ul>
                </div>
                <div class="pk2 clearfix" style="display: none;">
                    <label class="t l ht" style="display:none;">
                        快速搜索：
                    </label>
                    <div class="t l ht w-suggest" style="display:none;">
                    </div>
                    <a href="javascript:void(0);" class="t l ht editlink" style="display:none;">
                        没有你的相机？点击添加！
                    </a>
                    <label class="6 t l ht" style="display:none;">
                    </label>
                    <input type="text" class="7 bdc6 bdwa bds0 fc2 t l ipt" maxlength="20"
                           style="display:none;">
                    <input type="button" class="8 btn btn3 fc5 pk3 t r" value="完成" style="display:none;">
                </div>
            </div>
        </div>
    </div>
</div>
<!--选择分类 end-->
<!--白背景 start-->
<div class="bg-white uiutil">
    <div class="zcvr zcls zflg">
        &nbsp;
    </div>
</div>
<!--白背景 end-->

   
