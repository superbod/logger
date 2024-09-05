<?php

namespace frontend\module\log\Factory\Interfaces;

interface Logger
{
    public function log(string $message): bool;
}