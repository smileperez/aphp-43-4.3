<?php
declare(strict_types=1);

require_once __DIR__ . '.\autoload.php';
Autoload::initial();

use Classess\Database as Database;

try {
    $pdo = new PDO(dsn:'mysql:host=localhost;dbname=db', username:'root', password:'');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}


$db = new Database($pdo);

// Показать всю таблицу
$db->printTable('order_product');

// Удалить строку из таблицы
$db->delete('order_product', 3);

// Поиск в таблице по ID
print_r($db->find('order_product', 4));

// Вставить строку
$db->insert(['phone', 'name'], ['+7 333 787 12 65', 'Эдик13']);

// Изменить конкретную строку
$db->update(2, ['Маша', 'Пятерочка']);