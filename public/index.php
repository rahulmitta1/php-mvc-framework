`<?php

use app\controllers\AuthController;
use ramit\phpmvc\Application;
use app\controllers\SiteController;
use app\models\User;
use Dotenv\Dotenv;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

try {
    main();
} catch (\Throwable $th) {
    // throw $th;
    echo $th->__toString();
}

function main()
{
    $config = [
        'userClass' => User::class,
        'db' => [
            'dsn' => $_ENV['DB_DSN'],
            'user' => $_ENV['DB_USER'],
            'password' => $_ENV['DB_PASSWORD'],
        ]
    ];
    $app = new Application(dirname(__DIR__), $config);
    $app->on(Application::EVENT_BEFORE_REQUEST, function(){
        echo "Before request";
    });

    $app->router->get('/', [SiteController::class, 'home']);

    $app->router->get('/contact',  [SiteController::class, 'contact']);
    $app->router->post('/contact', [SiteController::class, 'contact']);

    $app->router->get('/login',  [AuthController::class, 'login']);
    $app->router->get('/login/{id}', [AuthController::class, 'login']);
    $app->router->post('/login', [AuthController::class, 'login']);

    $app->router->get('/logout', [AuthController::class, 'logout']);

    $app->router->get('/profile', [AuthController::class, 'profile']);
    $app->router->get('/profile/{id:\d+}/{username}', [AuthController::class, 'profile']);

    $app->router->get('/register',  [AuthController::class, 'register']);
    $app->router->post('/register', [AuthController::class, 'register']);


    $app->run();
}
