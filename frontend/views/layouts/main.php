<?php
use \frontend\assets\AppAsset;
use \yii\helpers\Html;
    AppAsset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=Html::encode($this->title)?></title>
    <?=HTML::csrfMetaTags()?>
    <?php $this->head()?>
</head>
<body>
<?php $this->beginBody()?>
<?=$this->render('headerBar');?>

<?=$content?>
<?php if(Yii::$app->controller->id=='album'&&Yii::$app->controller->action->id=='details'){?>
    <?=$this->render('floatBar')?>
<?php }?>
<?=$this->render('footer')?>
<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>
