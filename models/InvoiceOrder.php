<?php

namespace app\models;

use Yii;
use \app\models\base\InvoiceOrder as BaseInvoiceOrder;

/**
 * This is the model class for table "invoice_order".
 */
class InvoiceOrder extends BaseInvoiceOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['gst_in', 'PAN', 'gst_invoice_no', 'challan_no', 'po_no', 'btp_address', 'btp_state', 'btp_code', 'btp_gstin', 'total_before_tax', 'total_tax_amount', 'total_amount_after_tax', 'grabd_total', 'amount_in_words', 'customer_id', 'status'], 'required'],
            [['gst_invoice_no', 'challan_no', 'btp_state', 'customer_id', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['gst_invoice_date', 'challan_date', 'po_date', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'safe'],
            [['btp_address'], 'string'],
            [['total_before_tax', 'cgst', 'sgst', 'igst', 'total_tax_amount', 'total_amount_after_tax', 'grabd_total'], 'number'],
            [['gst_in', 'PAN', 'mode_of_transport', 'btp_code', 'btp_gstin'], 'string', 'max' => 100],
            [['amount_in_words'], 'string', 'max' => 255]
        ]);
    }
	
}
