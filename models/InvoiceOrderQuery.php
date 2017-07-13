<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[InvoiceOrder]].
 *
 * @see InvoiceOrder
 */
class InvoiceOrderQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return InvoiceOrder[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return InvoiceOrder|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}