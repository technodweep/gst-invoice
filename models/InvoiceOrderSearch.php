<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\InvoiceOrder;

/**
 * app\models\InvoiceOrderSearch represents the model behind the search form about `app\models\InvoiceOrder`.
 */
 class InvoiceOrderSearch extends InvoiceOrder
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'gst_invoice_no', 'challan_no', 'po_no', 'btp_state', 'customer_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['gst_in', 'PAN', 'gst_invoice_date', 'challan_date', 'po_date', 'mode_of_transport', 'btp_address', 'btp_code', 'btp_gstin', 'amount_in_words'], 'safe'],
            [['total_before_tax', 'cgst', 'sgst', 'igst', 'total_tax_amount', 'total_amount_after_tax', 'grabd_total'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = InvoiceOrder::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'gst_invoice_no' => $this->gst_invoice_no,
            'gst_invoice_date' => $this->gst_invoice_date,
            'challan_no' => $this->challan_no,
            'challan_date' => $this->challan_date,
            'po_no' => $this->po_no,
            'po_date' => $this->po_date,
            'btp_state' => $this->btp_state,
            'total_before_tax' => $this->total_before_tax,
            'cgst' => $this->cgst,
            'sgst' => $this->sgst,
            'igst' => $this->igst,
            'total_tax_amount' => $this->total_tax_amount,
            'total_amount_after_tax' => $this->total_amount_after_tax,
            'grabd_total' => $this->grabd_total,
            'customer_id' => $this->customer_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'gst_in', $this->gst_in])
            ->andFilterWhere(['like', 'PAN', $this->PAN])
            ->andFilterWhere(['like', 'mode_of_transport', $this->mode_of_transport])
            ->andFilterWhere(['like', 'btp_address', $this->btp_address])
            ->andFilterWhere(['like', 'btp_code', $this->btp_code])
            ->andFilterWhere(['like', 'btp_gstin', $this->btp_gstin])
            ->andFilterWhere(['like', 'amount_in_words', $this->amount_in_words]);

        return $dataProvider;
    }
}
