<?php

class FateTypeCreateController extends BaseSpaceTwigController {
    public $template = "fate_type_create.twig";

    public function post(array $context) {
        $title = $_POST['title'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $name = $_FILES['image']['name'];
        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";

        $query = $this->pdo->prepare("INSERT INTO fate_types(title, image) VALUES(:title, :image)");
        $query->bindValue("title", $title);
        $query->bindValue("image", $image_url);
        $query->execute();

        $context['message'] = 'Тип успешно добавлен';
        $this->get($context);
    }
}