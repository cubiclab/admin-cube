<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 27.08.2015
 * Time: 12:52
 */

namespace cubiclab\admin\assets;

use yii\web\AssetBundle;

class ACPLoginBundle extends AssetBundle{
    public $sourcePath = '@vendor/cubiclab/admin-cube/assets';
    public $css = [
        'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700',

        //plugins
        'css/font-awesome.min.css',
        'css/animate.min.css',

        //styles
        'css/main.css',
        'css/loader.css',
        'css/buttons.css',
        'css/login.css',
    ];

    public $js = [
        'js/apps.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}