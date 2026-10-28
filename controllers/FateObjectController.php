<?php

class FateObjectController extends BaseFateTwigController {
    public $template = "__object.twig";

public function getContext(): array
{
    $context = parent::getContext();
    
    $query = $this->pdo->prepare("SELECT * FROM fate_objects WHERE id= :my_id");
    $query->bindValue("my_id", $this->params['id']);
    $query->execute();
    $data = $query->fetch();
    
    $context['object'] = $data;
    $context['description'] = $data['description'];
    $context['info_text'] = $data['info'];
    
    $context['messages'] = isset($_SESSION['messages']) ? $_SESSION['messages'] : [];

    return $context;
}

    public function get(array $context) {
        $show = $_GET['show'] ?? null;
        if ($show == 'image') {
            $this->template = "image.twig";
        } elseif ($show == 'info') {
            $this->template = "general_info.twig";
        }
        parent::get($context);
    }
}