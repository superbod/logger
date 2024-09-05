<?php

namespace frontend\controllers;

use frontend\module\log\LogService;
use yii\web\Controller;

class LogController extends Controller
{
    public LogService $loggerService;

    public function __construct($id, $module, $config = [])
    {
        $this->loggerService = \Yii::$container->get(LogService::class);

        parent::__construct($id, $module, $config);
    }

    public function actionIndex(): string
    {
        return $this->render('index');
    }

    /** Sends a log message to the default logger. */
    public function actionLog(): string
    {
        try {
            $this->loggerService->send('test_log');
        } catch (\Throwable $exception) {
            return 'Something went wrong ' . $exception->getMessage();
        }

        return $this->render('log',
            [
                'result' => 'send Message to defaultLogger (' . $this->loggerService->getType() . ')',
            ]
        );
    }

    /**
     * Sends a log message to a special logger.
     */
    public function actionLogTo(string $type): string
    {
        try {
            $this->loggerService->sendByLogger('send_by_specific_logger', LogService::AVAILABLE_LOGGERS[$type]);
        } catch (\Throwable $exception) {
            return 'Something went wrong ' . $exception->getMessage();
        }

        return $this->render('log', ['result' => 'Send log to selected logger (' . $type . ')']);
    }

    /**
     * Sends a log message to all loggers.
     */
    public function actionLogToAll(): string
    {
        try {
            foreach (LogService::AVAILABLE_LOGGERS as $logger) {
                $this->loggerService->sendByLogger('send_by_specific_logger', $logger);
            }
        } catch (\Throwable $exception) {
            return 'Something went wrong ' . $exception->getMessage();
        }

        return $this->render('log', ['result' => 'Senf log to all logger']);
    }
}