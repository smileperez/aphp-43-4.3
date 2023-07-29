<?php

namespace Classess\Tables;

use Classess\Database as Database;

class TableOrderProduct extends Database
{
    public $db_connection;
    public $table = 'order_product';

    public function __construct($pdo) {
        $this->db_connection = $pdo;
    }
}

?>