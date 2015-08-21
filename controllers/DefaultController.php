<?php
namespace cubiclab\admin\controllers;

use Yii;
use \yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return 'Admin Cube';
    }
}