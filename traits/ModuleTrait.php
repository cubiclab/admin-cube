<?php
namespace cubiclab\admin\traits;

use Yii;
use cubiclab\admin\AdminCube;

/**
 * Class ModuleTrait
 * @package yii\admincube\traits
 * Implements `getModule` method, to receive current module instance.
 */
trait ModuleTrait{
    /** @var \cubiclab\admin\AdminCube|null Module instance */
    private $_module;

    /** @return \cubiclab\admin\AdminCube|null Module instance */
    public function getModule(){
        if ($this->_module === null) {
            $module = AdminCube::getInstance();
            if ($module instanceof AdminCube) {
                $this->_module = $module;
            } else {
                $this->_module = Yii::$app->getModule('admin');
            }
        }
        return $this->_module;
    }
}