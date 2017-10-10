<?php

use OCLC\Auth\WSKey;
use OCLC\User;
use Symfony\Component\Yaml\Yaml;

// DIC configuration
$container = $app->getContainer();

// -----------------------------------------------------------------------------
// Service providers
// -----------------------------------------------------------------------------

$container['config'] = function ($c) {
    global $config_file;
    return Yaml::parse($config_file);
};

$container['wskey'] = function ($c) {

    $services = array('WorldCatMetadataAPI');
    $options = array('services' => $services);
    return new WSKey($c->get("config")['prod']['wskey'], $c->get("config")['prod']['secret'], $options);
};

$container['user'] = function ($c) {
    return new User($c->get("config")['prod']['institution'], $c->get("config")['prod']['principalID'], $c->get("config")['prod']['principalIDNS']);
};

// Register twig views on container
$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig('app/views', [
        'cache' => 'app/cache'
    ]);

    // Instantiate and add Slim specific extension
    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));
    $view->getEnvironment()->addGlobal('session', $_SESSION);

    return $view;
};

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};



