<?php
/**
 * Created by PhpStorm.
 * User: pt1c
 * Date: 26.08.2015
 * Time: 16:27
 */
namespace cubiclab\admin\widgets;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

class Menu extends \yii\widgets\Menu
{

    public $options = ['class' => 'nav'];

    public $itemOptions = ['class' => 'has-sub'];

    public $linkTemplateFirst = '<a href="{url}">{arrow} {icon}<span>{label}</span></a>';
    public $linkTemplate = '<a href="{url}">{arrow} {label}</a>';

    public $hasSubCssClass = "has-sub";

    public $submenuTemplate = '<ul class="sub-menu">{items}</ul>';

    public $activateParents = true;

    /**
     * @inheritdoc
     */
    protected function renderItems($items, $first = true)
    {
        $n = count($items);
        $lines = [];
        foreach ($items as $i => $item) {
            $options = array_merge($this->itemOptions, ArrayHelper::getValue($item, 'options', []));
            $tag = ArrayHelper::remove($options, 'tag', 'li');
            $class = [];
            if ($item['active']) {
                $class[] = $this->activeCssClass;
            }
            if ($i === 0 && $this->firstItemCssClass !== null) {
                $class[] = $this->firstItemCssClass;
            }
            if ($i === $n - 1 && $this->lastItemCssClass !== null) {
                $class[] = $this->lastItemCssClass;
            }

            $menu = $this->renderItem($item, $first);

            if (!empty($item['items'])) {
                $class[] = $this->hasSubCssClass;

                $menu .= strtr($this->submenuTemplate, [
                    '{items}' => $this->renderItems($item['items'], false),
                ]);
            }
            if (!empty($class)) {
                if (empty($options['class'])) {
                    $options['class'] = implode(' ', $class);
                } else {
                    $options['class'] .= ' ' . implode(' ', $class);
                }
            }
            $lines[] = Html::tag($tag, $menu, $options);
        }
        return implode("\n", $lines);
    }

    /**
     * @inheritdoc
     */
    protected function renderItem($item, $first = true)
    {

        $template = $first ? ArrayHelper::getValue($item, 'template', $this->linkTemplateFirst) :
                             ArrayHelper::getValue($item, 'template', $this->linkTemplate);
        $replace = !empty($item['icon']) ? [
            '{url}' => !empty($item['url']) ? Url::to($item['url']) : 'javascript:;',
            '{label}' => $item['label'],
            '{icon}' => '<i class="fa ' . $item['icon'] . '"></i> ',
            '{arrow}' => !empty($item['items']) ? '<b class="caret pull-right"></b>' : ''
        ] : [
            '{url}' => !empty($item['url']) ? Url::to($item['url']) : 'javascript:;',
            '{label}' => $item['label'],
            '{icon}' => $item['icon'] !== false ? '<i class="fa fa-laptop"></i>' : '',
            '{arrow}' => !empty($item['items']) ? '<b class="caret pull-right"></b>' : ''
        ];
        return strtr($template, $replace);
    }

    /**
     * @inheritdoc
     */
    protected function normalizeItems($items, &$active)
    {
        foreach ($items as $i => $item) {
            if (isset($item['visible']) && !$item['visible']) {
                unset($items[$i]);
                continue;
            }
            if (!isset($item['label'])) {
                $item['label'] = '';
            }
            $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $items[$i]['label'] = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $items[$i]['icon'] = isset($item['icon']) ? $item['icon'] : '';
            $hasActiveChild = false;
            if (isset($item['items'])) {
                $items[$i]['items'] = $this->normalizeItems($item['items'], $hasActiveChild);
                if (empty($items[$i]['items']) && $this->hideEmptyItems) {
                    unset($items[$i]['items']);
                    if (!isset($item['url'])) {
                        unset($items[$i]);
                        continue;
                    }
                }
            }
            if (!isset($item['active'])) {
                if ($this->activateParents && $hasActiveChild || $this->activateItems && $this->isItemActive($item)) {
                    $active = $items[$i]['active'] = true;
                } else {
                    $items[$i]['active'] = false;
                }
            } elseif ($item['active']) {
                $active = true;
            }
        }
        return array_values($items);
    }


}