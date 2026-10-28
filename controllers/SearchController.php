<?php

class SearchController extends BaseSpaceTwigController {
    public $template = "search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        $type = isset($_GET['object_type']) ? $_GET['object_type'] : '';
        $title = isset($_GET['title']) ? $_GET['title'] : '';
        $description = isset($_GET['description']) ? $_GET['description'] : '';
        $sql = <<<EOL
SELECT id, title
FROM fate_objects
WHERE (:title = '' OR title like CONCAT('%', :title, '%'))
AND (:type = '' OR type = :type)
AND (:description = '' OR description LIKE CONCAT('%', :description, '%'))
EOL;

        $query = $this->pdo->prepare($sql);

        $query->bindValue("title", $title);
        $query->bindValue("type", $type);
        $query->bindValue("description", $description);
        $query->execute();

        $context['objects'] = $query->fetchAll();

        return $context;
    }
}