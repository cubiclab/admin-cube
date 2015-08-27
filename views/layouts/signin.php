<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 27.08.2015
 * Time: 12:43
 */

use yii\helpers\Html;
use cubiclab\admin\assets\ACPLoginBundle;

$bundle = ACPLoginBundle::register($this);
?>
<?= $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]>
<html lang="<?= Yii::$app->language ?>" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="<?= Yii::$app->language ?>">
<!--<![endif]-->
<head>
    <title><?= Html::encode($this->title) ?></title>

    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <?= $this->head() ?>
    <?= Html::csrfMetaTags() ?>
</head>
<body class="pace-top">
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<div class="login-cover">
    <div class="login-cover-image"><img src="<?php echo $bundle->baseUrl . "/img/login/bg/1.jpg"; ?>" data-id="login-cover-image" alt=""/></div>
    <div class="login-cover-bg"></div>
</div>
<div id="page-container" class="fade">
    <?= $content ?>
</div>
<?= $this->endBody() ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        App.init();
    });
</script>
</body>
</html>
<?= $this->endPage() ?>
