<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "tax_settings".
 *
 * @property integer $id
 * @property string $tax_key
 * @property string $tax_percent
 * @property integer $status
 */
class TaxSettings extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tax_key', 'tax_percent', 'status'], 'required'],
            [['tax_percent'], 'number'],
            [['status'], 'integer'],
            [['tax_key'], 'string', 'max' => 100],
            [['tax_key'], 'unique']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tax_settings';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tax_key' => 'Tax Key',
            'tax_percent' => 'Tax Percent',
            'status' => 'Status',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\TaxSettingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\TaxSettingsQuery(get_called_class());
    }
}
