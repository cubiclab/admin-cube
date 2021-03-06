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

use cubiclab\admin\widgets\Modal;

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

    /** @var string delete action param name */
    public $deleteParam = 'id';

    /** @var string update action param name */
    public $updateParam = 'id';

    /** @var string mass parameters */
    public $massParam = 'ids';

    /** @var string|null Grid ID */
    public $grid;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->initOptions();
        $this->initButtons();

        echo Html::beginTag('div', $this->headOptions) . "\n";
        if ($this->title !== null || !empty($this->buttons)) {
            echo Html::beginTag('div', ['class' => 'panel-heading']);

            // Render buttons
            $this->renderButtons();

            if ($this->title !== null) {
                echo Html::tag('h4', $this->title, ['class' => 'panel-title']);
            }
            echo Html::endTag('div'); // end panel heading
        }
        echo Html::beginTag('div', $this->bodyOptions) . "\n";
    }

    /** @inheritdoc */
    public function run()
    {
        $this->registerClientScripts();
        echo Html::endTag('div') . "\n"; // Panel End body
        echo Html::endTag('div') . "\n"; // Panel End
    }

    protected function initOptions()
    {
        switch ($this->headStyle) {
            case self::PDEFAULT:
                $headStyles = self::PDEFAULT;
                $bodyStyles = false;
                break;
            case self::SUCCESS;
                $headStyles = self::SUCCESS;
                $bodyStyles = $this->fullColor ? 'bg-green text-white' : false;
                break;
            case self::WARNING;
                $headStyles = self::WARNING;
                $bodyStyles = $this->fullColor ? 'bg-orange text-white' : false;
                break;
            case self::DANGER;
                $headStyles = self::DANGER;
                $bodyStyles = $this->fullColor ? 'bg-red text-white' : false;
                break;
            case self::INVERSE;
                $headStyles = self::INVERSE;
                $bodyStyles = $this->fullColor ? 'bg-black' : false;
                break;
            case self::PRIMARY;
                $headStyles = self::PRIMARY;
                $bodyStyles = $this->fullColor ? 'bg-blue text-white' : false;
                break;
            case self::INFO;
                $headStyles = self::INFO;
                $bodyStyles = $this->fullColor ? 'bg-aqua text-white' : false;
                break;
            default:
                $headStyles = self::INVERSE;
                $bodyStyles = $this->fullColor ? 'bg-black' : false;
                break;
        }

        //head config
        $headStyles = 'panel panel-' . $headStyles;
        $this->headOptions['class'] = isset($this->headOptions['class']) ? $headStyles . ' ' . $this->headOptions['class'] : $headStyles;

        //body config
        $bodyStyles = $bodyStyles ? 'panel-body ' . $bodyStyles : 'panel-body';
        $this->bodyOptions['class'] = isset($this->bodyOptions['class']) ? $bodyStyles . ' ' . $this->bodyOptions['class'] : $bodyStyles;
    }

    /** Initializes the Panel buttons. */
    protected function initButtons()
    {
        //create
        $this->buttons['create'] = [
            'url' => isset($this->buttons['create']['url']) ? $this->buttons['create']['url'] : ['create'],
            'label' => isset($this->buttons['create']['label']) ? $this->buttons['create']['label'] : '',
            'icon' => 'fa-plus',
            'options' => [
                'class' => 'btn-' . Panel::SUCCESS,
                'title' => Yii::t('admincube', 'BUTTON_CREATE')
            ]
        ];

        //update
        $this->buttons['update'] = [
            'url' => ['update', $this->updateParam => Yii::$app->request->get($this->updateParam)],
            'label' => isset($this->buttons['update']['label']) ? $this->buttons['update']['label'] : '',
            'icon' => 'fa-reply',
            'options' => [
                'class' => 'btn-' . Panel::WARNING,
                'title' => Yii::t('admincube', 'BUTTON_UPDATE'),
            ]
        ];

        //delete
        $this->buttons['delete'] = [
            'url' => ['delete', $this->deleteParam => Yii::$app->request->get($this->deleteParam)],
            'label' => isset($this->buttons['delete']['label']) ? $this->buttons['delete']['label'] : '',
            'icon' => 'fa-trash-o',
            'options' => [
                'class' => 'btn-' . Panel::DANGER,
                'title' => Yii::t('admincube', 'BUTTON_DELETE'),
                'data-confirm' => Yii::t('admincube', 'MSG_DELETE_CONFIRM'),
                'data-method' => 'delete'
            ]
        ];

        //mass-delete
        $this->buttons['mass-delete'] = [
            'label' => isset($this->buttons['mass-delete']['label']) ? $this->buttons['mass-delete']['label'] : '',
            'icon' => 'fa-trash-o',
            'options' => [
                'id' => 'mass-delete',
                'class' => 'btn-' . Panel::DANGER,
                'title' => Yii::t('admincube', 'BUTTON_DELETE_MASS'),
            ]
        ];

        //cancel
        $this->buttons['cancel'] = [
            'url' => ['index'],
            'icon' => 'fa-reply',
            'options' => [
                'class' => 'btn-' . Panel::DANGER,
                'title' => Yii::t('admincube', 'BUTTON_CANCEL')
            ]
        ];

    }

    /** Render panel buttons. */
    protected function renderButtons()
    {
        if ($this->buttonsTemplate !== null && !empty($this->buttons)) {
            echo Html::beginTag('div', ['class' => 'panel-heading-btn']);
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
            echo Html::endTag('div'); //end buttons
        }
    }

    /**
     * Register widgets assets bundles.
     */
    protected function registerClientScripts()
    {
        if (strpos($this->buttonsTemplate, '{delete}') !== false && isset($this->buttons['delete'])) {
            YiiAsset::register($this->getView());
        }
        if (strpos($this->buttonsTemplate, '{mass-delete}') !== false && $this->grid !== null && isset($this->buttons['mass-delete'])) {
            $view = $this->getView();
            YiiAsset::register($view);
            $view->registerJs(
                "jQuery(document).on('click', '#mass-delete', function (evt) {" .
                "evt.preventDefault();" .
                "var keys = jQuery('#" . $this->grid . "').yiiGridView('getSelectedRows');" .
                "if (keys == '') {" .
                "$('#mass_delete_alert_no_sel').modal('show');" .
                "} else {" .
                "$('#mass_delete_alert').modal('show');" .
                "}" .
                "});".
                " ".
                "jQuery(document).on('click', '#btn_delete_confirm', function (evt) {".
                "evt.preventDefault();" .
                "var keys = jQuery('#" . $this->grid . "').yiiGridView('getSelectedRows');" .
                "jQuery.ajax({" .
                "type: 'POST'," .
                "url: jQuery(this).attr('href')," .
                "data: { " . $this->massParam . ": keys}" .
                "});" .
                "});"
            );

            //Confirm Modal buttons configuration
            $boxButtons[] = '{cancel}{delete}';
            $boxButtons = !empty($boxButtons) ? implode(' ', $boxButtons) : null;
            $buttons['delete'] = [
                'url' => ['mass-delete'],
                'label' => Yii::t('admincube', 'BUTTON_DELETE'),
                'options' => [
                    'id' => 'btn_delete_confirm',
                    'class' => 'btn btn-sm btn-danger',
                    'title' => Yii::t('admincube', 'BUTTON_DELETE'),
                ]
            ];
            //Confirm Modal
            Modal::begin([
                'modal' => 'mass_delete_alert',
                'title' => Yii::t('admincube', 'MSG_DELETE_CONFIRM'),
                'options' => ['class' => 'fade'],
                'buttonsTemplate' => $boxButtons,
                'buttons' => $buttons,
            ]);
            echo '<p>' . Yii::t('admincube', 'MSG_DELETE_CONFIRM_DESCRIPTION') . '</p>';
            Modal::end();
            //No selection alert modal
            Modal::begin([
                'modal' => 'mass_delete_alert_no_sel',
                'title' => Yii::t('admincube', 'MSG_NO_SELECTION'),
                'options' => ['class' => 'fade'],
                'buttonsTemplate' => '{close}',
            ]);
            echo '<p>' . Yii::t('admincube', 'MSG_NO_SELECTION_DESCRIPTION') . '</p>';
            Modal::end();
        }
    }

}