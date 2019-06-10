<?php
$app->group('/{lang}/', function () use ($app, $container) {

    $this->get('', 'HomeController:index')->setName('index');
    $this->post('post-form', 'FormController:postForm')->setName('index.form');

});


