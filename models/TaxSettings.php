<?php

namespace app\models;

use Yii;
use \app\models\base\TaxSettings as BaseTaxSettings;

/**
 * This is the model class for table "tax_settings".
 */
class TaxSettings extends BaseTaxSettings
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['tax_key', 'tax_percent', 'status'], 'required'],
            [['tax_percent'], 'number'],
            [['status'], 'integer'],
            [['tax_key'], 'string', 'max' => 100],
            [['tax_key'], 'unique']
        ]);
    }
	
}
