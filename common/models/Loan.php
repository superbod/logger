<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Loan model
 *
 * @property integer $id
 * @property integer $userId
 * @property integer $amount
 * @property integer $term
 * @property integer $status
 * @property string $purpose
 * @property integer $monthly_income
 */
class Loan extends ActiveRecord
{
    const PENDING = 0;
    const APPROVED = 1;
    const REJECTED = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%loan}}';
    }
}