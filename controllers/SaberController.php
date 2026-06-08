<?php

require_once "TwigBaseController.php";

class SaberController extends TwigBaseController {
    public $title    = "Сейбер";
    public $template = "__object.twig";

    public function getContext(): array {
        $context = parent::getContext();

        $context['object'] = [
            'slug'     => 'saber',
            'title'    => 'Сейбер',
            'subtitle' => 'Тут мы вам расскажем о легендарном классе Сэйбер',
            'url'      => '/saber',
        ];
        $context['info_text'] = 'Сэйбер (セイバー, Seibā?, Saber) — Рыцарь Меча и Героическая Душа Меча,
            один из Трёх Рыцарских классов среди семи стандартных классов Слуг, призываемых в Войне
            Святого Грааля. Считается, что класс Сэйбер — лучший из семи классов, и самый сильный
            из Слуг, так как они участвовали в финальных битвах предыдущих четырёх Войн Грааля.';

        return $context;
    }
}
