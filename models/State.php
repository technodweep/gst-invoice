<?php

namespace app\models;

use Yii;
use \app\models\base\State as BaseState;

/**
 * This is the model class for table "state".
 */
class State extends BaseState
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['CountryID', 'StateName'], 'required'],
            [['CountryID'], 'integer'],
            [['StateName'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
