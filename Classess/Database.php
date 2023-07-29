<?php

namespace Classess;

use Interfaces\DatabaseWrapper as DatabaseWrapper;

abstract class Database implements DatabaseWrapper
{
    public $db_connection;
    public $table;

    public function __construct($pdo) {
        $this->db_connection = $pdo;
    }

    // вставляет новую запись в таблицу, возвращает полученный объект как массив
    public function insert(array $tableColumns, array $values): array {
        try {
            // Добавление
            $sql_insert = "INSERT INTO ". $this->table ." (" . implode(", ", $tableColumns) . ") VALUES ('".implode("', '", $values)."')";
            $request1 = $this->db_connection->query($sql_insert);

            // Поиск последнего элемента в таблице
            $sql_count = "SELECT COUNT(1) FROM " . $this->table;
            $request2 = $this->db_connection->query($sql_count);
            $count = $request2->fetchAll();

            // Вывод добавленной строки
            return $sql_print = $this->find($count[0][0]);
        } catch (\Exception $e) {
            print "Error!: " . $e->getMessage().PHP_EOL;
            die();
        }
    }

    // редактирует строку под конкретным id, возвращает результат после изменения
    public function update(int $id, array $values): array {
        try {
            // Выясняем названия колонок в таблице
            $sql_columns = "SHOW columns FROM " . $this->table;
            $request1 = $this->db_connection->query($sql_columns);
            $data_request1 = $request1->fetchAll();
            $columns = array();
            for ($i=0; $i<count($data_request1); $i++) {
                array_push($columns, $data_request1[$i][0]);
            }
            // Убираем первое значение массива ID таблицы
            array_shift($columns);

            // Получаем правильные данные в формате < column='value' >
            $sql_string = array();
            for ($i=0; $i<=count($columns)-1; $i++) {
                array_push($sql_string, $columns[$i]."='".$values[$i]."'");
            }

            // Создаем правильную строку запросы для апдейта
            $sql_update = "UPDATE ". $this->table . " SET ". implode(", ", $sql_string) ." WHERE id=".$id;
            $request2 = $this->db_connection->query($sql_update);
            echo 'Апдейт строки с id='.$id.' успешно завершен.'.PHP_EOL;
            return $sql_print = $this->find($id);
        } catch (\Exception $e) {
            print "Error!: " . $e->getMessage().PHP_EOL;
            die();
        }
    }
    // поиск по id
    public function find(int $id): array {
        try {
            $sql = "SELECT * FROM ".$this->table." WHERE id=".$id;
            $sth = $this->db_connection->query($sql);
            $rows = $sth->fetchAll();
            print_r($rows);
            return $rows;
        } catch (\Exception $e) {
            print "Error!: " . $e->getMessage().PHP_EOL;
            die();
        }
    }
    // удаление по id
    public function delete(int $id): bool {
        try {
            $sql = "DELETE FROM ".$this->table." WHERE id=".$id;
            $this->db_connection->query($sql);
            echo 'Удаление строки с id='.$id.' успешно завершено.'.PHP_EOL;
            return true;
        } catch (\Exception $e) {
            print "Error!: " . $e->getMessage().PHP_EOL;
            return false;
        }
    }

    // просто вывести всю таблицу
    public function printTable(): bool {
        try {
            $sql = "SELECT * FROM " . $this->table;
            $result = $this->db_connection->query($sql);
            $rows = $result->fetchAll();
            print_r($rows);
            return true;
        } catch (\Exception $e) {
            print "Error!: " . $e->getMessage().PHP_EOL;
            return false;
        }
    }
}

?>