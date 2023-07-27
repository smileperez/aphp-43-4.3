<?php

class Autoload {
    public static function initial()
    {
        spl_autoload_register(function ($class_name) {
            // Получим путь к файлу
            $path = __DIR__ . '/' . $class_name . '.php';

            // Заменим "\" на "/", т.к. в путях другой слэш
            $path = str_replace(['\\', '/'], DIRECTORY_SEPARATOR, $path);

            // Если файл с классом не нашёлся
            if (!is_file($path)) {
                echo 'Файл не найден: ' . $path;
                exit();
            }

            require_once $path;
        });
    }
}