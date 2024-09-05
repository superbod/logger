<?php

namespace frontend\module\log;

use frontend\module\log\Factory\DBLogCreator;
use frontend\module\log\Factory\FileLogCreator;
use frontend\module\log\Factory\LogCreator;
use frontend\module\log\Factory\MailLogCreator;

class LogService implements LogServiceInterface
{
    private LogCreator $logger;
    private string $type;

    public const AVAILABLE_LOGGERS = [
        'db' => DBLogCreator::class,
        'mail' => MailLogCreator::class,
        'file' => FileLogCreator::class,
    ];

    public function __construct()
    {
        $defaultLoggerType = \Yii::$app->params['logger'];
        $defaultLoggerClass = self::AVAILABLE_LOGGERS[$defaultLoggerType];
        $this->type = $defaultLoggerType;
        $this->logger = new $defaultLoggerClass();
    }

    public function send(string $message): void
    {
        $this->logger->sendMessage($message);
    }

    public function sendByLogger(string $message, string $loggerType): void
    {
        /** @var LogCreator $logger */
        $logger = new $loggerType();
        $logger->sendMessage($message);
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
        $loggerClass = self::AVAILABLE_LOGGERS[$type];
        $this->logger = new $loggerClass();
    }
}