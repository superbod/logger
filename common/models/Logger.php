<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * Logget model
 *
 * @property integer $id
 * @property string $message
 * @property string $created_at
 */
class Logger extends ActiveRecord
{
    public static function tableName()
    {
        return '{{%logger}}';
    }
}