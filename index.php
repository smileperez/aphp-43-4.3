<?php
declare(strict_types=1);

require_once __DIR__ . '.\autoload.php';
Autoload::initial();

use Classess\Database as Database;
use Classess\Tables\TableClients as TableClients;
use Classess\Tables\TableOrd as TableOrd;
use Classess\Tables\TableOrderProduct as TableOrderProduct;
use Classess\Tables\TableProducts as TableProducts;
use Classess\Tables\TableShops as TableShops;

try {
    $pdo = new PDO(dsn:'mysql:host=localhost;dbname=db2', username:'root', password:'');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

$t_clients = new TableClients($pdo);
$t_ord = new TableOrd($pdo);
$t_order_product = new TableOrderProduct($pdo);
$t_products = new TableProducts($pdo);
$t_shops = new TableShops($pdo);

// Выводим таблицу
$t_clients->printTable();

// Удалить строку из таблицы
$t_order_product->delete(1);

// // Поиск в таблице по ID
$t_products->find(2);

// // Вставить строку
$t_products->insert(['name','price','count'], ['Машина', 1300000, 5]);

// // Изменить конкретную строку
$t_shops->update(2, ["Супермаркет №1", "Улица Твердовского, 34"]);