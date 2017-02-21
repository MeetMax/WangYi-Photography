<?php
    $albumAll=$this->params['breadcrumbs']['albumAll'];
    $preId=0;
    $nextId=0;
?>
<div class="m-floatBar">
    <ul>
        <li class="m-top-spacial f-trans" title="回到顶部" id="J-goToTop" style="top: -60px;"></li>
        <?php foreach ($albumAll as $k=>$v) {
            if (Yii::$app->request->get('id') == $v->id) {
                if(!empty($albumAll[$k-1]->id))
                {
                    $preId = $albumAll[$k-1]->id;
                }
                if(!empty($albumAll[$k+1]->id))
                {
                    $nextId = $albumAll[$k+1]->id;
                }
            }
        }
            ?>
        <?php if(Yii::$app->request->get('id')!= $albumAll[count($albumAll)-1]->id){?>
        <a href="<?=Yii::$app->urlManager->createUrl(['album/details','id'=>$nextId])?>">
            <li class="m-front f-trans" title="" id="J-nextGroup" style="top: 60px; z-index: 10;"></li>
        </a>
        <?php }?>
        <?php if(Yii::$app->request->get('id')!= $albumAll[0]->id){?>
            <a href="<?=Yii::$app->urlManager->createUrl(['album/details','id'=>$preId])?>">
                <li class="m-back f-trans" title="" id="J-preGroup"
                    style="top: 0px; z-index: 10;">
                </li>
            </a>
        <?php }?>
    </ul>
</div>