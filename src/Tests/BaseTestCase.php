<?php

namespace Springbuck\LaravelCoinhive\Tests;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Contracts\Console\Kernel;

abstract class BaseTestCase extends TestCase
{
    public function createApplication()
    {
        
        $app = require __DIR__.'/../../../../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }
}
