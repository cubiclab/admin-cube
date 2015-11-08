<?php
namespace cubiclab\admin;

use Yii;
use yii\base\BootstrapInterface;
use cubiclab\admin\models\Cubes;

class AdminCube extends \yii\base\Module implements BootstrapInterface
{
    const VERSION = "0.0.1-prealpha";

    public $activeCubes;
    public $sideBarMenu;

    public function init()
    {
        parent::init();
        $this->registerTranslations();
        $this->layout = 'main';

        $this->activeCubes = Cubes::findAllActive();

        $cubes = [];
        foreach($this->activeCubes as $cubeName => $cube){
            $cubes[$cubeName]['class'] = $cube->class;
            if(is_array($cube->settings)){
                foreach($cube->settings as $settingName => $settingValue) {
                    $cubes[$cubeName][$settingName] = $settingValue;
                }
            }

            $cubes[$cubeName]['isACP'] = true; //вид ACP

            $this->sideBarMenu[] = $cubes[$cubeName]['class']::$menu;
        }

        $this->setModules($cubes);
    }

    public function registerTranslations()
    {
        if (empty(Yii::$app->i18n->translations['admincube'])) {
            Yii::$app->i18n->translations['admincube'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
            ];
        }
    }

    public function bootstrap($app){
        // Add module URL rules.
        $app->getUrlManager()->addRules(
            [
                '' => 'admin/default/index',
                '<_m>/<_c>/<_a>' => '<_m>/<_c>/<_a>'
            ]
        );
    }

    public function getSideBar(){
        return $this->sideBarMenu;
    }
}