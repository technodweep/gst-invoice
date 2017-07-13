<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TaxSettings]].
 *
 * @see TaxSettings
 */
class TaxSettingsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return TaxSettings[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TaxSettings|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}