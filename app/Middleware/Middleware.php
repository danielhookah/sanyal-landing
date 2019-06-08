<?php

namespace App\Middleware;

use Slim\Container;

/**
 * Class Middleware
 * @package App\Middleware
 */
abstract class Middleware {

    /**
     * @var Container
     */
    protected $container;

    /**
     * Middleware constructor.
     * @param Container $container
     */
    public function __construct($container) {
        $this->container = $container;
    }

}