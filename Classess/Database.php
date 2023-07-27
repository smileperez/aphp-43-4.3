<?php

namespace Classess;

use Interfaces\DatabaseWrapper as DatabaseWrapper;

class Database implements DatabaseWrapper
{
    public $db_connection;

    public function __construct($pdo) {
        $this->db_connection = $pdo;
    }

    // вставляет новую запись в таблицу, возвращает полученный объект как массив
    public function insert(array $tableColumns, array $values): array {
        try {
            $sql = "INSERT INTO client (".implode(", ", $tableColumns).") VALUES ('".implode("', '", $values)."')";
            $sth = $this->db_connection->query($sql);
            echo 'Добавление строки успешно завершено.';
            print_r($sth);
            return $sth;
        } catch (\Exception $e) {
            print "Error!: " . $e->getMessage().PHP_EOL;
            die();
        }
    }

    // редактирует строку под конкретным id, возвращает результат после изменения
    public function update(int $id, array $values): array {
        try {
            $sql = "UPDATE ord SET customer ='".$values[0]."', seller ='".$values[1]."' WHERE id=".$id;
            echo $sql;
            $sth = $this->db_connection->query($sql);
            print_r($sth);
            return $sth;
        } catch (\Exception $e) {
            print "Error!: " . $e->getMessage().PHP_EOL;
            die();
        }
    }
    // поиск по id
    public function find(string $table, int $id): array {
        try {
            $sql = 'SELECT * FROM '.$table.' WHERE id='.$id;
            $sth = $this->db_connection->query($sql);
            $rows = $sth->fetchAll();
            return $rows;
        } catch (\Exception $e) {
            print "Error!: " . $e->getMessage().PHP_EOL;
            die();
        }
    }
    // удаление по id
    public function delete(string $table, int $id): bool {
        try {
            $sql = "DELETE FROM ".$table." WHERE id=".$id;
            $this->db_connection->query($sql);
            echo 'Удаление строки с id='.$id.' из таблицы '.$table.' успешно завершено.';
            return true;
        } catch (\Exception $e) {
            print "Error!: " . $e->getMessage().PHP_EOL;
            return false;
        }
    }

    // просто вывести всю таблицу
    public function printTable(string $table): bool {
        try {
            $sql = "SELECT * FROM " . $table;
            $sth = $this->db_connection->query($sql);
            $rows = $sth->fetchAll();
            print_r($rows);
            return true;
        } catch (\Exception $e) {
            print "Error!: " . $e->getMessage().PHP_EOL;
            return false;
        }
    }
}

?>