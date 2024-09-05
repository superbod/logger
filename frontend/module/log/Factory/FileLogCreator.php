<?php

namespace frontend\module\log\Factory;

use frontend\module\log\Factory\Interfaces\Logger;

class FileLogCreator extends LogCreator
{
    public function factoryMethod(): Logger
    {
        return new FileLog();
    }
}