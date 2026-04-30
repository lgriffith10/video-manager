<?php

namespace App\Shared\Application;

interface CommandBusInterface
{
    public function dispatch(object $command): CommandResult;
}

