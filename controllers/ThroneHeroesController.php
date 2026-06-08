<?php

require_once "TwigBaseController.php";

class ThroneHeroesController extends TwigBaseController {
    public $title    = "Трон Героев";
    public $template = "__object.twig";

    public function getContext(): array {
        $context = parent::getContext();

        $context['object'] = [
            'slug'     => 'throneheroes',
            'title'    => 'Трон Героев',
            'subtitle' => 'Тут мы вам расскажем о таинственном Троне Героев',
            'url'      => '/throneheroes',
        ];
        $context['info_text'] = 'Трон Героев — метафизическое явление во вселенной Fate, существующее
            за пределами нашей реальности. Для него не существует концепции времени. Поэтому туда могут
            попасть как герои далёкого прошлого, так и герои современности, и даже герои из далёкого
            будущего. Трон Героев создан Алайей, которая воплощает коллективное бессознательное
            человечества. Героические души в Троне Героев не обладают самосознанием — они просто
            сгусток энергии, которые на подсознательном уровне получают информацию от своих аватаров
            в войнах за Грааль.';

        return $context;
    }
}
