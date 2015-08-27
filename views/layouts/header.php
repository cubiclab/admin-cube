<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 26.08.2015
 * Time: 8:19
 */
?>
<div id="header" class="header navbar navbar-default navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="index.html" class="navbar-brand"><span class="navbar-logo"></span> Cubic CRM</a>
            <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <?= $this->render('header_right'); ?>
    </div>
</div>
