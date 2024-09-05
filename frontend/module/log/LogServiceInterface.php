<?php

namespace frontend\module\log;

interface LogServiceInterface
{
    public function send(string $message): void;

    public function sendByLogger(string $message, string $loggerType): void;

    public function getType(): string;

    public function setType(string $type): void;
}