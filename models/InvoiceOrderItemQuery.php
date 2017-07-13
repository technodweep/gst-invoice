<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[InvoiceOrderItem]].
 *
 * @see InvoiceOrderItem
 */
class InvoiceOrderItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return InvoiceOrderItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return InvoiceOrderItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}