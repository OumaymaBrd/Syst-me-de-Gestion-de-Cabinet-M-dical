<?php

namespace App\Core;

use App\Config\Database;

abstract class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }
}