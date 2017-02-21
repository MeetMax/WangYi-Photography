<?php
use \yii\helpers\Html;
use \frontend\assets\LrAsset;
LrAsset::register($this);
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
<body>
<?php $this->beginBody()?>

<?=$content?>

<div class="g-ft">
    <div class="g-in">
        <div class="m-cp">
            <p>
                <a href="javascript:void(0)" target="_blank">
                    About NetEase
                </a>
                -
                <a href="javascript:void(0)" target="_blank">
                    公司简介
                </a>
                -
                <a href="javascript:void(0)" target="_blank">
                    联系方式
                </a>
                -
                <a href="javascript:void(0)" target="_blank">
                    OAuth2.0认证
                </a>
                -
                <a href="javascript:void(0)" target="_blank">
                    招聘信息
                </a>
                -
                <a href="javascript:void(0)" target="_blank">
                    客户服务
                </a>
                -
                <a href="javascript:void(0)" target="_blank">
                    相关法律
                </a>
                -
                <a href="javascript:void(0)" target="_blank">
                    网络营销
                </a>
            </p>
            <p>
                网易公司版权所有 ©1997-2016
            </p>
        </div>
    </div>
</div>
<?php $this->endBody()?>
</body>
</html>
<?php $this->endPage()?>