<?php
// Рисует HTML. Подключает Twig и передает в шаблоны заголовок страницы и текущий URL
require_once "BaseController.php";

class TwigBaseController extends BaseController {
    public $title = "";
    public $template = "";
    protected \Twig\Environment $twig;

    public function setTwig($twig) {
        $this->twig = $twig;
    }

    public function getContext(): array {
        $context = parent::getContext();

        // Передаем заголовок страницы и текущий URL
        $context['title'] = $this->title;
        $context['current_url'] = $_SERVER['REQUEST_URI'];

        return $context;
    }

    public function get(array $context) {
        echo $this->twig->render($this->template, $context);
    }
}