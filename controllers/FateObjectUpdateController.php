<?php

class FateObjectUpdateController extends BaseSpaceTwigController {
    public $template = "space_object_edit.twig";

    public function get(array $context)
    {
        $id = $this->params['id'];

        $query = $this->pdo->prepare("SELECT * FROM fate_objects WHERE id = :id");
        $query->bindValue("id", $id);
        $query->execute();

        $data = $query->fetch();
        $context['object'] = $data;

        parent::get($context);
    }

    public function post(array $context) {
        $id = $this->params['id'];
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];

        $tmp_name = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];

        if ($name) {
            move_uploaded_file($tmp_name, "../public/media/$name");
            $image_url = "/media/$name";
        } else {
            $image_url = $_POST['current_image'];
        }

        $sql = <<<EOL
UPDATE fate_objects SET title=:title, description=:description, type=:type, info=:info, image=:image
WHERE id=:id
EOL;

        $query = $this->pdo->prepare($sql);
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image", $image_url);
        $query->bindValue("id", $id);
        $query->execute();

        header("Location: /fate-object/$id");
        exit;
    }
}