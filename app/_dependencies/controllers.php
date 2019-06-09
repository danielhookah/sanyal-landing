<?php

/**
 * @param $container
 * @return \App\Controllers\HomeController
 */
$container['HomeController'] = function ($container) {
    return new \App\Controllers\HomeController($container);
};

/**
 * @param $container
 * @return \App\Controllers\FormController
 */
$container['FormController'] = function ($container) {
    return new \App\Controllers\FormController($container);
};
