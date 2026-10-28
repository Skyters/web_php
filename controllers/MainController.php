<?php
require_once "BaseFateTwigController.php";

class MainController extends BaseFateTwigController {
    public $title    = "Главная";
    public $template = "main.twig";

    public function getContext(): array
    {
        $context = parent::getContext();
        
        if(isset($_GET['type'])) {
            $query = $this->pdo->prepare("SELECT * FROM fate_objects WHERE type = :type");
            $query->bindValue("type", $_GET['type']);
            $query->execute();
        } else {
            $query = $this->pdo->query("SELECT * FROM fate_objects");
        }
                
        // стягиваем данные через fetchAll() и сохраняем результат в контекст
        $context['fate_objects'] = $query->fetchAll();

        return $context;
    }
}
