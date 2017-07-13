<?php

namespace app\models;

use Yii;
use \app\models\base\InvoiceOrderItem as BaseInvoiceOrderItem;

/**
 * This is the model class for table "invoice_order_item".
 */
class InvoiceOrderItem extends BaseInvoiceOrderItem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['order_id', 'product_id', 'item_description', 'item_quantity', 'item_rate', 'unit_measurement', 'item_total'], 'required'],
            [['order_id', 'product_id', 'item_quantity'], 'integer'],
            [['item_rate', 'item_total'], 'number'],
            [['item_description'], 'string', 'max' => 255],
            [['unit_measurement'], 'string', 'max' => 100]
        ]);
    }
	
}
