<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Libraries\LoadEnvironments;
use App\Traits\Singleton;

class LoadEnvironmentsTest extends TestCase
{

    public function testLoadEnvInstance1()
    {
        $instance1 = LoadEnvironments::getInstance();
        $instance2 = LoadEnvironments::getInstance();

        $this->assertEquals($instance1, $instance2);
    }
}