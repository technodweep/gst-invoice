<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Products]].
 *
 * @see Products
 */
class ProductsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return Products[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Products|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}