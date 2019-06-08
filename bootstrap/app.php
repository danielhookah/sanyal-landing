<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);

$dotenv = new Dotenv\Dotenv(__DIR__ . '/../');
$dotenv->load();

require __DIR__ . '/config.php';

/**
 * @var \Slim\App $app
 */
$app = new \Slim\App([
    'settings' => [
        'translations_path' => __DIR__ . '/../app/Translations',
        'displayErrorDetails' => true,
        'db' => $dbConnector,
    ],
]);

/**
 * @var \Slim\Container $container
 */
$container = $app->getContainer();

// db connection
$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
    $dbConnector['meta']['entity_path'], $dbConnector['meta']['auto_generate_proxies'], $dbConnector['meta']['proxy_dir'], $dbConnector['meta']['cache'], false
);

$em = \Doctrine\ORM\EntityManager::create(
    $dbConnector['connection'], $config
);
$container['em'] = $em;
$container['db'] = function ($container) {
    return $container['settings']['db']['connection']['driver'];
};

/**
 * @param $c
 * @return Closure
 */
$container['notFoundHandler'] = function ($c) {
    return function ($request, $response) use ($c) {
        return $c['view']->render($response->withStatus(404), '404.html.twig', []);
    };
};

/**
 * @param $container
 * @return \Slim\Views\Twig
 */
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'debug' => true,
        'cache' => false
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension($container->router, $container->request->getUri()));
    $view->addExtension(new Umpirsky\Twig\Extension\PhpFunctionExtension());
    $view->addExtension(new Twig_Extension_Debug());

    return $view;
};

require __DIR__ . '/../app/_dependencies/functions.php';
require __DIR__ . '/../app/_dependencies/services/services.php';
require __DIR__ . '/../app/_dependencies/controllers/controllers.php';
require __DIR__ . '/../api/_dependencies/controllers.php';
require __DIR__ . '/../app/_routes/routes.php';
