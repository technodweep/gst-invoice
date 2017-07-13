<?php

namespace app\models\base;

use Yii;

/**
 * This is the base model class for table "settings".
 *
 * @property integer $id
 * @property string $meta_key
 * @property string $meta_value
 */
class Settings extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meta_key', 'meta_value'], 'required'],
            [['meta_value'], 'string'],
            [['meta_key'], 'string', 'max' => 36],
            [['meta_key'], 'unique']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'meta_key' => 'Meta Key',
            'meta_value' => 'Meta Value',
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\SettingsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\SettingsQuery(get_called_class());
    }
}
