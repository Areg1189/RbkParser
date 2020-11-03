<?php

namespace Core;

use PDO;
use App\Config;

class Model
{

    protected $db = null;
    protected $table;

    public function __construct()
    {
        $this->db = new Db(Config::DB_DRIVER, Config::DB_HOST, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME );
    }

    public function create($data)
    {
        return $this->db->insert($this->table, $data);
    }

}
