<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 27.08.2015
 * Time: 7:47
 */

namespace cubiclab\admin\widgets;

use yii\base\Widget;
use yii\helpers\Html;
use yii\web\YiiAsset;
use Yii;

/**
 * Class Box
 * @package cubiclab\admin\widgets
 * Box widget.
 */
class Panel extends Widget
{
    //styles
    const PDEFAULT = 'default';
    const SUCCESS = 'success';
    const WARNING = 'warning';
    const DANGER = 'danger';
    const INVERSE = 'inverse';
    const PRIMARY = 'primary';
    const INFO = 'info';

    /** @var string|null Title */
    public $title;

    /** @var string Panel head style (see consts) */
    public $headStyle;

    /** @var array the HTML attributes for panel. */
    public $headOptions = [];

    /** @var bool If it is true panel render with colored body. */
    public $fullColor = false;

    /** @var array Panel body options */
    public $bodyOptions = [];

    /** @var array Panel footer options */
    public $footerOptions = [];

    /**
     * @var array Widget buttons array
     * Possible index:
     * `url` - Link URL
     * `label` - Link label
     * `icon` - Link icon class
     * `options` - Link options array
     */
    public $buttons = [];
    /**
     * @var string|null Widget buttons template
     * Example: '{create} {delete}'
     */
    public $buttonsTemplate;

    /** @var string delete action param name*/
    public $deleteParam = 'id';

    /** @var string mass parameters*/
    public $massParam = 'ids';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->initOptions();
        $this->initButtons();

        // Start panel
        // <div class="panel panel-inverse" data - sortable - id = "ui-widget-1" >
        echo Html::beginTag('div', $this->headOptions) . "\n";

        if ($this->title !== null || !empty($this->buttons)) {
            // <div class="panel-heading" >
            echo Html::beginTag('div', ['class' => 'panel-heading']);

            // Render buttons
            $this->renderButtons();

            // Panel titile
            if ($this->title !== null) {
                echo Html::tag('h4', $this->title, ['class' => 'panel-title']);
            }

            // </div >
            echo Html::endTag('div'); // end panel heading
        }

        //<div class="panel-body" >
        echo Html::beginTag('div', $this->bodyOptions) . "\n";
    }

    /** @inheritdoc */
    public function run()
    {
        echo Html::endTag('div'). "\n"; // Panel End body
        echo Html::endTag('div'). "\n"; // Panel End
    }

    protected function initOptions()
    {
        switch ($this->headStyle) {
            case Panel::PDEFAULT:
                $headStyles = Panel::PDEFAULT;
                $bodyStyles = false;
                break;
            case Panel::SUCCESS;
                $headStyles = Panel::SUCCESS;
                $bodyStyles = $this->fullColor ? 'bg-green text-white' : false;
                break;
            case Panel::WARNING;
                $headStyles = Panel::WARNING;
                $bodyStyles = $this->fullColor ? 'bg-orange text-white' : false;
                break;
            case Panel::DANGER;
                $headStyles = Panel::DANGER;
                $bodyStyles = $this->fullColor ? 'bg-red text-white' : false;
                break;
            case Panel::INVERSE;
                $headStyles = Panel::INVERSE;
                $bodyStyles = $this->fullColor ? 'bg-black' : false;
                break;
            case Panel::PRIMARY;
                $headStyles = Panel::PRIMARY;
                $bodyStyles = $this->fullColor ? 'bg-blue text-white' : false;
                break;
            case Panel::INFO;
                $headStyles = Panel::INFO;
                $bodyStyles = $this->fullColor ? 'bg-aqua text-white' : false;
                break;
            default:
                $headStyles = Panel::INVERSE;
                $bodyStyles = $this->fullColor ? 'bg-black' : false;
                break;
        }

        //head config
        $headStyles = 'panel panel-' . $headStyles;
        $this->headOptions['class'] = isset($this->headOptions['class']) ? $headStyles . ' ' . $this->headOptions['class'] : $headStyles;

        //body config
        $bodyStyles = $bodyStyles ? 'panel-body ' . $bodyStyles : 'panel-body';
        $this->bodyOptions['class'] = isset($this->bodyOptions['class']) ? $bodyStyles . ' ' . $this->bodyOptions['class'] : $bodyStyles;



        //$this->footerOptions['class'] = isset($this->footerOptions['class']) ? 'box-footer ' . $this->footerOptions['class'] : 'box-footer';
    }

    /** Initializes the Panel buttons. */
    protected function initButtons()
    {
        if (!isset($this->buttons['create'])) {
            $this->buttons['create'] = [
                'url' => ['create'],
                'icon' => 'fa-plus',
                'options' => [
                    'class' => 'btn-' . Panel::SUCCESS,
                    'title' => Yii::t('admincube', 'BUTTON_CREATE')
                ]
            ];
        }
        if (!isset($this->buttons['delete'])) {
            $this->buttons['delete'] = [
                'url' => ['delete', $this->deleteParam => Yii::$app->request->get($this->deleteParam)],
                'icon' => 'fa-trash-o',
                'options' => [
                    'class' => 'btn-' . Panel::DANGER,
                    'title' => Yii::t('admincube', 'BUTTON_DELETE'),
                    'data-confirm' => Yii::t('admincube', 'MSG_DELETE_CONFIRM'),
                    'data-method' => 'delete'
                ]
            ];
        }
        if (!isset($this->buttons['mass-delete'])) {
            $this->buttons['mass-delete'] = [
                'url' => ['mass-delete'],
                'icon' => 'fa-trash-o',
                'options' => [
                    'id' => 'mass-delete',
                    'class' => 'btn-' . Panel::DANGER,
                    'title' => Yii::t('admincube', 'BUTTON_DELETE_MASS')
                ]
            ];
        }
        if (!isset($this->buttons['cancel'])) {
            $this->buttons['cancel'] = [
                'url' => ['index'],
                'icon' => 'fa-reply',
                'options' => [
                    'class' => 'btn-' . Panel::DANGER,
                    'title' => Yii::t('admincube', 'BUTTON_CANCEL')
                ]
            ];
        }
    }

    /** Render panel buttons. */
    protected function renderButtons()
    {
        if ($this->buttonsTemplate !== null && !empty($this->buttons)) {
            // <div class="panel-heading-btn" >
            echo Html::beginTag('div', ['class' => 'panel-heading-btn']);

            /*
                    <a href = "javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data - click = "panel-expand" ><i class="fa fa-expand" ></i ></a >
                    <a href = "javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data - click = "panel-reload" ><i class="fa fa-repeat" ></i ></a >
                    <a href = "javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data - click = "panel-collapse" ><i class="fa fa-minus" ></i ></a >
                    <a href = "javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data - click = "panel-remove" ><i class="fa fa-times" ></i ></a >
                */

            echo preg_replace_callback(
                '/\\{([\w\-\/]+)\\}/',
                function ($matches) {
                    $name = $matches[1];
                    if (isset($this->buttons[$name])) {
                        $label = isset($this->buttons[$name]['label']) ? $this->buttons[$name]['label'] : '';
                        $url = isset($this->buttons[$name]['url']) ? $this->buttons[$name]['url'] : '#';
                        $icon = isset($this->buttons[$name]['icon']) ? Html::tag('i','',['class' => 'fa ' . $this->buttons[$name]['icon']]) : '';
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
            echo Html::endTag('div'); //end buttons
        }
    }

}