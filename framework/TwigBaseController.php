<?php

require_once "BaseController.php";

class TwigBaseController extends BaseController {
    public $title    = "";
    public $template = "";
    protected \Twig\Environment $twig;

    public function setTwig($twig) {
        $this->twig = $twig;
    }

    public function getContext(): array {
        $context = parent::getContext();

        $context['title']       = $this->title;
        $context['current_url'] = $_SERVER['REQUEST_URI'];
        $context['menu']  = [
            ['title' => 'Главная',     'url' => '/'],
            ['title' => 'Сейбер',      'url' => '/saber'],
            ['title' => 'Трон Героев', 'url' => '/throneheroes'],
            ['title' => 'Арчер',       'url' => '/archer'],
        ];

        return $context;
    }

    public function get(array $context) { // добавил аргумент в get
        echo $this->twig->render($this->template, $context); // а тут поменяем getContext на просто $context
    }
}
