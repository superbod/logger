<?php

namespace frontend\module\log;

class DummyMailer
{
    public function sendEmail(string $message, string $email): bool
    {
        return true;
    }
}