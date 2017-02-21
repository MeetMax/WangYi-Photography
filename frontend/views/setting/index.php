<?php
    $this->title='个人设置';
    $this->registerCssFile('@web/css/cropper.css',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->registerCssFile('@web/css/setting.css',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->registerCssFile('@web/css/myHome.css',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->registerJsFile('@web/js/cropper.js',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->registerJsFile('@web/js/jquery.cookie.js',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->registerJsFile('@web/js/setting.js',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->params['breadcrumbs']['user']=$user;
    $this->params['breadcrumbs']['person']=$person;
    $this->params['pgy']=$pgy;
    $this->params['album_count']=$album_count;
    $this->params['byfollow_count']=$byfollow_count;
    $this->params['bylike_count']=$bylike_count;
    $this->params['visit_total']=$visit_total;
?>

        <!-- 页面主体 start -->
        <div class="g-conWraper">
            <div class="m-profileTaber">
                <table class="w-tableSelecter" width="100%" cellpadding="0" cellspacing="0"
                id="J-shareprofileTabers">
                    <tbody>
                        <tr>
                            <td class="taber curTaber">
                                <a href="#p=1" hidefocus="true" title="个人资料">个人资料</a>
                            </td>
                            <td class="taber">
                                <a href="#p=2" hidefocus="true" title="摄影资料">摄影资料</a>
                            </td>
                            <td class="taber">
                                <a href="#p=3" hidefocus="true" title="皮肤设计">皮肤设计</a>
                            </td>
                            <td class="taber">
                                <a href="#p=4" hidefocus="true" title="绑定社交网站">绑定社交网站</a>
                            </td>
                            <td class="taber taber-last">
                                <a href="#p=5" hidefocus="true" title="注销网易摄影">注销网易摄影</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <ul class="m-pageCon">
                <!-- 第一页 start -->
                <li class="con-item">
                    <div class="m-form m-form-personal">
                      <form id="J-space-form" method="post" >

                            <fieldset>
                                <legend class="f-hide">个人资料编辑</legend>
                                <input type="hidden" name="PersonInfo[user_id]" value="<?=Yii::$app->user->getId()?>">
                                <div class="fm-item">
                                    <label class="fm-label label-t" for="J-space-nickname">昵称：</label>
                                    <div class="fm-content">
                                        <input type="text" class="i-text i-175" autocomplete="off" id="J-space-nickname"
                                        name="PersonInfo[nickname]" value="<?=$person->nickname?>" maxlength="16" data-explain="昵称是你在网易摄影的名号，最长16个字符。">
                                        <div class="fm-explain">昵称是你在网易摄影的名号，最长16个字符。</div>
                                    </div>
                                </div>
                                <div class="fm-item">
                                    <label class="fm-label" for="J-space-domain">头像：</label>
                                    <div class="fm-content">
                                        <div class="m-lineBox m-lineBox-avt">
                                            <div class="o-box">
                                                <img src="<?=$person->head_img?>" width="140" height="140" alt="大头像" id="J-big-avt">
                                            </div>
                                            <div class="o-box o-box-small">
                                                <img src="<?=$person->head_img?>" width="60" height="60" alt="小头像" id="J-small-avt" >
                                                <a href="#" onclick="return false" title="修改头像" class="w-btnDimGray" hidefocus="true"
                                                id="J-modify-avt">修改头像</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="fm-item">
                                    <label class="fm-label fm-label-middle">居住地：</label>
                                    <input type="text" class="i-text i-175" value="<?=$person->live_address?>" style="width: 175px;" name="PersonInfo[live_address]">
                                </div>
                                <div class="fm-item">
                                    <label class="fm-label" for="J-sex-male">性别：</label>
                                    <?php
                                        $male='';
                                        $female='';
                                        if($person->sex==0)
                                        {
                                            $male="checked";
                                        }else
                                        {
                                            $female="checked";
                                        }
                                    ?>
                                    <div class="fm-content">
                                        <label for="J-sex-male">
                                            <input type="radio" value="0" name="PersonInfo[sex]" class="i-radio" id="J-sex-male" <?=$male?>>
                                            <b class="f-lineBlock">男</b>
                                        </label>
                                        <label for="J-sex-female" class="f-ml10">
                                            <input type="radio" value="1" name="PersonInfo[sex]" class="i-radio" id="J-sex-female" <?=$female?>>
                                            <b class="f-lineBlock">女</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="fm-item">
                                    <input type="hidden" name="PersonInfo[birth_date]" id="birth_date">
                                    <label class="fm-label fm-label-middle" for="J-space-domain">生日：</label>
                                    <div class="fm-content">
                                        <?php
                                            $birth_date=$person->birth_date;
                                        $arr=[];
                                        if (!empty($birth_date))
                                        {
                                            $arr=explode('-',$birth_date);
                                        }
                                        ?>
                                        <div id="J-birthday">
                                            <select id="J-year">
                                                <option value=" ">请选择</option>
                                                <?php for($i=1970;$i<=2016;$i++){
                                                    $select='';
                                                    if(!empty($arr))
                                                    {
                                                        if($i==$arr[0])
                                                        {
                                                            $select='selected="selected"';
                                                        }
                                                    }
                                                    ?>
                                                    <option value="<?=$i?>" <?=$select?>><?=$i?></option>
                                                <?php }?>
                                            </select>
                                            <label class="f-lineBlock" for="J-year">年</label>
                                            <select id="J-month">
                                                <option value=" ">请选择</option>
                                                <?php for($i=1;$i<=12;$i++){
                                                    $select='';
                                                    if(!empty($arr))
                                                    {
                                                        if ($i == $arr[1])
                                                        {
                                                            $select = 'selected="selected"';
                                                        }
                                                    }
                                                    ?>
                                                <option value="<?=$i?>" <?=$select?> ><?=$i?></option>
                                                <?php }?>
                                            </select>
                                            <label class="f-lineBlock" for="J-month">月</label>
                                            <select class="f-ml5" id="J-day">
                                                <option value=" ">请选择</option>
                                                <?php for($i=1;$i<=31;$i++){
                                                    $select='';
                                                    if(!empty($arr))
                                                    {
                                                        if ($i == $arr[2]) {
                                                            $select = 'selected="selected"';
                                                        }
                                                    }
                                                    ?>
                                                    <option value="<?=$i?>" <?=$select?> ><?=$i?></option>
                                                <?php }?>
                                            </select>
                                            <label class="f-lineBlock" for="J-day">日</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="fm-item">
                                    <label class="fm-label fm-label-middle" for="J-space-domain">登录邮箱：</label>
                                    <div class="fm-content">
                                        <span>499282083@qq.com</span>
                                        <a href="" title="修改密码" class="f-ml10" target="_blank">修改密码</a>
                                    </div>
                                </div>
                                <div class="fm-item">
                                    <span class="fm-label"></span>
                                    <div class="fm-content">
                                        <a href="#" onclick="return false" class="w-btnFmOk" needlogin="true"
                                        id="J-submit-profile">保存</a>
                                        <span class="f-ml20 f-tc9 f-hide J-loading">正在处理......</span>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                        <div class="profile-flash hide">
                            <div class="upload-wrap fn-clear">
                                <div class="upload">上传图片<input type="file" name="imageFile" id="imageFile"></div>
                            </div> 
                          <div class="upload-right">
                                <div class="mid-img"><img src=""  width="140" height="140"></div>
                                <p>110*110像素</p>
                                <div class="mid-img sm-img"><img src=""></div>
                                <p>60*60像素</p>
                            </div>
                            <div class="button">
                                <input type="button" name="" class="save" value="保存">
                                <span class="cancel">取消</span>
                            </div>
                        </div>
                    </div>
                </li
                <!-- 第一页 end -->
                <!-- 第二页 start -->
                <li class="con-item">
                    <div id="J-profile-camero" class="m-camero">
                        <div class="ui-6820319301">
                            <div class="w-profile clearfix">
                                <form id="pgy-data">
                                <table>
                                    <tbody>
                                        <tr><th>常用相机：</th>
                                            <td>
                                                <input class="btn btn3 iblock chs t" type="button" value="选择" style="display: none;">
                                                <div class="t camera-info">
                                                    <?php
                                                        $camera=explode(',',$pgy->camera);
                                                    ?>
                                                    <?php foreach ($camera as $k=>$v){ ?>
                                                        <div class="itm">
                                                        <?php if($k!=0){?>
                                                           <input type="text" value="<?=$v?>" name="camera[]">
                                                            <a class="z delete-camera" href="#" onclick="return false;" hidefocus="true">删除</a>
                                                        <?php }else{?>
                                                            <input type="text" value="<?=$v?>" name="camera[]">
                                                        <?php }?>
                                                        </div>

                                                    <?php }?>
                                                </div>
                                                <div>
                                                    <a class="t add-camera" href="#" hidefocus="true" onclick="return false;">继续添加相机信息››</a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>常用镜头：</th>
                                            <td>
                                                <input class="btn btn3 iblock chs t" type="button" value="选择" style="display: none;">
                                                <div class="t lens-info">
                                                    <?php
                                                    $lens=explode(',',$pgy->lens);
                                                    ?>
                                                    <?php foreach ($lens as $k=>$v){ ?>

                                                    <div class="itm">
                                                        <?php if($k!=0){?>
                                                        <input type="text" value="<?=$v?>" name="lens[]">
                                                        <a class="z delete-lens" href="#" onclick="return false;" hidefocus="true">删除</a>
                                                        <?php }else{?>
                                                            <input type="text" value="<?=$v?>" name="lens[]">
                                                        <?php }?>
                                                    </div>
                                                    <?php }?>
                                                </div>
                                                <div>
                                                    <a class="t add-lens" href="#" onclick="return false;" hidefocus="true">继续添加镜头信息››</a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <th class="th">主题偏好：</th>
                                            <td>
                                                <div class="lbs clearfix">
                                                    <?php foreach ($allCat as $v){
                                                        $preference=explode(',',$pgy->preference);
                                                        $checked='';
                                                        if(in_array($v->id,$preference))
                                                        {
                                                            $checked='checked="checked"';
                                                        }
                                                        ?>
                                                    <label><input <?=$checked?> type="checkbox" class="x" value="<?=$v->id?>" name="preference[]"><?=$v->cat_name?></label>
                                                    <?php }?>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>个人主页：</th>
                                            <?php
                                                if(!empty($pgy->homepage))
                                                {
                                                    $homepage=$pgy->homepage;
                                                }else
                                                {
                                                    $homepage='http://';
                                                }
                                            ?>
                                            <td><input class="i-text t" type="url" value="<?=$homepage?>" maxlength="50" name="homepage"></td>
                                        </tr>
                                        <tr>
                                            <th>摄影签名：</th>
                                            <?php
                                            if(!empty($pgy->sign))
                                            {
                                                $sign=$pgy->sign;
                                            }else
                                            {
                                                $sign='';
                                            }
                                            ?>
                                            <td><textarea class="i-textarea t" maxlength="80" name="sign"><?=$sign?></textarea></td>
                                        </tr>
                                        <tr>
                                            <th></th>

                                            <td><a href="javascript:void(0)" class="w-btnFmOk t" id="save-Pgy">保存</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                              </form>
                            </div>
                        </div>
                    </div>
                </li>
                <!-- 第二页 end -->
                <!-- 第三页 start -->
                <li class="con-item">
                    <div class="m-skinsTaber">
                        <ul class="w-tabSelecter" id="J-skinsTabers">
                            <li class="taber curTaber"><a href="" hidefocus="true" title="选择皮肤">选择皮肤</a></li>
                            <li class="taber"><a href="" hidefocus="true" title="自定义皮肤">自定义皮肤</a></li>
                        </ul>
                    </div>
                    <div class="m-skinsContainer" id="J-skinsContainer">
                        <p class="skin-items bg-color">
                            <?php foreach ($bg as $v){?>
                                <?php if ($v->type==1){
                                        $current='';
                                        if($v->id==$person->bg_id)
                                        {
                                            $current="skin-item-current";
                                        }
                                    ?>
                                    <a href="#" onclick="return false;" data-value="<?=$v->origin?>" data-id="<?=$v->id?>" class="skin-item <?=$current?>"
                                    title="#f3f3f3" hidefocus="true">
                                        <img src="<?=Yii::$app->request->hostInfo?>/images/sniff.png" width="100" height="75"
                                        alt="#f3f3f3" style="background-color:<?=$v->origin?>">
                                    </a>
                                <?php }?>
                            <?php }?>
                        </p>
                        <p class="skin-items bg-image">
                            <?php foreach ($bg as $v){?>
                                <?php if ($v->type==0){
                                    $current='';
                                    if($v->id==$person->bg_id)
                                    {
                                        $current="skin-item-current";
                                    }
                                    ?>
                                <a href="#" onclick="return false;" data-value="<?=Yii::$app->request->hostInfo?><?=$v->origin?>"
                                   class="skin-item <?=$current?>" hidefocus="true" data-id="<?=$v->id?>">
                                        <img src="<?=Yii::$app->request->hostInfo?><?=$v->thumb?>" width="100" height="75" alt="">
                                </a>
                                <?php }?>
                            <?php }?>
                        </p>
                    </div>
                    <div class="m-userDefineContainer" id="J-userDefineContainer" style="display:none;">
                        <ul class="m-lineBox">
                            <li class="o-box o-box-prev">
                                <span class="upload-txt" id="J-upload-progress" data-defaulttxt="建议最小尺寸<br/>1440像素&nbsp;X&nbsp;1080像素">
                                    建议最小尺寸
                                    <br>
                                    1440像素 X 1080像素
                                </span>
                                <img id="J-prev-uploadImg" src="http://r.ph.126.net/image/sniff.png" width="156"
                                height="116" alt="预览图" class="upload-prev" data-default="http://r.ph.126.net/image/sniff.png">
                            </li>
                            <li class="o-box o-box-op">
                                <p><a href="#" onclick="return false;" class="w-btnWhiteSmoke" id="J-upload-btn">上传图片</a></p>
                                <p class="op-memo">
                                    建议精心制作一张尺寸为1440像素 X 1080像素，或大于此尺寸同比例的图片。支持jpg\jpeg\gif\png\bmp格式。最大5M。
                                </p>
                            </li>
                        </ul>
                    </div>
                    <div class="m-blendent m-blendent-front" id="J-fontColorContainer">
                        <?php
                            $white='';
                            $black='';
                            if($person->font_color=='#fff')
                            {
                                $white='checked="checked"';
                            }else
                            {
                                $black='checked="checked"';
                            }
                        ?>
                        <p class="front-t">文字颜色</p>
                        <p class="f-mt20">
                            <label class="blendent" title="黑色">
                                <input type="radio" name="fontColor" value="#000" <?=$black?>>
                                <b class="color-sample color-sample-1">&nbsp;</b>
                            </label>
                            <label class="blendent" title="白色">
                                <input type="radio" value="#fff" name="fontColor" <?=$white?>>
                                <b class="color-sample color-sample-2">&nbsp;</b>
                            </label>
                        </p>
                    </div>
                    <div class="f-mt30">
                        <a href="javascript:void(0)" class="w-btnFmOk" id="J-skinSubmit">保存</a>
                    </div>
                </li>
                <!-- 第三页 end -->
                <!-- 第四页 start -->
                <li class="con-item">
                    <div class="m-thirdOpenModule">
                        <div class="fc10 tip0">
                            由于新浪微博等社交网络使用OAuth2.0以保障用户帐号安全，每次绑定有30-90天不等的有效期，过期后将需再次绑定，敬请周知！
                        </div>
                        <div class="open-info" id="J-openContainer">
                        </div>
                        <div>
                            <a href="javascript:void(0)" class="w-btnFmOk z-tag" id="J-openinfoSubmit">保存</a>
                        </div>
                        <div class="open-tips" id="J-bindLinkContainer" style="left: 0px; right: auto; top: 40px;">
                            <h4 id="J-bindTips" class="tip-t">你可以绑定的社交网站</h4>
                            <ul>
                                <li class="bind-item">
                                    <b class="w-color-qqweiboB"></b>
                                    <b class="f-lineBlock">腾讯微博</b>
                                    <a href="">绑定</a>
                                </li>
                                <li class="bind-item">
                                    <b class="w-color-sinaweiboB"></b>
                                    <b class="f-lineBlock">新浪微博</b>
                                    <a href="">绑定</a>
                                </li>
                                <li class="bind-item">
                                    <b class="w-color-renrenB"></b>
                                    <b class="f-lineBlock">人人网</b>
                                    <a href="">绑定</a>
                                </li>
                                <li class="bind-item">
                                    <b class="w-color-doubanB"></b>
                                    <b class="f-lineBlock">豆瓣</b>
                                    <a href="">绑定</a>
                                </li>
                                <li class="bind-item">
                                    <b class="w-color-frB"></b>
                                    <b class="f-lineBlock">flickr</b>
                                    <a href="">绑定</a>
                                </li>
                                <li class="bind-item">
                                    <b class="w-color-500B"></b>
                                    <b class="f-lineBlock">500px</b>
                                    <a href="">绑定</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- 第四页 end -->
                 <!-- 第五页 start -->
                <li class="con-item">
                    <dl class="m-sayByeModule">
                        <dt class="byetip-t">该操作将注销网易摄影，回退至网易相册，以下功能将无法使用：</dt>
                        <dd class="byetip-item">1. 绚丽的小屋展示</dd>
                        <dd class="byetip-item">2. 发布作品、推送至小镇与同好交流</dd>
                        <dd class="byetip-item">3. 通过新鲜事订阅好友的作品</dd>
                        <dd class="byetip-item">4. 参加比赛赢取奖品</dd>
                        <dd class="byetip-t">您确定要注销了吗？</dd>
                        <dd class="f-mt30"><a href="javascript:void(0)" class="w-btnFmOk" id="J-saybyeSubmit">确定</a></dd>
                    </dl>
                </li>
                <!-- 第五页 end -->
            </ul>
        </div>
        <!-- 页面主体 end -->
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