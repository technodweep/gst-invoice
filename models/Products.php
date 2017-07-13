<?php

namespace app\models;

use Yii;
use \app\models\base\Products as BaseProducts;

/**
 * This is the model class for table "products".
 */
class Products extends BaseProducts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['product_name', 'rate', 'unit_measurement', 'stock', 'hsn_code'], 'required'],
            [['rate'], 'number'],
            [['stock', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['product_name'], 'string', 'max' => 255],
            [['unit_measurement'], 'string', 'max' => 100],
            [['hsn_code'], 'string', 'max' => 25]
        ]);
    }
	
}
