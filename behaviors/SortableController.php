<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 29.10.2015
 * Time: 11:32
 */
namespace cubiclab\admin\behaviors;

use Yii;

class SortableController extends \yii\base\Behavior
{
    public $model;
    public function move($id, $direction, $condition = [])
    {
        $modelClass = $this->model;
        $success = '';
        if (($model = $modelClass::findOne($id))) {
            if ($direction === 'up') {
                $eq = '>';
                $orderDir = 'ASC';
            } else {
                $eq = '<';
                $orderDir = 'DESC';
            }
            $query = $modelClass::find()->orderBy('`order` ' . $orderDir)->limit(1);
            $where = [$eq, '`order`', $model->order];
            if (count($condition)) {
                $where = ['and', $where];
                foreach ($condition as $key => $value) {
                    $where[] = [$key => $value];
                }
            }
            $modelSwap = $query->where($where)->one();
            if (!empty($modelSwap)) {
                $newOrder = $modelSwap->order;
                $modelSwap->order = $model->order;
                $modelSwap->update();
                $model->order = $newOrder;
                $model->update();
                $success = ['swap_id' => $modelSwap->primaryKey];
            }
        } else {
            $this->owner->error = Yii::t('cubicadmin', 'NOT_FOUND');
        }
        return $this->owner->formatResponse($success);
    }
}