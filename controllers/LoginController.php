<?php

class LoginController extends TwigBaseController {
    public $template = "login.twig";

    public function post(array $context) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = $this->pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
        $query->bindValue("username", $username);
        $query->bindValue("password", $password);
        $query->execute();

        $user = $query->fetch();

        if ($user) {
            $_SESSION['is_logged'] = true;
            header("Location: /");
            exit;
        } else {
            $context['error'] = 'Неверный логин или пароль';
            parent::get($context);
        }
    }
}