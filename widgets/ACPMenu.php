<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 26.08.2015
 * Time: 16:27
 */
namespace cubiclab\admin\widgets;

use Yii;
use yii\widgets\Menu;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

class ACPMenu extends Menu {

    public $options = ['class' => 'nav'];

    public $itemOptions = ['class' => 'has-sub'];

    public $submenuTemplate = '<ul class="submenu">{items}</ul>';

}