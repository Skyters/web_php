<?php

require_once '../vendor/autoload.php';
require_once '../controllers/MainController.php';
require_once '../controllers/SaberController.php';
require_once '../controllers/SaberImageController.php';
require_once '../controllers/SaberInfoController.php';
require_once '../controllers/ThroneHeroesController.php';
require_once '../controllers/ThroneHeroesImageController.php';
require_once '../controllers/ThroneHeroesInfoController.php';
require_once '../controllers/ArcherController.php';
require_once '../controllers/ArcherImageController.php';
require_once '../controllers/ArcherInfoController.php';
require_once '../controllers/Controller404.php';

$loader = new \Twig\Loader\FilesystemLoader('../views');
$twig   = new \Twig\Environment($loader);

$url = $_SERVER['REQUEST_URI'];

$controller = new Controller404($twig);

if ($url == '/') {
    $controller = new MainController($twig);

} elseif (preg_match('#^/saber/image#', $url)) {
    $controller = new SaberImageController($twig);
} elseif (preg_match('#^/saber/info#', $url)) {
    $controller = new SaberInfoController($twig);
} elseif (preg_match('#^/saber#', $url)) {
    $controller = new SaberController($twig);

} elseif (preg_match('#^/throneheroes/image#', $url)) {
    $controller = new ThroneHeroesImageController($twig);
} elseif (preg_match('#^/throneheroes/info#', $url)) {
    $controller = new ThroneHeroesInfoController($twig);
} elseif (preg_match('#^/throneheroes#', $url)) {
    $controller = new ThroneHeroesController($twig);

} elseif (preg_match('#^/archer/image#', $url)) {
    $controller = new ArcherImageController($twig);
} elseif (preg_match('#^/archer/info#', $url)) {
    $controller = new ArcherInfoController($twig);
} elseif (preg_match('#^/archer#', $url)) {
    $controller = new ArcherController($twig);
}

$controller->get();
