<?php
namespace cubiclab\admin\models;

use Yii;
use \yii\db\ActiveRecord;
use cubiclab\admin\traits\ModuleTrait;

class Cubes extends ActiveRecord
{
    use ModuleTrait;

    const STATUS_NOT_ACTIVE = 0;
    const STATUS_ACTIVE = 1;

    /** @inheritdoc */
    public static function tableName()
    {
        return '{{%cubes}}';
    }

    /** @inheritdoc */
    public function rules()
    {
        return [
            [['name', 'class', 'title'], 'required'],
            [['name', 'class', 'title', 'icon'], 'trim'],
            ['name', 'match', 'pattern' => '/^[a-z]+$/'],
            ['name', 'unique'],
            ['class', 'match', 'pattern' => '/^[\w\\\]+$/'],
            ['class', 'checkExists'],
            ['icon', 'string'],
            ['status', 'in', 'range' => [0, 1]],
        ];
    }

    /** @inheritdoc */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('admincube', 'ATTR_MODULE_NAME'),
            'class' => Yii::t('admincube', 'ATTR_MODULE_CLASS'),
            'title' => Yii::t('admincube', 'ATTR_MODULE_TITLE'),
            'icon' => Yii::t('admincube', 'ATTR_MODULE_ICON'),
            'order' => Yii::t('admincube', 'ATTR_MODULE_ORDER'),
        ];
    }

    /** @inheritdoc */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!$this->settings || !is_array($this->settings)) {
                $this->settings = self::getDefaultSettings($this->class);
            }
            $this->settings = json_encode($this->settings);

            return true;
        } else {
            return false;
        }
    }

    /** @inheritdoc */
    public function afterFind()
    {
        parent::afterFind();
        $this->settings = $this->settings !== '' ? json_decode($this->settings, true) : self::getDefaultSettings($this->class);
    }

    public static function findAllActive()
    {
        $result = [];

        $activeCubes = self::find()->where(['status' => self::STATUS_ACTIVE])->orderBy(['order' => SORT_DESC])->all();
        foreach ($activeCubes as $cube) {
            $cube->trigger(self::EVENT_AFTER_FIND);
            $result[$cube->name] = (object)$cube->attributes;
        }

        return $result;
    }

    static function getDefaultSettings($moduleClass)
    {
        if (isset($moduleClass::$defaultSettings)) {
            return $moduleClass::$defaultSettings;
        } else {
            return [];
        }
    }

    public function setSettings($settings)
    {
        $newSettings = [];
        foreach($this->settings as $key => $value){
            $newSettings[$key] = is_bool($value) ? ($settings[$key] ? true : false) : ($settings[$key] ? $settings[$key] : '');
        }
        $this->settings = $newSettings;
    }
}