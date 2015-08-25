<?php

use yii\helpers\Html;

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
 <html lang="<?= Yii::$app->language ?>">
<head>
    <title><?= Html::encode($this->title) ?></title>

    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php $this->head() ?>
    <?= Html::csrfMetaTags() ?>
</head>
<body>

<div class="container">
    <?= $content ?>
</div>
<!--=== End Content Part ===-->

</body>
</html>
<?php $this->endPage() ?>