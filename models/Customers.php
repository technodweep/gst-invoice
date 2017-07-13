<?php

namespace app\models;

use Yii;
use \app\models\base\Customers as BaseCustomers;

/**
 * This is the model class for table "customers".
 */
class Customers extends BaseCustomers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['pincode'], 'required'],
            [['state', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['gstin', 'name', 'address1', 'address2'], 'string', 'max' => 255],
            [['city'], 'string', 'max' => 100],
            [['pincode'], 'string', 'max' => 15]
        ]);
    }
	
}
