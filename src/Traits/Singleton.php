<?php

namespace App\Traits;

trait Singleton
{
    /**
     * @var Singleton|null
     */
    private static self|null $instance = null;

    final function __construct() { }
    final function __clone() { }

    final function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }

    /**
     * @return static
     */
    public static function getInstance(): static
    {
        if (static::$instance === null) {
            static::$instance = new static;
        }

        return static::$instance;
    }
}
