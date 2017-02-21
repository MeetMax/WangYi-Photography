<?php
    $this->registerCssFile('@web/css/sharePageCommon.css',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->registerCssFile('@web/css/details.css',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->registerJsFile('@web/js/details.js',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->params['breadcrumbs']['albumAll']=$albumAll;
?>
<?php
if(!Yii::$app->user->isGuest)
{
    $this->params['breadcrumbs']['person']=$login_userInfo;
}
    $this->title=$album->album_name;
    $hostInfo=Yii::$app->request->hostInfo;
    $urlManager=Yii::$app->urlManager;
    $sex='';
    if($album_userInfo->sex==1)
    {
        $sex='她';
    }else
    {
        $sex='他';
    }
    if(Yii::$app->user->isGuest)
    {
        $needlogin="true";
    }else
    {
        $needlogin="false";
    }
?>
    <div class="g-mainwraper f-mt40">
        <p class="m-crumb">
            <a href="">摄影展区</a>
            <?php if(!empty($catArr['parName'])){?>
            <span class="arrow">&gt;</span>
            <a href=""><?=$catArr['parName']->cat_name?></a>
            <?php }?>
            <span class="arrow">&gt;</span>
            <a href=""><?=$catArr['curName']->cat_name?></a>
        </p>
    </div>
<input type="hidden" name="userID" value="<?=$album_userInfo->user_id?>">
    <div class="g-mainwraper g-mainwraper-hostinfo ">
        <ul class="m-lineBox m-lineBox-userinfo">
            <li class="o-box o-box-face" id="J-host-face">
                <a href="<?=$urlManager->createUrl(['home/index','id'=>$album_userInfo->user_id])?>" hidefocus="true" title="进入<?=$album_userInfo->nickname?>的个人展区">
                    <img width="100" alt="进入<?=$album_userInfo->nickname?>的个人展区" src="<?=$hostInfo.$album_userInfo->head_img?>"">
                </a>
            </li>
            <li class="o-box o-box-userinfo">
                <h2 class="picset-title" id="p_username_copy"><?=$album->album_name?></h2>
                <p class="picset-count">
                    <b class="f-lineBlock">[<?=$photoNum?>张]</b>
                    <?php if($album->recommend==1){?>
                    <b class="w-icoRecommend f-ml10" title="推荐">推荐</b>
                    <?php }?>
                </p>
                <p class="picset-cmtnum" id="J-picset-attention">
                    <b class="w-ico-attention" title="浏览量"></b>
                    <span id="J-picset-viewcount"><?=$album->visit_num?></span>
                    <b class="w-ico-cmt f-ml20" title="评论"></b>
                    <span id="J-picset-cmtcount"><?=count($album->comment)?></span>
                    <b class="w-ico-like f-ml20" title="喜欢"></b>
                    <?php
                        $bylike_count=0;
                        foreach ($photoInfo as $v)
                        {
                            $bylike_count+=count($v->like_bylike);
                        }
                    ?>
                    <span id="J-picset-likecount"><?=$bylike_count?></span>
                </p>
                <p class="picset-author">
                    <b style="vertical-align: -2px;">©</b>
                    <a href="<?=Yii::$app->urlManager->createUrl(['home/index','id'=>$album_userInfo->user_id])?>" title="进入<?=$album_userInfo->nickname?>的小屋" style="vertical-align: -2px;"><?=$album_userInfo->nickname?></a>
                    <?php if(Yii::$app->user->getId()!=$album_userInfo->user_id){
                        $follow='';
                        $unfollow='';
                        if($followExist)
                        {
                            $follow='display:none';
                            $unfollow='display:inline-block';
                        }else
                        {
                            $follow='display:inline-block';
                            $unfollow='display:none';
                        }
                        $like='';
                        $unlike='';
                        if($likeExist)
                        {
                            $like='display:none';
                            $unlike='display:inline-block';
                        }else
                        {
                            $like='display:inline-block';
                            $unlike='display:none';
                        }
                    ?>
                    <span class="author-unfollow" style="vertical-align: middle;">
                        <a href="#" onclick="return false;" hidefocus="true" class="w-btnDeepSkyBlue J-go-attention f-ml15"
                        data-needlogin="<?=$needlogin?>" id="J-go-attention" style="<?=$follow?>">
                            <b class="btn-plus">+</b>关注<?=$sex?>
                        </a>
                        <a href="#" class="J-go-unfollow act-unfollow w-btnDeepSkyBlue" hidefocus="true" onclick="return false;"
                        id="J-go-unfollow" data-needlogin="<?=$needlogin?>" style="<?=$unfollow?>">
                            取消关注
                        </a>
                    </span>
                    <a href="#" onclick="return false;" hidefocus="true" class="w-btnWhiteSmoke f-ml5"
                    style="vertical-align: middle;<?=$like?>" data-needlogin="<?=$needlogin?>" id="J-go-praise">赞<?=$sex?>(287)</a>
                    <a href="#" onclick="return false;" hidefocus="true" class="w-btnWhiteSmoke f-ml5"
                       style="vertical-align: middle;<?=$unlike?>" data-needlogin="<?=$needlogin?>" id="J-go-unpraise">已赞<?=$sex?>(287)</a>
                    <?php }?>
                </p>
            </li>
        </ul>
    </div>
    <div class="g-mainwraper g-mainwraper-picsetinfo">
        <p>
            器材： <?=$album->camera?>，<?=$album->lens?>
            <br>
            拍摄于： <?=$album->address?>， 发布于：<?=date('Y.m.d H:m',$album->release_time)?>
            <br>
            <span class="w-separatrix">- - - - - - - -</span>
        </p>
        <article class="picset-intro">
        </article>
    </div>
    <div class="g-mainwraper g-mainwraper-piclist f-mt20" id="J-picsContainer">
        <!-- 一张照片 start -->
        <?php foreach ($photoInfo as $k=>$v){
            $f=$v->focus;
            if($f!='无数据')
            {
                $arr=explode('/',$f);
                $a=(int)$arr[0];
                $b=(int)$arr[1];
                $focus=number_format($a/$b,1,'.','').' mm';
            }
            if(in_array($v->id,$photo_arr))
            {
                $photolike='f-hide';
                $photounlike='';
            }else
            {
                $photolike='';
                $photounlike='f-hide';
            }

        ?>
        <div class="m-picsetitem m-picsetitem-full">
           <p class="pic-index" id="46491835"><?=$k+1?></p>
           <div class="main-area">
               <div class="pic-area" style="zoom: 1;">
                    <img class="z-tag data-lazyload-src" src="<?=$hostInfo?>/images/sniff.png" width="960" height="960" data-lazyload="<?=$v->big_path?>">
                    <div class="m-picexif" style="visibility: hidden;">
                       <h5 class="picexif-title z-tag">EXIF</h5>
                        <ul class="picexif-container z-tag">
                            <li class="picexif-item">品牌：<b><?=$v->camera_brand?></b></li>
                            <li class="picexif-item">型号：<b><?=$v->camera_model?></b></li>
                            <li class="picexif-item">焦距：<b><?=$v->focus?></b></li>
                            <li class="picexif-item">光圈：<b><?=$v->aperture?></b></li>
                            <li class="picexif-item">快门速度：<b><?=$v->shutter_speed?> sec</b></li>
                            <li class="picexif-item">ISO：<b><?=$v->iso?></b></li>
                            <li class="picexif-item">曝光补偿：<b><?=$v->exposure_compensation?> EV</b></li>
                            <li class="picexif-item">拍摄时间：<b><?=$v->shoot_time?></b></li>
                            <li class="picexif-item">镜头：<b><?=$v->lens?></b></li>
                            </ul>
                        <span class="picexif-titlebg"></span>
                        <span class="picexif-bg"></span>
                        </div>
                    </div>
                <div class="m-picAct z-tag">
                    <div class="pic-descArea">
                        <p class="pic-description z-tag"><?=$v->ogn_name?></p>
                        </div>
                    <div class="pic-btnarea">
                        <p>
                            <a href="#" data-needlogin="<?=$needlogin?>"
                               onclick="return false;" hidefocus="true" class="w-btnDimGray z-tag <?=$photolike?>"
                               data-operation="J-go-love" data-id="<?=$v->id?>">喜欢(<span><?=count($v->like_bylike)?></span>)</a>
                            <a href="#" onclick="return false;" data-needlogin="<?=$needlogin?>" hidefocus="true" class="w-btnWhiteSmoke w-btn-cancelLike <?=$photounlike?>" data-id="<?=$v->id?>">
                                <b class="cancel-out z-tag">已喜欢(<span><?=count($v->like_bylike)?></span>)</b>
                                <b class="cancel-over z-tag">取消喜欢(<span><?=count($v->like_bylike)?></span>)</b>
                                </a>
                            <a href="#" onclick="return false;" hidefocus="true" class="w-btnWhiteSmoke f-ml10 z-tag"">评论</a>
                            </p>
                        </div>
                    <div class="pic-cmtContainer" id="J-picCmt46491835"></div>
                    </div>
                </div>
            </div>
        <?php }?>
       <!-- 一张照片 end -->
    <div class="g-mainwraper g-mainwraper-footAuthor">
        <h3 class="footAuthor-title">关于摄影师</h3>
        <ul class="m-lineBox">
            <li class="o-box o-box-face">
                <a href="<?=$urlManager->createUrl(['home/index','id'=>$album_userInfo->user_id])?>" hidefocus="true" title="进入<?=$album_userInfo->nickname?>的个人展区">
                    <img width="140" alt="进入<?=$album_userInfo->nickname?>的个人展区" src="<?=$hostInfo.$album_userInfo->head_img?>">
                </a>
            </li>
            <li class="o-box o-box-info">
                <p class="nick-area">
                    <a href="" class="host-title" style="vertical-align: middle;"><?=$album_userInfo->nickname?></a>
                </p>
                <p id="J-host-Countinfo" class="f-tl f-mt10">
                    <a class="w-lineBlock w-lineBlock-works" href="<?=$urlManager->createUrl(['home/index','id'=>$album_userInfo->user_id])?>">
                        <b class="num" style="font-size:22px;"><?=number_format(count($albumAll))?></b>
                        <b class="num-t">作品</b>
                    </a>
                    <a class="w-lineBlock w-lineBlock-followed" href="">
                        <b class="num" style="font-size:22px;"><?=number_format($byfollowNum)?></b>
                        <b class="num-t">被关注</b>
                    </a>
                    <a class="w-lineBlock w-lineBlock-liked" href="">
                        <b class="num" style="font-size:22px;"><?=number_format($bylikeNum)?></b>
                        <b class="num-t">被喜欢</b>
                    </a>
                </p>
            </li>
            <li class="o-box o-box-recommend" id="J-getMoreSet">
                <?php foreach ($albumAll as $k=>$v){?>
                    <?php if ($k<4){?>
                        <a href="<?=$urlManager->createUrl(['album/details','id'=>$v->id])?>" title="<?=$v->album_name?>">
                            <img width="100" alt="<?=$v->album_name?>" src="<?=$v->cover?>">
                        </a>
                    <?php }?>
                <?php }?>
            </li>
        </ul>
    </div>
<div class="g-mainwraper g-mainwraper-cmt f-clear">
	<div class="g-main cmt clwp" id="J-pageCmtArea">
	<div>
	<div class="j-wtr">
	<h3 class="j-wtl fs1 fw1 js-title fc1 icn0 icn0-30 cmt-title b-tag">对该组图的评论（<span><?=count($comment)?></span>条）</h3>
	</div>    
	 <div class="j-main">      
	 <div class="acmt b-tag" style="display:none;">
	 <img class="bdc21 bds0 bdwa qimg b-tag">
	 <a href="javascript:void(0);" class="noul b-tag"> 取消引用</a></div>      
	 <div class="nbw-act js-act b-tag" style="display:none">
	 <a href="javascript:void(0);" needlogin="true">点击登录</a><span class="lsep gt">|</span>
	 <span class="fc05">昵称：</span>
	 <input class="txt bdc6 bds0 bdwa"></div>      
	 <div class="j-wed clearfix">
        <?php
            if(Yii::$app->user->isGuest){
        ?>
	<div class="cmt-avt b-tag" style="display: none;">
	 <a target="_blank"><img class="bdwa bds0 bdc4 b-tag"></a>
	 <a target="_blank" class="thide b-tag"></a></div>              
	 <div class="cmt-edt js-editor fc2 fs1 b-tag anony-hint bdwa bds0 bdc4 bgc0">需要登录后发表评论，请先
	 <a href="<?=Yii::$app->urlManager->createUrl(['site/login'])?>" needlogin="true">登录<span class="gt"> ›› </span></a></div>
         <?php }else{?>
             <div class="cmt-avt b-tag">
                 <a target="_blank" href="<?=$urlManager->createUrl(['home/index','id'=>$login_userInfo->user_id])?>">
                     <img class="bdwa bds0 bdc4 b-tag" alt="<?=$login_userInfo->nickname?>" title="<?=$login_userInfo->nickname?>" src="<?=$hostInfo.$login_userInfo->head_img?>">
                 </a>
                 <a target="_blank" class="thide b-tag" title="<?=$login_userInfo->nickname?>" href="<?=$urlManager->createUrl(['home/index','id'=>$login_userInfo->user_id])?>">
                     <?=$login_userInfo->nickname?>
                 </a>
             </div>
         <input type="hidden" name="album_id" value="<?=Yii::$app->request->get('id')?>">
             <div class="cmt-edt js-editor fc2 fs1 b-tag">
                 <div class="ui-4861726943 w-ceditor w-pub-editor w-efix">
                     <div class="clearfix">
                         <div class="zcnt ztag w-txt">
                             <textarea placeholder="Ctrl + Enter　可以快捷发表评论" maxlength="140"></textarea>
                         </div>
                         <div class="zbtn">
                            <input class="ui-btn ui-btn-main0 zhnd ztag" type="button" value="发表" name="submit">
                         </div>
                     </div>
                     </div>
                 </div>
             </div>
         <?php }?>
	    </div>
	 <div class="js-cnt b-tag">
	<!--  一条评论 start -->
     <?php foreach ($comment as $v){?>
	 <div class="nbw-cmt bdwb bds2 bdc21 clearfix">                        
         <div class="nbw-fce nbw-f50 l bdwa bdc21 bds0">
         <a hidefocus="true" class="c-tag" href="<?=$urlManager->createUrl(['home/index','id'=>$v->user_id])?>">
             <img class="cwd js-img c-tag" title="<?=$v->user->person_info->nickname?>" alt="<?=$v->user->person_info->nickname?>" src="<?=$hostInfo.$v->user->person_info->head_img?>">
         </a>
         </div>
         <div class="thde">
         <span class="r fc1 js-time c-tag"><?=date('Y-m-d H:i',$v->time)?></span>
         <a class="tt js-title c-tag" href="<?=$urlManager->createUrl(['home/index','id'=>$v->user_id])?>" ><?=$v->user->person_info->nickname?></a>
         <div class="cnt fc98 js-cnt pre c-tag"><div><?=$v->content?></div></div>
          </div>
	   </div>
         <?php }?>
	   <!--  一条评论 end -->
</div>      
<a href="javascript:void(0)" class="noul npg npg-on hand fw1 fc0 js-next b-tag" style="display:none;" hidefocus="true"></a>            
</div>            
<div class="j-wbr cmt-more">      
<div class="j-wbl">	
</div>     
</div>
</div>
</div>
<div class="g-aside">
</div>
</div>
</div>

