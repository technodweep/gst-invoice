<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "products".
 *
 * @property string $id
 * @property string $product_name
 * @property string $rate
 * @property string $unit_measurement
 * @property integer $stock
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $hsn_code
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \app\models\InvoiceOrderItem[] $invoiceOrderItems
 */
class Products extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_name', 'rate', 'unit_measurement', 'stock', 'hsn_code'], 'required'],
            [['rate'], 'number'],
            [['stock', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['product_name'], 'string', 'max' => 255],
            [['unit_measurement'], 'string', 'max' => 100],
            [['hsn_code'], 'string', 'max' => 25]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name' => 'Product Name',
            'rate' => 'Rate',
            'unit_measurement' => 'Unit Measurement',
            'stock' => 'Stock',
            'hsn_code' => 'Hsn Code',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceOrderItems()
    {
        return $this->hasMany(\app\models\InvoiceOrderItem::className(), ['product_id' => 'id']);
    }
    
/**
     * @inheritdoc
     * @return array mixed
     */ 
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\ProductsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\ProductsQuery(get_called_class());
    }
}
