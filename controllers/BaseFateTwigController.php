<?php

class BaseFateTwigController extends TwigBaseController {
    public function getContext(): array
    {
        $context = parent::getContext();

        $query = $this->pdo->query("SELECT * FROM fate_types ORDER BY id");
        $types = $query->fetchAll();
        $context['types'] = $types;

        $context['history'] = isset($_SESSION['history']) ? $_SESSION['history'] : [];

        return $context;
    }
}