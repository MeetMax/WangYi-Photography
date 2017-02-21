<!-- footer start -->
<?php
    if(Yii::$app->controller->id=='site'&&Yii::$app->controller->action->id=='index'){
    $number=$this->params['breadcrumbs']['photoNum'];
?>
<div class="g-footer">
    <div class="m-wel">
        <p><strong><?=number_format($number)?>&nbsp;</strong>张作品在网易摄影</p>
        <?php if(Yii::$app->user->isGuest){?>
        <a href="<?=Yii::$app->urlManager->createUrl('site/signup')?>"
           target="_blank" class="ui-sbtn signup">
            → 立即注册，开始摄影之旅 </a>
            <?php }else{?>
            <a href="<?=Yii::$app->urlManager->createUrl('category/list')?>"
               target="_blank" class="ui-sbtn signup">
                → 抢鲜热门作品 </a>
            <?php }?>
    </div>
<?php }?>


    <div class="footer pp-footer">
        <div class="footer-wrap">
            <a class="item" href="javascript:void (0)" target="_blank">关于网易</a>
            <a class="item" href="javascript:void (0)" target="_blank">网易印像派</a>
            <a class="item" href="javascript:void (0)" target="_blank">意见反馈</a>
            <a class="item" href="javascript:void (0)" target="_blank">常见问题</a>
            <a class="item" href="javascript:void (0)" target="_blank">招聘信息</a>
            <a class="item" href="javascript:void (0)" target="_blank">客户服务</a>
            <a class="item" href="javascript:void (0)" target="_blank">隐私政策</a>
            <a class="item" href="javascript:void (0)" target="_blank">侵权举报</a>
            <p>网易公司版权所有 © 1997-2016&nbsp;&nbsp;&nbsp;
                <a class="item" rel="nofollow" target="_blank" href="javascript:void (0)">粤ICP备20090191号</a>
            </p>
        </div>
    </div>
</div>



<!-- footer end -->