<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 21.08.2015
 * Time: 13:53
 */

use yii\helpers\Html;
$this->title = $name; ?>
<div class="site-error">
    <h1><?php echo Html::encode($this->title); ?></h1>
    <div class="alert alert-danger">
        <?php echo nl2br(Html::encode($message)); ?>
    </div>
</div>