<?php

namespace App\Shared\Application;

interface QueryBusInterface
{
    public function ask(object $query): QueryResult;
}
