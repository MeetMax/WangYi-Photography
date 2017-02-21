<?php
use yii\helpers\Html;
use \frontend\assets\AppAsset;
    AppAsset::register($this);
?>
<?php
    $id=Yii::$app->user->getId();
    $user=$this->params['breadcrumbs']['user'];
    $person=$this->params['breadcrumbs']['person'];
    $pgy= $this->params['pgy'];
    $hostInfo=Yii::$app->request->hostInfo;
    $sex='';
    if($person->sex==1)
    {
        $sex='她';
    }else
    {
        $sex='他';
    }
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=Html::encode($this->title)?></title>
    <?=Html::csrfMetaTags()?>
    <?php $this->head()?>
</head>
<?php
    $fontColor='';
    if($person->font_color=='#000')
    {
        $fontColor='g-wraper-fblack';
    }else
    {
        $fontColor='g-wraper-fwhite';
    }
?>
<body class="<?=$fontColor?>">
<?php $this->beginBody();?>
<?php if(!(Yii::$app->user->isGuest)&&$id==$user->id){?>
<!-- 按钮 start-->
<div class="g-logo">
    <div class="m-Mlogo">
        <h1><a href="<?=Yii::$app->urlManager->createUrl('site/index')?>"></a></h1>
        <span class="f-opacityBg"></span>
    </div>
    <p class="m-operaArea" style="z-index: 20;">
			<span class="w-bgBtn m-createSet" id="J-createSet">
				<span class="createSet" title="发布作品"><b class="w-createSetico f-mr5"></b>发布</span>
				<span class="w-createSetwin f-clear">
					<span class="arrow"><span class="borderarrow-t"></span></span>
					<span class="createSetcontent f-clear">
						<a href="<?=Yii::$app->urlManager->createUrl('share/index')?>" class="ui-ppbtn ui-ppbtn-grey">发单张</a>
						<a href="<?=Yii::$app->urlManager->createUrl('share/index')?>" class="ui-ppbtn ui-ppbtn-grey f-ml10" style="margin-left:10px;">发组图</a>
					</span>
				</span>
			</span>
			<span class="w-bgBtn w-bgBtn-setting">
				<a href="<?=Yii::$app->urlManager->createUrl(['setting/index','id'=>$user->id])?>" title="设置"><b class="w-setting"></b>设置</a>
			</span>
    </p>
</div>
<?php }?>
<!-- 按钮 end-->
<?php if(Yii::$app->user->isGuest){?>
    <!-- 登录注册按钮 start-->
    <div class="g-logo">
        <div class="m-Mlogo">
            <h1><a href="/"></a></h1>
            <span class="f-opacityBg"></span>
        </div>
        <p class="m-operaArea">
			<span class="w-bgBtn w-bgBtn-login" data-needlogin="true" id="J-login-home">
				<a href="<?=Yii::$app->urlManager->createUrl('site/login')?>" title="登录">登 录</a>
			</span>
            <span class="w-bgBtn w-bgBtn-login">
				<a href="<?=Yii::$app->urlManager->createUrl('site/signup')?>" title="注册">注 册</a>
			</span>
        </p>
    </div>
<?php }?>
<?php if(!(Yii::$app->user->isGuest)&&$id!=$user->id){?>
<?php
    $exist=$this->params['breadcrumbs']['exist'];
    $follow='';
    $unfollow='';
    if($exist)
    {
        $follow='display:none';
        $unfollow='display:inline-block';
    }else
    {
        $follow='display:inline-block';
        $unfollow='display:none';
    }
    ?>
<div class="g-logo" id="J-shareHome-logo">
    <div class="m-Mlogo">
        <h1 title="<?=$sex?>的网易摄影"><a href="/">网易摄影</a></h1>
        <span class="f-opacityBg"></span>
    </div>
    <p class="m-operaArea">
        <span class="w-bgBtn" id="J-go-attention" data-needlogin="true" style="<?=$follow?>">
            <a href="#" onclick="return false" title="加关注">
                <b class="w-addFollow"></b>加关注
            </a>
        </span>
        <span class="w-bgBtn" id="J-go-unfollow" style="<?=$unfollow?>" data-needlogin="true">
            <a href="#" onclick="return false" title="取消关注">取消关注</a>
        </span>
        <span class="w-bgBtn" id="J-send-msg" data-needlogin="true">
            <a href="#" onclick="return false" title="发私信">
                <b class="w-message"></b>发私信
            </a>
        </span>
    </p>
</div>
<?php }?>
<!-- 主页标题 start-->
<div class="g-header">
    <div class="m-homeHeader">
        <h2 class="host-nname"><a href=""><?=$person->nickname?></a></h2>
        <p>
            <a href="">
                <img class="host-ava" width="90" height="90" src="<?=$hostInfo.$person->head_img?>">
            </a>
        </p>
        <div class="tip-container">
            <sup class="w-tipModule">i</sup>
            <div class="data-container" id="J-data-container" style="margin-top: -59px;">
                <div class="host-data" id="J-hostDataContainer">
                    <p class="data-item">
                        <b class="w-icoCamero data-ico">相机</b>
							<span class="data-txt">
                                <?php $camera=explode(',',$pgy->camera)?>
                                <?php if(!empty($pgy->camera)){?>
                                <?php foreach ($camera as $k=>$v){?>
								<em><?=$v?></em>
                                <?php if(count($camera)!=$k+1){?>
								<span class="w-separatrix">|</span>
                                <?php }?>
                                <?php }?>
                                <?php }else{?>
                                    <em>尚未添加相机信息</em>
                                <?php }?>
							</span>
                    </p>
                    <p class="data-item">
                        <b class="w-icoBrand data-ico">镜头</b>
							<span class="data-txt">
								<?php $lens=explode(',',$pgy->lens)?>
                                <?php if(!empty($pgy->lens)){?>
                                <?php foreach ($lens as $k=>$v){?>
                                    <em><?=$v?></em>
                                <?php if(count($lens)!=$k+1){?>
                                        <span class="w-separatrix">|</span>
                                    <?php }?>
                                <?php }?>
                                <?php }else{?>
                                    <em>尚未添加镜头信息</em>
                                <?php }?>
							</span>
                    </p>

                    <p class="data-item data-item-count">
                        <span class="w-separatrix">|</span>作品<a href="" title="<?=$sex?>的小屋主页" class="f-ml5"><?=$this->params['album_count']?></a>
                        <span class="w-separatrix">|</span>被关注<a href="" title="<?=$sex?>的被关注" class="f-ml5"><?=$this->params['byfollow_count']?></a>
                        <span class="w-separatrix">|</span>被喜欢<a href="http://upixel.pp.163.com/likelist/?t=1" title="<?=$sex?>的被喜欢" class="f-ml5"><?=$this->params['bylike_count']?></a>
                    </p>
                    <p class="data-item data-item-signatures"> <span class="w-separatrix">|</span><?=$pgy->sign?></p>
                </div>
                <span class="w-borderarrow-l" id="J-hostDataArrow"></span>
            </div>
        </div>
    </div>
    <div class="m-nav">
        <ul class="m-navList" id="J-homeNavContainer">
            <li class="navItem">
                <?php
                    $home_current='';
                    $setting_current='';
                    $currentUrl=Yii::$app->request->getUrl();
                    $urlManager=Yii::$app->urlManager;
                    if($currentUrl==$urlManager->createUrl(['home/index','id'=>$user->id]))
                    {
                        $home_current='nav-current';
                    }else if($currentUrl==$urlManager->createUrl(['setting/index','id'=>$user->id]))
                    {
                        $setting_current='nav-current';
                    }
                ?>
                <h3 class="nav-s <?=$home_current?>">
                <?php if(!(Yii::$app->user->isGuest)&&$id==$user->id){?>
                    <a href="<?=Yii::$app->urlManager->createUrl(['home/index','id'=>$user->id])?>" title="我的小屋主页">主页</a>
                <?php }else{ ?>
                    <a href="<?=Yii::$app->urlManager->createUrl(['home/index','id'=>$user->id])?>" title="<?=$sex?>的小屋主页">主页</a>
                <?php }?>
                </h3>
            </li>
            <li class="navItem">
                <h3 class="nav-s ">
                    <a href="" title="专辑">专辑</a>
                </h3>
            </li>
            <?php if(!(Yii::$app->user->isGuest)&&$id==$user->id){?>
            <li class="navItem">
                <h3 class="nav-s nav-s-drop ">
                    <a href="#" title="我的社区" onclick="return false;">我的社区</a>
                    <b class="w-borderarrow-b"></b>
                </h3>
                <p class="nav-drop">
                    <a href="" title="我的喜欢">我的喜欢</a>
                    <a href="" title="我的荣誉">我的荣誉</a>
                    <a href="" title="我的奖章">我的奖章</a>
                    <a href="" title="我的帖子">我的帖子</a>
                    <a href="" title="我的关注">我的关注</a>
                    <a href="" title="我的小镇">我的小镇</a>
                    <a href="" title="关于我">关于我</a>
                </p>
            </li>
            <?php }else{ ?>
            <li class="navItem">
                <h3 class="nav-s nav-s-drop ">
                    <a href="#" title="他的社区" onclick="return false;"><?=$sex?>的社区</a>
                    <b class="w-borderarrow-b"></b>
                </h3>
                <p class="nav-drop">
                    <a href="" title="<?=$sex?>的喜欢"><?=$sex?>的喜欢</a>
                    <a href="" title="<?=$sex?>的荣誉"><?=$sex?>的荣誉</a>
                    <a href="" title="<?=$sex?>的奖章"><?=$sex?>的奖章</a>
                    <a href="" title="<?=$sex?>的帖子"><?=$sex?>的帖子</a>
                    <a href="" title="<?=$sex?>的关注"><?=$sex?>的关注</a>
                    <a href="" title="<?=$sex?>的小镇"><?=$sex?>的小镇</a>
                    <a href="" title="关于<?=$sex?>">关于<?=$sex?></a>
                </p>
            </li>
            <?php }?>
            <li class="navItem">
                <h3 class="nav-s">
                    <a href="">摄影名片</a>
                </h3>
            </li>
            <?php if(!(Yii::$app->user->isGuest)&&$id==$user->id){?>
            <li class="navItem">
                <h3 class="nav-s">
                    <a target="_blank" href="" title="相册">相册</a>
                </h3>
            </li>
            <li class="navItem">
                <h3 class="nav-s <?=$setting_current?>">
                    <a href="<?=Yii::$app->urlManager->createUrl(['setting/index','id'=>$user->id])?>" title="个人设置">个人设置</a>
                </h3>
            </li>
            <li class="navItem">
                <h3 class="nav-s ">
                    <a href="" title="我的总结">我的总结</a>
                </h3>
                <b class="nav-new"></b>
            </li>
            <?php }else{ ?>
                <li class="navItem">
                    <h3 class="nav-s ">
                        <a href="" title="<?=$sex?>的总结"><?=$sex?>的总结</a>
                    </h3>
                    <b class="nav-new"></b>
                </li>
            <?php }?>
        </ul>
    </div>
</div>
<!-- 主页标题 end-->
<?=$content?>
<!-- 背景层 start -->
<div class="m-homeBgM">
    <?php if($person->bg_image->type==0){?>
    <img src="<?=$hostInfo.$person->bg_image->origin?>" data-default="<?=$hostInfo?>/images/sniff.png" class="bg-img">
    <?php }else if($person->bg_image->type==1){?>
        <img src="<?=$hostInfo?>/images/sniff.png" data-default="<?=$hostInfo?>/images/sniff.png" class="bg-img"
             style="width: 100%;height: 100%;background-color:<?=$person->bg_image->origin?>">
    <?php }?>
</div>
<!-- 背景层 end -->
<!-- footer start -->
<div class="g-footer">
    <p class="m-copyright"><b>被访问<?=$this->params['visit_total']?>次</b> | <span>© <a href="<?=Yii::$app->urlManager->createUrl(['home/index','id'=>$user->id])?>" title="<?=$sex?>的小屋主页"><?=$person->nickname?></a></span> | <span>Powered by <a href="" title="<?=$sex?>的网易摄影">网易摄影</a></span></p> </div>
<!-- footer end -->
<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>