<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use cubiclab\admin\assets\ACPBundle;

$bundle = ACPBundle::register($this);
?>
<?= $this->beginPage() ?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="<?= Yii::$app->language ?>" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="<?= Yii::$app->language ?>" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="<?= Yii::$app->language ?>"> <!--<![endif]-->
<head>
    <title><?= Html::encode($this->title) ?></title>

    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <?= $this->head() ?>
    <?= Html::csrfMetaTags() ?>
</head>
<body>
<div id="page-loader" class="fade in"><span class="spinner"></span></div>
<div id="page-container" class="fade ">
    <?= $this->render('header') ?>
    <?= $this->render('sidebar') ?>
    <div id="content" class="content">
        <?php
            echo Breadcrumbs::widget([
                'tag' => 'ol',
                'itemTemplate' => "<li>{link}</li>\n", // template for all links
                'options'      => ['class' => 'pull-right breadcrumb'],
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);
        ?>
        <h1 class="page-header"><?= $this->title ?></h1>
        <?= $content ?>
    </div>
</div>
<?php $this->endBody() ?>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
</body>
</html>
<?= $this->endPage() ?>

