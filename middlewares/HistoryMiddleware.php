<?php

class HistoryMiddleware extends BaseMiddleware {
    public function apply(BaseController $controller, array $context)
    {
        // 1. Проверяем, существует ли массив истории в сессии, если нет - создаем
        if (!isset($_SESSION['history'])) {
            $_SESSION['history'] = [];
        }

        // 2. Получаем текущий URL
        $current_url = $_SERVER['REQUEST_URI'];

        // 3. Удаляем этот URL из истории, если он там уже есть (чтобы не было дублей)
        $_SESSION['history'] = array_filter($_SESSION['history'], fn($url) => $url !== $current_url);

        // 4. Добавляем текущий URL в начало массива
        array_unshift($_SESSION['history'], $current_url);

        // 5. Оставляем только последние 10 записей
        $_SESSION['history'] = array_slice(array_values($_SESSION['history']), 0, 10);
    }
}