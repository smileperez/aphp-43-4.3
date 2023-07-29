<?php

namespace Classess\Tables;

use Classess\Database as Database;

class TableShops extends Database
{
    public $db_connection;
    public $table = 'shops';

    public function __construct($pdo) {
        $this->db_connection = $pdo;
    }
}

?>