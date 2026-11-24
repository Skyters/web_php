<?php
// Хранит подключение к БД, параметры из URL и решает, вызвать метод get (показать страницу) или post (обработать форму). ведется история посещений.
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
