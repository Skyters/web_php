<?php

abstract class BaseController {

    public PDO $pdo;
    public array $params = [];

    public function setParams(array $params) {
        $this->params = $params;
    }

    public function setPDO(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function getContext(): array {
        return [];
    }

    public function process_response() {
        //  сохранение историй посещений
        if (!isset($_SESSION['history'])) {
            $_SESSION['history'] = [];
        }
        $current_url = $_SERVER['REQUEST_URI'];
        // удалить если уже есть в истории
        $_SESSION['history'] = array_filter($_SESSION['history'], fn($url) => $url !== $current_url);
        // добавить в начало
        array_unshift($_SESSION['history'], $current_url);
        // оставить только 10
        $_SESSION['history'] = array_slice(array_values($_SESSION['history']), 0, 10);

        $method = $_SERVER['REQUEST_METHOD']; // вытаскиваем метод
        $context = $this->getContext(); // вызываю context тут
        if ($method == 'GET') { // если GET запрос то вызываем get
            $this->get($context);
        } else if ($method == 'POST') { // если POST запрос то вызываем get
            $this->post($context);
        }
    }

    public function get(array $context) {} 
    public function post(array $context) {}
}
