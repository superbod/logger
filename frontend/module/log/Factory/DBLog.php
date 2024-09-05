<?php

namespace frontend\module\log\Factory;

use frontend\module\log\Factory\Interfaces\Logger;
use yii\db\Exception;

class DBLog implements Logger
{
    /**
     * @throws Exception
     */
    public function log(string $message): bool
    {
        $logger = new \common\models\Logger();
        $logger->message = $message;

        return $logger->save();
    }
}