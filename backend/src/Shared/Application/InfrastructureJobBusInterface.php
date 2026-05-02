<?php

namespace App\Shared\Application;

interface InfrastructureJobBusInterface
{
    public function dispatch(InfrastructureJobInterface $job): void;
}
