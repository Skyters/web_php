<?php
// Страница поиска
class SearchController extends BaseFateTwigController {
    public $template = "search.twig";

    public function getContext(): array
    {
        $context = parent::getContext();

        // Берем данные из URL или пустая строка.
        $type = isset($_GET['object_type']) ? $_GET['object_type'] : '';
        $title = isset($_GET['title']) ? trim($_GET['title']) : '';
        $description = isset($_GET['description']) ? trim($_GET['description']) : '';

        // Сохраняем значения
        $context['search_title'] = $title;
        $context['search_description'] = $description;
        $context['search_type'] = $type;

        $sql = <<<EOL
SELECT id, title
FROM fate_objects
WHERE (:title = '' OR title like CONCAT('%', :title, '%'))
AND (:type = '' OR type = :type)
AND (:description = '' OR description LIKE CONCAT('%', :description, '%'))
EOL;

        $query = $this->pdo->prepare($sql);

        // Передаем данные в запрос
        $query->bindValue("title", $title);
        $query->bindValue("type", $type);
        $query->bindValue("description", $description);
        $query->execute();

        $context['objects'] = $query->fetchAll();

        return $context;
    }
}