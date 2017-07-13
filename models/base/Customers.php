<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "customers".
 *
 * @property string $id
 * @property string $gstin
 * @property string $name
 * @property string $address1
 * @property string $address2
 * @property string $city
 * @property string $pincode
 * @property integer $state
 * @property string $created_at
 * @property string $updated_at
 * @property string $created_by
 * @property string $updated_by
 *
 * @property \app\models\State $state0
 * @property \app\models\InvoiceOrder[] $invoiceOrders
 */
class Customers extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pincode'], 'required'],
            [['state', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['gstin', 'name', 'address1', 'address2'], 'string', 'max' => 255],
            [['city'], 'string', 'max' => 100],
            [['pincode'], 'string', 'max' => 15]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'customers';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gstin' => 'Gstin',
            'name' => 'Name',
            'address1' => 'Address1',
            'address2' => 'Address2',
            'city' => 'City',
            'pincode' => 'Pincode',
            'state' => 'State',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getState0()
    {
        return $this->hasOne(\app\models\State::className(), ['StateID' => 'state']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceOrders()
    {
        return $this->hasMany(\app\models\InvoiceOrder::className(), ['customer_id' => 'id']);
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
     * @return \app\models\CustomersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\CustomersQuery(get_called_class());
    }
}
