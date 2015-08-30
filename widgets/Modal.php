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
    public $buttons = [];
    public $buttonsTemplate;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->initOptions();
        $this->initButtons();

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

    /** Initializes the Panel buttons. */
    protected function initButtons()
    {
        //cancel
        $this->buttons['cancel'] = [
            'url' => ['javascript:;'],
            'icon' => 'fa-reply',
            'label' => Yii::t('admincube', 'BUTTON_CANCEL'),
            'options' => [
                'data-dismiss' => 'modal',
                'class' => 'btn btn-sm btn-white',
                'title' => Yii::t('admincube', 'BUTTON_CANCEL'),
            ]
        ];

        //ok
        $this->buttons['ok'] = [
            'url' => ['javascript:;'],
            'icon' => 'fa-check',
            'label' => Yii::t('admincube', 'BUTTON_OK'),
            'options' => [
                'data-dismiss' => 'modal',
                'class' => 'btn btn-sm btn-success',
                'title' => Yii::t('admincube', 'BUTTON_OK'),
            ]
        ];

        //close
        $this->buttons['close'] = [
            'url' => ['javascript:;'],
            'icon' => 'fa-reply',
            'label' => Yii::t('admincube', 'BUTTON_CLOSE'),
            'options' => [
                'data-dismiss' => 'modal',
                'class' => 'btn btn-sm btn-white',
                'title' => Yii::t('admincube', 'BUTTON_CLOSE'),
            ]
        ];
    }

    /** Render buttons. */
    protected function renderButtons()
    {
        if ($this->buttonsTemplate !== null && !empty($this->buttons)) {
            // <div class="modal-footer" >
            echo Html::beginTag('div', ['class' => 'modal-footer']);


            echo preg_replace_callback(
                '/\\{([\w\-\/]+)\\}/',
                function ($matches) {
                    $name = $matches[1];
                    if (isset($this->buttons[$name])) {
                        $label = isset($this->buttons[$name]['label']) ? $this->buttons[$name]['label'] : '';
                        $url = isset($this->buttons[$name]['url']) ? $this->buttons[$name]['url'] : '#';
                        $icon = isset($this->buttons[$name]['icon']) ? Html::tag('i', '', ['class' => 'fa ' . $this->buttons[$name]['icon']]) : '';
                        $label = $icon . ' ' . $label;
                        $this->buttons[$name]['options']['class'] = isset($this->buttons[$name]['options']['class']) ? 'btn btn-xs ' . $this->buttons[$name]['options']['class'] : 'btn btn-xs';
                        return Html::a($label, $url, $this->buttons[$name]['options']);
                    } else {
                        return '';
                    }
                },
                $this->buttonsTemplate
            );

            // </div >
            echo Html::endTag('div'); //modal-footer
        }
    }

    /** @inheritdoc */
    public function run()
    {

        echo Html::endTag('div') . "\n";
        echo Html::endTag('div') . "\n";

        // Render buttons
        $this->renderButtons();
        //echo '
        //                <div class="modal-footer">
         //                   <a href="javascript:;" class="btn btn-sm btn-white" data-dismiss="modal">Close</a>
         //                   <a href="javascript:;" class="btn btn-sm btn-danger" id="mass-delete">Action</a>
          //              </div>';

        echo Html::endTag('div') . "\n";
        echo Html::endTag('div') . "\n";
        echo Html::endTag('div') . "\n";

    }





}