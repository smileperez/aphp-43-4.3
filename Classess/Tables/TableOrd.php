<?php

namespace Classess\Tables;

use Classess\Database as Database;

class TableOrd extends Database
{
    public $db_connection;
    public $table = 'ord';

    public function __construct($pdo) {
        $this->db_connection = $pdo;
    }
}

?>