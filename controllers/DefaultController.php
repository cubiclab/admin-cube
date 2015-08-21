<?php
namespace cubiclab\admin\controllers;

use Yii;
use cubiclab\admin\components\Controller;

class DefaultController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access']['rules'][] = [
            'allow' => true,
            'actions' => ['error'],
            'roles' => ['@']
        ];
        return $behaviors;
    }

    /**@inheritdoc */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }

    /** ACP main page. */
    public function actionIndex()
    {
        return $this->render('index');
    }
}