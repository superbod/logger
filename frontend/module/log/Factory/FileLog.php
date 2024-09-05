<?php

namespace frontend\module\log\Factory;

use frontend\module\log\Factory\Interfaces\Logger;
use Yii;

class FileLog implements Logger
{
    public function log(string $message): bool
    {
        try {
            $file = Yii::getAlias('@app') . '/log.txt';

            if (!file_exists($file)) {
                $myFile = fopen($file, "w");
                fclose($myFile);
            }

            $current = file_get_contents($file);
            $current .= $message . "\n";
            file_put_contents($file, $current);
        } catch (\Throwable $exception) {
            return false;
        }

        return true;
    }
}