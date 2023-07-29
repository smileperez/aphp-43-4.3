<?php

namespace Classess\Tables;

use Classess\Database as Database;

class TableProducts extends Database
{
    public $db_connection;
    public $table = 'products';

    public function __construct($pdo) {
        $this->db_connection = $pdo;
    }
}

?>