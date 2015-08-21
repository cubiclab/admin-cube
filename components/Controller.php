<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 21.08.2015
 * Time: 13:47
 */

namespace cubiclab\admin\components;

use yii\filters\AccessControl;

/** Main ACP controller. */
class Controller extends \yii\web\Controller {

    /** @inheritdoc */
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['accessACP']
                    ]
                ]
            ]
        ];
    }
}