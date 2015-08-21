<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 21.08.2015
 * Time: 13:52
 */


use yii\helpers\Html;

$this->title = Yii::t('admincube', 'ADMIN_WELCOME');
$this->params['subtitle'] = Yii::t('admincube', 'ADMIN_SUBTITLE'); ?>
<div class="jumbotron text-center">
    <h1><?php echo Html::encode($this->title); ?></h1>
    <p><?= Yii::t('admin', 'ADMIN_JUMBOTRON_MSG') ?></p>
</div>