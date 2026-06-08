<?php

require_once "BaseController.php";

class TwigBaseController extends BaseController {
    public $title    = "";
    public $template = "";
    protected \Twig\Environment $twig;

    public function __construct($twig) {
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

    public function get() {
        echo $this->twig->render($this->template, $this->getContext());
    }
}
