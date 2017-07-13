<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "invoice_order_item".
 *
 * @property string $id
 * @property integer $order_id
 * @property string $product_id
 * @property string $item_description
 * @property integer $item_quantity
 * @property string $item_rate
 * @property string $unit_measurement
 * @property string $item_total
 *
 * @property \app\models\InvoiceOrder $order
 * @property \app\models\Products $product
 */
class InvoiceOrderItem extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'item_description', 'item_quantity', 'item_rate', 'unit_measurement', 'item_total'], 'required'],
            [['order_id', 'product_id', 'item_quantity'], 'integer'],
            [['item_rate', 'item_total'], 'number'],
            [['item_description'], 'string', 'max' => 255],
            [['unit_measurement'], 'string', 'max' => 100]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_order_item';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'item_description' => 'Item Description',
            'item_quantity' => 'Item Quantity',
            'item_rate' => 'Item Rate',
            'unit_measurement' => 'Unit Measurement',
            'item_total' => 'Item Total',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(\app\models\InvoiceOrder::className(), ['id' => 'order_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(\app\models\Products::className(), ['id' => 'product_id']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'id',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\InvoiceOrderItemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\InvoiceOrderItemQuery(get_called_class());
    }
}
