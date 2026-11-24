<?php

// Берет id из URL, достает героя из БД.
class FateObjectController extends BaseFateTwigController {
    public $template = "__object.twig";

public function getContext(): array
{
    $context = parent::getContext();
    
    $query = $this->pdo->prepare("
        SELECT         
            fate_objects.id, 
            fate_objects.title, 
            fate_objects.description, 
            fate_objects.info, 
            fate_objects.image, 
            fate_objects.type,
            fate_types.title AS type_title  
        FROM fate_objects
        LEFT JOIN fate_types ON fate_objects.type = fate_types.id 
        WHERE fate_objects.id = :my_id
    ");
    $query->bindValue("my_id", $this->params['id']);
    $query->execute();
    $data = $query->fetch();
    
    $context['object'] = $data;
    
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