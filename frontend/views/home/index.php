<?php
	$this->registerCssFile('@web/css/swiper.min.css',['depends'=>\frontend\assets\AppAsset::className()]);
	$this->registerCssFile('@web/css/myHome.css',['depends'=>\frontend\assets\AppAsset::className()]);
	$this->registerJsFile('@web/js/swiper.min.js',['depends'=>\frontend\assets\AppAsset::className()]);
	$this->registerJsFile('@web/js/home.js',['depends'=>\frontend\assets\AppAsset::className()]);
?>
<?php
	if(Yii::$app->user->getId()==$user->id)
	{
		$this->title='我的主页';
	}else
	{
		$this->title=$person->nickname.'的主页';
	}
	$this->params['breadcrumbs']['user']=$user;
	$this->params['breadcrumbs']['person']=$person;
	$this->params['breadcrumbs']['exist']=$exist;
	$this->params['pgy']=$pgy;
	$this->params['album_count']=$album_count;
	$this->params['byfollow_count']=$byfollow_count;
	$this->params['bylike_count']=$bylike_count;
	$this->params['visit_total']=$visit_total;
?>
<input type="hidden" name="userID" value="<?=$user->id?>">
	<!-- 主页照片 start-->
	<div class="g-homewraper m-homeset">
		 <div class="swiper-container">
	        <div class="swiper-wrapper">
	        	<!-- 第一页 start-->
				<?php for ($i=0;$i<ceil(count($album)/16);$i++){?>
	            <div class="swiper-slide">
					<ul class="">
						<!-- 一行 start-->
						<?php foreach ($album as $k=>$v){?>
							<?php if($k<16*($i+1)&&$k>=$i*16){
								$count=0;
								?>
								<li class="w-cover">
									<a href="<?=Yii::$app->urlManager->createUrl(['album/details','id'=>$v->id])?>">
										<img src="<?=$v->cover?>">
									</a>
									<div class="editarea cover f-trans j-cover">
										<?php if(Yii::$app->user->getId()==$user->id){?>
										<a href="" title="编辑" class="edit" hidefocus="true"></a>
										<a href="javascript:void(0);" title="取消展示" class="del" data-id="<?=$v->id?>"
										   hidefocus="true">
										</a>
										<?php }?>
									</div>
									<a href="<?=Yii::$app->urlManager->createUrl(['album/details','id'=>$v->id])?>" title="<?=$v->album_name?>" class="name detail f-trans j-cover" target="_blank" hidefocus="true">
										<em><?=$v->album_name?> [<?=count($v->photo)?>张]</em>
									<span class="meta">
										<span>
											<i class="i1" title="浏览数"></i>
											<span class="f-mr20"><?=$v->visit_num?></span>
											<i class="i2" title="评论数"></i>
											<span class="f-mr20"><?=count($v->comment)?></span>
											<i class="i3" title="喜欢数"></i>
											<?php
												foreach ($v->photo as $like)
												{
													$count+=count($like->like_bylike);
												}
											?>
											<span><?=$count?></span>
										</span>
									</span>
									</a>
								</li>
							<?php }?>
						<?php }?>
						<!-- 一行 end-->
					</ul>
				</div>
				<?php }?>
				<!-- 第一页 end-->
	        </div>
	        <!-- Add Navigation -->
	    </div>
	    <div class="swiper-button-prev w-circle"><b class="inner"><</b></div>
	   <div class="swiper-button-next w-circle"><b class="inner">></b></div>
    </div>
	<!-- 主页照片 end-->
<?php
	$js=<<<JS
	var swiper = new Swiper('.swiper-container', {
		pagination: '.swiper-pagination',
		paginationClickable: true,
		nextButton: '.swiper-button-next',
		prevButton: '.swiper-button-prev',
		speed:500,
		simulateTouch:false,
	});
JS;
$this->registerJs($js);
?>

