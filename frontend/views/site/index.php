<?php
    $this->registerCssFile('@web/css/global.css',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->registerCssFile('@web/css/square.css',['depends'=>\frontend\assets\AppAsset::className()]);
    $this->title='首页';
    $urlManager=Yii::$app->urlManager;
?>
<?php
    $this->params['breadcrumbs']['photoNum']=$photoNum;
    $this->params['breadcrumbs']['person']=$person;
    //$this->params['visit_total']=$visit_total;
?>
<!-- 社区推荐 start -->
<div class="g-body">
    <div class="m-toutu">
        <div class="bodyWrapper">
            <div class="g-layout m-rec">
                <div class="title">
                    <h3>社区推荐</h3>
                    <a href="<?=Yii::$app->urlManager->createUrl(['category/list'])?>#cat=-1&m=3&page=1" class="more" target="_blank">更多＋</a>
                </div>
                <ul class="content" id="recom-list">
                    <li class="w-rec w-rec-class">
                        <p class="type type0">视觉系</p>
                        <i class="arrow"></i>
                        <p class="category">
                            <?php $cat_id=array()?>
                            <?php foreach ($category as $k=>$v){?>
                                <?php if ($k<4){
                                    $cat_id[]=$v->id;
                                    ?>
                                <a href="<?=$urlManager->createUrl(['category/list'])?>#cat=<?=$v->id?>&m=3&page=1" target="_blank">[<?=$v->cat_name?>]</a>
                                <?php }?>
                            <?php }?>
                        </p>
                    </li>
                    <?php foreach ($category as $k=>$v){
                        if (in_array($v->parent_id,$cat_id))
                        {
                            $cat_id[]=$v->id;
                        }
                        ?>
                    <?php }?>
                    <?php foreach ($album as $k=>$v){?>
                        <?php if (in_array($v->cat_id,$cat_id)){
                            $arr[]=$k;
                            ?>
                            <?php if (count($arr)<6){?>
                            <li class="w-rec">
                                <img src="<?=$v->cover?>" width="188" height="188">
                                <a href="<?=$urlManager->createUrl(['album/details','id'=>$v->id])?>" title="<?=$v->album_name?>"
                                   class="name f-trans" target="_blank">
                                    <em><?=$v->album_name?>~[<?=count($v->photo)?>张]</em>
                                    <br>
                                    <span><?=$v->user->person_info->nickname?></span>
                                </a>
                                <div class="cover f-trans">
                                </div>
                            </li>
                        <?php }?>
                        <?php }?>
                    <?php }?>
                    <li class="w-rec w-rec-class">
                        <p class="type type2">记录下来就是胜利</p>
                        <i class="arrow"></i>
                        <p class="category">
                            <?php $cat_id=array();?>
                            <?php foreach ($category as $k=>$v){?>
                            <?php if ($k<7&&$k>3){
                                $cat_id[]=$v->id;
                            ?>
                                <a href="<?=$urlManager->createUrl(['category/list'])?>#cat=<?=$v->id?>&m=3&page=1" target="_blank">[<?=$v->cat_name?>]</a>
                            <?php }?>
                            <?php }?>
                            <br>
                            <?php foreach ($category as $k=>$v){?>
                            <?php if ($k<16&&$k>13){
                                    $cat_id[]=$v->id;
                                ?>
                                <a href="<?=$urlManager->createUrl(['category/list'])?>#cat=<?=$v->id?>&m=3&page=1" target="_blank">[<?=$v->cat_name?>]</a>
                            <?php }?>
                            <?php }?>
                        </p>
                    </li>
                    <?php foreach ($category as $k=>$v){
                        if (in_array($v->parent_id,$cat_id))
                        {
                            $cat_id[]=$v->id;
                        }
                        ?>
                    <?php }?>
                    <?php $arr=array()?>
                    <?php foreach ($album as $k=>$v){?>
                        <?php if (in_array($v->cat_id,$cat_id)){
                            $arr[]=$k; ?>
                            <?php if (count($arr)<6){?>
                            <li class="w-rec">
                                <img src="<?=$v->cover?>" width="188" height="188">
                                <a href="<?=$urlManager->createUrl(['album/details','id'=>$v->id])?>" title="<?=$v->album_name?>"
                                   class="name f-trans" target="_blank">
                                    <em><?=$v->album_name?>~[<?=count($v->photo)?>张]</em>
                                    <br>
                                    <span><?=$v->user->person_info->nickname?></span>
                                </a>
                                <div class="cover f-trans">
                                </div>
                            </li>
                            <?php }?>
                        <?php }?>
                    <?php }?>
                    <?php $cat_id=array();?>
                    <li class="w-rec w-rec-class">
                        <p class="type type3">爱摄影 爱生活</p>
                        <i class="arrow"></i>
                        <p class="category">
                            <?php foreach ($category as $k=>$v){?>
                                <?php if ($k<12&&$k>8){
                                    $cat_id[]=$v->id;
                                    ?>
                                    <a href="<?=$urlManager->createUrl(['category/list'])?>#cat=<?=$v->id?>&m=3&page=1" target="_blank">[<?=$v->cat_name?>]</a>
                                <?php }?>
                            <?php }?>
                            <br>
                            <?php foreach ($category as $k=>$v){?>
                                <?php if ($k==16){
                                    $cat_id[]=$v->id;
                                    ?>
                                    <a href="<?=$urlManager->createUrl(['category/list'])?>#cat=<?=$v->id?>&m=3&page=1" target="_blank">[<?=$v->cat_name?>]</a>
                                <?php }?>
                            <?php }?>
                            <?php foreach ($category as $k=>$v){?>
                                <?php if ($k==13){
                                    $cat_id[]=$v->id;
                                    ?>
                                    <a href="<?=$urlManager->createUrl(['category/list'])?>#cat=<?=$v->id?>&m=3&page=1" target="_blank">[<?=$v->cat_name?>]</a>
                                <?php }?>
                            <?php }?>
                        </p>
                    </li>
                    <?php foreach ($category as $k=>$v){
                        if (in_array($v->parent_id,$cat_id))
                        {
                            $cat_id[]=$v->id;
                        }
                        ?>
                    <?php }?>
                    <?php $arr=array()?>
                    <?php foreach ($album as $k=>$v){?>
                        <?php if (in_array($v->cat_id,$cat_id)){
                            $arr[]=$k; ?>
                            <?php if (count($arr)<4){?>
                                <li class="w-rec">
                                    <img src="<?=$v->cover?>" width="188" height="188">
                                    <a href="<?=$urlManager->createUrl(['album/details','id'=>$v->id])?>" title="<?=$v->album_name?>"
                                       class="name f-trans" target="_blank">
                                        <em><?=$v->album_name?>~[<?=count($v->photo)?>张]</em>
                                        <br>
                                        <span><?=$v->user->person_info->nickname?></span>
                                    </a>
                                    <div class="cover f-trans">
                                    </div>
                                </li>
                            <?php }?>
                        <?php }?>
                    <?php }?>
                    <li class="w-rec w-rec-class">
                        <p class="type type4">摄影小镇 每日一图</p>
                        <i class="arrow"></i>
                        <p class="category"></p>
                    </li>
                    <?php $arr=array()?>
                    <?php foreach ($album as $k=>$v){?>
                        <?php if (count($v->photo)==1){
                            $arr[]=$k;
                            ?>
                        <?php if (count($arr)<4){?>
                        <li class="w-rec">
                            <img src="<?=$v->cover?>" alt="<?=$v->album_name?>" width="188" height="188">
                            <a href="<?=$urlManager->createUrl(['album/details','id'=>$v->id])?>" title="<?=$v->album_name?>" class="name f-trans"
                               target="_blank">
                                <em><?=$v->album_name?>~[<?=count($v->photo)?>张]</em>
                                <br>
                                <span><?=$v->user->person_info->nickname?></span>
                            </a>
                            <div class="cover f-trans">
                            </div>
                        </li>
                    <?php }?>
                    <?php }?>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- 社区推荐 end -->
