<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 26.08.2015
 * Time: 8:18
 */

use cubiclab\admin\widgets\ACPMenu;
?>
<!-- begin #sidebar -->
<div id="sidebar" class="sidebar">
    <!-- begin sidebar scrollbar -->
    <div data-scrollbar="true" data-height="100%">
        <!-- begin sidebar user -->
        <ul class="nav">
            <li class="nav-profile">
                <div class="image">
                    <a href="javascript:;"><img src="assets/img/user-13.jpg" alt=""/></a>
                </div>
                <div class="info">
                    <?= Yii::$app->user->identity->username; ?>
                    <small>Front end developer</small>
                </div>
            </li>
        </ul>
        <!-- end sidebar user -->
        <!-- begin sidebar nav -->
        <?php
        echo ACPMenu::widget([
            'items' => [
                // Important: you need to specify url as 'controller/action',
                // not just as 'controller' even if default action is used.
                ['label' => 'Home', 'url' => ['site/index']],
                // 'Products' menu item will be selected as long as the route is 'product/index'
                ['label' => 'Products', 'url' => ['javascript;;'], 'items' => [
                    ['label' => 'New Arrivals', 'url' => ['product/index', 'tag' => 'new']],
                    ['label' => 'Most Popular', 'url' => ['product/index', 'tag' => 'popular']],
                ]],
                ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
            ],
        ]);
        ?>
        <ul class="nav">
            <li class="nav-header"><?= Yii::t('admincube', 'MSG_NAVIGATION'); ?></li>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-laptop"></i>
                    <span>Dashboard</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="index.html">Dashboard v1</a></li>
                    <li><a href="index_v2.html">Dashboard v2</a></li>
                </ul>
            </li>
            <li class="has-sub active">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-cogs"></i>
                    <span>Page Options</span>
                </a>
                <ul class="sub-menu">
                    <li class="active"><a href="page_blank.html">Blank Page</a></li>
                    <li><a href="page_with_footer.html">Page with Footer</a></li>
                    <li><a href="page_without_sidebar.html">Page without Sidebar</a></li>
                </ul>
            </li>
            <li class="has-sub">
                <a href="javascript:;">
                    <b class="caret pull-right"></b>
                    <i class="fa fa-align-left"></i>
                    <span>Menu Level</span>
                </a>
                <ul class="sub-menu">
                    <li class="has-sub">
                        <a href="javascript:;">
                            <b class="caret pull-right"></b>
                            Menu 1.1
                        </a>
                        <ul class="sub-menu">
                            <li class="has-sub">
                                <a href="javascript:;">
                                    <b class="caret pull-right"></b>
                                    Menu 2.1
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="javascript:;">Menu 3.1</a></li>
                                    <li><a href="javascript:;">Menu 3.2</a></li>
                                </ul>
                            </li>
                            <li><a href="javascript:;">Menu 2.2</a></li>
                            <li><a href="javascript:;">Menu 2.3</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:;">Menu 1.2</a></li>
                    <li><a href="javascript:;">Menu 1.3</a></li>
                </ul>
            </li>
            <!-- begin sidebar minify button -->
            <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i
                        class="fa fa-angle-double-left"></i></a></li>
            <!-- end sidebar minify button -->
        </ul>
        <!-- end sidebar nav -->
    </div>
    <!-- end sidebar scrollbar -->
</div>
<div class="sidebar-bg"></div>
<!-- end #sidebar -->
