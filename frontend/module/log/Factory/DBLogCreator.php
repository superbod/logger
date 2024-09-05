<?php

namespace frontend\module\log\Factory;

use frontend\module\log\Factory\Interfaces\Logger;

class DBLogCreator extends LogCreator
{
    public function factoryMethod(): Logger
    {
        return new DBLog();
    }
}