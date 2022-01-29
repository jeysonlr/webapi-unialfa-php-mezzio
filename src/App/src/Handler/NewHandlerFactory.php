<?php

declare(strict_types=1);

namespace App\Handler;

class NewHandlerFactory
{
    public function __invoke(): NewHandler
    {
        return new NewHandler();
    }
}
