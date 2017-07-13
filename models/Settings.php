<?php

namespace app\models;

use Yii;
use \app\models\base\Settings as BaseSettings;

/**
 * This is the model class for table "settings".
 */
class Settings extends BaseSettings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['meta_key', 'meta_value'], 'required'],
            [['meta_value'], 'string'],
            [['meta_key'], 'string', 'max' => 36],
            [['meta_key'], 'unique']
        ]);
    }
	
}
