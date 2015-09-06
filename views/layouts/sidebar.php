<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 26.08.2015
 * Time: 8:18
 */

use cubiclab\admin\widgets\Menu;

?>
<div id="sidebar" class="sidebar">
    <ul class="nav">
        <li class="nav-profile">
            <div class="image">
                <a href="javascript:;"><img src="#" alt=""/></a>
            </div>
            <div class="info">
                <?= Yii::$app->user->identity->username; ?>
                <small>Developer</small>
            </div>
        </li>
    </ul>
    <?php
    $menuItems[] = ['label' => 'Dashboard', 'url' => ['/admin'], 'icon' => 'fa-cubes'];
    $menuItems = array_merge($menuItems, Yii::$app->getModule('admin')->sideBarMenu);

    //demo leveling
    $menuItems[] =
        ['label' => 'Menu Level', 'items' => [
        ['label' => 'Menu 1.1', 'items' => [
            ['label' => 'Menu 2.1', 'items' => [
                ['label' => 'Menu 3.1',],
                ['label' => 'Menu 3.2',],
                ['label' => 'Menu 3.3',],
            ]],
            ['label' => 'Menu 2.2',],
            ['label' => 'Menu 2.3',],
        ]],
        ['label' => 'Menu 1.2',],
        ['label' => 'Menu 1.3',],
    ]];

    echo Menu::widget([
        'injectFirslLine' => '<li class="nav-header">' . Yii::t('admincube', 'ADMIN_NAVIGATION') . '</li>',
        'injectLastLine' => '<li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>',
        'items' => $menuItems
    ]);
    ?>
</div>
<div class="sidebar-bg"></div>
