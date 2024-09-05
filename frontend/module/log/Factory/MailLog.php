<?php

namespace frontend\module\log\Factory;

use frontend\module\log\DummyMailer;
use frontend\module\log\Factory\Interfaces\Logger;

class MailLog implements Logger
{
    public function log(string $message): bool
    {
        $mailer = \Yii::$container->get(DummyMailer::class);
        $email = \Yii::$app->params['loggerEmail'];

        return $mailer->sendEmail($message, $email);
    }
}