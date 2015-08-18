<?php
namespace yii\admincube;

use Yii;
use yii\base\BootstrapInterface;

class AdminCube extends \yii\base\Module implements BootstrapInterface
{
    const VERSION = 0.0.1;

    public function init()
    {
        parent::init();
    }

    public function bootstrap($app)
    {
        Yii::setAlias('admincube', '@vendor/cubiclab/admin-cube');

    }
}