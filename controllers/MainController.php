<?php

require_once "TwigBaseController.php";

class MainController extends TwigBaseController {
    public $title    = "Главная";
    public $template = "main.twig";

    public function getContext(): array {
        $context = parent::getContext();

        $context['menu_items'] = [
            ['title' => 'Сейбер',      'url' => '/saber'],
            ['title' => 'Трон Героев', 'url' => '/throneheroes'],
            ['title' => 'Арчер',       'url' => '/archer'],
        ];

        return $context;
    }
}
