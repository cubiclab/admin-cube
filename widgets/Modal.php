<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 27.08.2015
 * Time: 18:33
 */

namespace cubiclab\admin\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\base\Widget;

/**
 * Class Menu
 * @package cubiclab\admin\widgets
 * SideMenu widget.
 */
class Modal extends Widget
{
    public $modal; //id modal
    public $title;
    public $options = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->initOptions();
        //$this->initButtons();

        // Start modal
        echo Html::beginTag('div', $this->options) . "\n";
        echo Html::beginTag('div', ['class' => 'modal-dialog']) . "\n";
        echo Html::beginTag('div', ['class' => 'modal-content']) . "\n";

        // modal-header не реализовано
        //<div class="modal-header" style="background: #242a30; border-top-left-radius: inherit;">
        //    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        //    <h4 class="modal-title">Alert Header</h4>
        //</div>

        // modal-body надо бы реализовать options
        echo Html::beginTag('div', ['class' => 'modal-body']) . "\n";

        // alert надо добавить success etc
        echo Html::beginTag('div', ['class' => 'alert alert-danger m-b-0']) . "\n";

        echo Html::beginTag('h4', ['class' => 'modal-title']) . "\n";
            // icon добавить шаблон
            echo '<i class="fa fa-info-circle"></i> ';
            echo $this->title;
        echo Html::endTag('h4');
    }

    protected function initOptions()
    {
        //options
        $this->options['id'] = $this->modal;
        $this->options['class'] = isset($this->options['class']) ? 'modal ' . $this->options['class'] : 'modal';
        $this->options['style'] = isset($this->options['style']) ? $this->options['style'] : 'display: none;';
    }

    /** @inheritdoc */
    public function run()
    {

        echo Html::endTag('div') . "\n";
        echo Html::endTag('div') . "\n";

        echo '
                        <div class="modal-footer">
                            <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
                            <a href="javascript:;" class="btn btn-sm btn-danger" id="mass-delete">Action</a>
                        </div>';

        echo Html::endTag('div') . "\n";
        echo Html::endTag('div') . "\n";
        echo Html::endTag('div') . "\n";

    }



}