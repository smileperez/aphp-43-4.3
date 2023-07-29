<?php

namespace Classess\Tables;

use Classess\Database as Database;

class TableClients extends Database
{
    public $db_connection;
    public $table = 'clients';

    public function __construct($pdo) {
        $this->db_connection = $pdo;
    }
}

?>