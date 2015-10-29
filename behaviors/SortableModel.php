<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 29.10.2015
 * Time: 11:34
 */
namespace cubiclab\admin\behaviors;

use yii\db\ActiveRecord;

class SortableModel extends \yii\base\Behavior
{
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'findMaxOrder',
        ];
    }
    public function findMaxOrder()
    {
        if(!$this->owner->order) {
            $maxOrder = (int)(new \yii\db\Query())
                ->select('MAX(`order`)')
                ->from($this->owner->tableName())
                ->scalar();
            $this->owner->order = ++$maxOrder;
        }
    }
}