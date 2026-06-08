<?php

require_once "TwigBaseController.php";

class ArcherController extends TwigBaseController {
    public $title    = "Арчер";
    public $template = "__object.twig";

    public function getContext(): array {
        $context = parent::getContext();

        $context['object'] = [
            'slug'     => 'archer',
            'title'    => 'Арчер',
            'subtitle' => 'Тут мы вам расскажем о метком классе Арчер',
            'url'      => '/archer',
        ];
        $context['info_text'] = 'Арчер (アーチャー, Āchā?, Archer) — Рыцарь Лука и Героическая Душа Лука,
            один из Трёх Рыцарских классов среди семи стандартных классов Слуг, призываемых в Войне
            Святого Грааля. Вопреки названию класса, Арчеры не обязательно используют лук —
            квалификационным условием является сам стиль ведения боя на расстоянии. Среди классовых
            навыков выделяются: «Независимое Действие» (позволяет существовать без Мастера на
            протяжении нескольких дней) и «Острое Зрение» (резко повышает точность и дальность атаки).';

        return $context;
    }
}
