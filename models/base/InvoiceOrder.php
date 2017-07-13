<?php

namespace app\models\base;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use mootensai\behaviors\UUIDBehavior;

/**
 * This is the base model class for table "invoice_order".
 *
 * @property integer $id
 * @property string $gst_in
 * @property string $PAN
 * @property integer $gst_invoice_no
 * @property string $gst_invoice_date
 * @property integer $challan_no
 * @property string $challan_date
 * @property integer $po_no
 * @property string $po_date
 * @property string $mode_of_transport
 * @property string $btp_address
 * @property integer $btp_state
 * @property string $btp_code
 * @property string $btp_gstin
 * @property string $total_before_tax
 * @property string $cgst
 * @property string $sgst
 * @property string $igst
 * @property string $total_tax_amount
 * @property string $total_amount_after_tax
 * @property string $grabd_total
 * @property string $amount_in_words
 * @property string $customer_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $created_by
 * @property integer $updated_by
 *
 * @property \app\models\Customers $customer
 * @property \app\models\State $btpState
 * @property \app\models\InvoiceOrderItem[] $invoiceOrderItems
 */
class InvoiceOrder extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gst_in', 'PAN', 'gst_invoice_no', 'challan_no', 'po_no', 'btp_state', 'btp_code', 'btp_gstin', 'total_before_tax', 'total_tax_amount', 'total_amount_after_tax', 'grabd_total', 'amount_in_words', 'customer_id', 'status'], 'required'],
            [['gst_invoice_no', 'challan_no', 'btp_state', 'customer_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['gst_invoice_date', 'challan_date', 'po_date', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['btp_address'], 'string'],
            [['total_before_tax', 'cgst', 'sgst', 'igst', 'total_tax_amount', 'total_amount_after_tax', 'grabd_total'], 'number'],
            [['gst_in', 'PAN', 'mode_of_transport', 'btp_code', 'btp_gstin'], 'string', 'max' => 100],
            [['amount_in_words'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice_order';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gst_in' => 'Gst In',
            'PAN' => 'Pan',
            'gst_invoice_no' => 'Gst Invoice No',
            'gst_invoice_date' => 'Gst Invoice Date',
            'challan_no' => 'Challan No',
            'challan_date' => 'Challan Date',
            'po_no' => 'Po No',
            'po_date' => 'Po Date',
            'mode_of_transport' => 'Mode Of Transport',
            'btp_address' => 'Btp Address',
            'btp_state' => 'Btp State',
            'btp_code' => 'Btp Code',
            'btp_gstin' => 'Btp Gstin',
            'total_before_tax' => 'Total Before Tax',
            'cgst' => 'Cgst',
            'sgst' => 'Sgst',
            'igst' => 'Igst',
            'total_tax_amount' => 'Total Tax Amount',
            'total_amount_after_tax' => 'Total Amount After Tax',
            'grabd_total' => 'Grand Total',
            'amount_in_words' => 'Amount In Words',
            'customer_id' => 'Customer ID',
            'status' => 'Status',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(\app\models\Customers::className(), ['id' => 'customer_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBtpState()
    {
        return $this->hasOne(\app\models\State::className(), ['StateID' => 'btp_state']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInvoiceOrderItems()
    {
        return $this->hasMany(\app\models\InvoiceOrderItem::className(), ['order_id' => 'id']);
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
     * @return \app\models\InvoiceOrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\InvoiceOrderQuery(get_called_class());
    }
}
