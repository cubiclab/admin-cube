<?php
/**
 * Created by PhpStorm.
 * User: Pt1c
 * Date: 08.08.2015
 * Time: 14:12
 */

namespace cubiclab\admin\assets;

use yii\web\AssetBundle;

class ACPBundle extends AssetBundle{

    public $sourcePath = '@vendor/cubiclab/admin-cube/assets';
    public $css = [
        'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700',

        //plugins
        'css/font-awesome.min.css',
        'css/animate.min.css',

        //styles
        'css/main.css',
        'css/loader.css',
        'css/header.css',
        'css/sidebar.css',
        'css/buttons.css',
        'css/panel.css',
        'css/form.css',
        'css/profile.css',
    ];

    public $js = [
        'js/apps.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}