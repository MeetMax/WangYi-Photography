<?php
$this->registerCssFile('@web/css/simplePagination.css',['depends'=>\frontend\assets\AppAsset::className()]);
$this->registerCssFile('@web/css/global.css',['depends'=>\frontend\assets\AppAsset::className()]);
$this->registerCssFile('@web/css/share.css',['depends'=>\frontend\assets\AppAsset::className()]);
$this->registerJsFile('@web/js/jquery.simplePagination.js',['depends'=>\frontend\assets\AppAsset::className()]);
$this->registerJsFile('@web/js/category.js',['depends'=>\frontend\assets\AppAsset::className()]);
$this->title="组图展区";
?>
<?php
	$this->params['breadcrumbs']['person']=$person;
?>
<div class="body clearfix">
	<div class="m-etabline clearfix">
		<ul class="etab" id="photo_show_main_tab">
			<li class="">
				<a class="noul" href="#cat=-1&m=3&page=1" hidefocus="true" data-m="3">热门组图</a>
			</li>
			<li class="">
				<a class="noul" href="#cat=-1&m=2&page=1" hidefocus="true" data-m="2">社区推荐</a>
			</li>
			<li class="">
				<a class="noul" href="#cat=-1&m=1&page=1" hidefocus="true" data-m="1">最新组图</a>
			</li>
		</ul>
		<div id="share_show_hot_date" class="w-shareSelect"></div>
	</div>
	<div class="g-side">
		<ul class="m-setnav" id="photo_show_side">
			<li><a href="#cat=-1&m=3&page=1" hidefocus="true" sid="-1">全部</a></li>
			<?php foreach ($cat as $v){
				?>
				<li><a href="#cat=<?=$v['id']?>&m=3&page=1" hidefocus="true" sid="<?=$v['id']?>" class=""><?=$v['cat_name']?>
					<span class="childItem clearfix">
						<?php if(!empty($v['son'])){?>
							<?php foreach ($v['son'] as $v2){?>
								<em cid="<?=$v2['id']?>" class=""><?=$v2['cat_name']?></em>
							<?php }?>
					<?php }?>
					</span>
					</a>
				</li>
				<?php }?>
		</ul>
		<div style="margin-top:10px;">
			<a href="javascript:void (0)" target="_blank" hidefocus="true">
				<img src="<?=Yii::$app->request->hostInfo.'/images/4229161525185033951.jpg'?>"
					 width="110">
			</a>
		</div>
	</div>
	<div id="photo_show_main" class="g-sharemain">
		<div id="photo_show_main_gallery" class="m-gallery">
			<div class="js-exist">
				<div class="loading js-loading"></div>
				<ul class="pss clearfix js-alist"></ul>
				<div class="m-sharePager js-page"></div>
			</div>
			<div class="w-hint" style="display: none;">
				<div class="w-hint-head">
                	<span class="icn0 icn0-49"></span>
				</div>
				<div class="w-hint-body bdwa bds0 bdc23 bgc7 fc2">
					<b>：)</b>
					<div class="msg js-msg"></div>
				</div>
			</div>
		</div>
		<div class="page-wrap">
			<div class="m-sharePager js-page" id="page" style=""></div>
		</div>

	</div>

</div>