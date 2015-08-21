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
        $this->registerTranslations();
    }

    public function registerTranslations()
    {
        if (empty(Yii::$app->i18n->translations['admincube'])) {
            Yii::$app->i18n->translations['admincube'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
            ];
        }
    }

    public function bootstrap($app){
        // Add module URL rules.
        $app->getUrlManager()->addRules(
            [
                '' => 'admin/default/index',
                '<_m>/<_c>/<_a>' => '<_m>/<_c>/<_a>'
            ]
        );
    }
}