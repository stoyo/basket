<?php

use Cart\App;
use Illuminate\Database\Capsule\Manager as Capsule;
use Slim\Views\Twig;

session_start();

require __DIR__.'/../vendor/autoload.php';

$app=new App;

$container = $app->getContainer();

$dotenv = new Dotenv\Dotenv('../');
$dotenv->load();

$capsule = new Capsule;
$capsule->addConnection([
    'driver'=>'mysql',
    'host'=>'localhost',
    'database'=>getenv('DB_DATABASE'),
    'username'=>getenv('DB_USERNAME'),
    'password'=>getenv('DB_PASSWORD'),
    'charset'=>'utf8',
    'collation'=>'utf8_general_ci',
    'prefix'=>''
]);
$capsule->setAsGlobal();
$capsule->bootEloquent();

Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId(getenv('BRAINTREE_MERCHANT_ID'));
Braintree_Configuration::publicKey(getenv('BRAINTREE_PUBLIC_KEY'));
Braintree_Configuration::privateKey(getenv('BRAINTREE_PRIVATE_KEY'));

require __DIR__.'/../app/routes.php';

$app->add(new \Cart\Middleware\ValidationErrorsMiddleware($container->get(Twig::class)));
$app->add(new \Cart\Middleware\OldInputMiddleware($container->get(Twig::class)));