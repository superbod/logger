<?php

namespace frontend\module\log\Factory;

use frontend\module\log\Factory\Interfaces\Logger;

abstract class LogCreator
{
    abstract public function factoryMethod(): Logger;

    public function sendMessage(string $message): string
    {
        $logger = $this->factoryMethod();

        return $logger->log($message);
    }
}