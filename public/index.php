<?php


error_reporting(E_ALL);
ini_set('display_errors', '1');

require_once "../vendor/autoload.php";
require_once "../framework/autoload.php";
require_once "../controllers/BaseSpaceTwigController.php";
require_once "../controllers/MainController.php";
require_once "../controllers/ObjectController.php";
require_once "../controllers/SearchController.php";
require_once "../controllers/FateObjectCreateController.php";
require_once "../controllers/FateTypeCreateController.php";
require_once "../controllers/FateObjectDeleteController.php";
require_once "../controllers/FateObjectUpdateController.php";
require_once "../middlewares/LoginRequiredMiddeware.php";
require_once "../controllers/SetWelcomeController.php";
require_once "../controllers/LoginController.php";
require_once "../controllers/LogoutController.php";
require_once "../controllers/Controller404.php";



$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig = new \Twig\Environment($loader, [
    "debug" => true // добавляем тут debug режим
]);
$twig->addExtension(new \Twig\Extension\DebugExtension()); // и активируем расширение

// создаем экземпляр класса и передаем в него параметры подключения
// создание класса автоматом открывает соединение
$pdo = new PDO("mysql:host=localhost;dbname=fate;charset=utf8", "root", "");

$router = new Router($twig, $pdo);
$router->add("/", MainController::class);
// помните нашу регулярку, которую выше, делали, собственно вот сюда ее и загнали
$router->add("/fate-object/(?P<id>\d+)", ObjectController::class);
$router->add("/search", SearchController::class);
$router->add("/fate-object/create", FateObjectCreateController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->add("/fate-type/create", FateTypeCreateController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->add("/fate-object/delete", FateObjectDeleteController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->add("/fate-object/(?P<id>\d+)/edit", FateObjectUpdateController::class)
        ->middleware(new LoginRequiredMiddeware());
$router->add("/set-welcome", SetWelcomeController::class);
$router->add("/login", LoginController::class);
$router->add("/logout", LogoutController::class);

$router->get_or_default(Controller404::class);