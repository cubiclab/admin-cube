<?php
namespace cubiclab\admin;

use Yii;
use yii\base\BootstrapInterface;

class AdminCube extends \yii\base\Module implements BootstrapInterface
{
    const VERSION = "0.0.1-prealpha";

    public function init()
    {
        parent::init();
    }

    public function bootstrap($app)
    {
        Yii::setAlias('admincube', '@vendor/cubiclab/admin-cube');

    }
}