<?php
require_once __DIR__ . '/../config/config.php';

class Db {
    public $conection;
    public function __construct() {
        $this->conection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if ($this->conection->connect_error) die('Falló la conexión: '.$this->conection->connect_error);
        $this->conection->set_charset('utf8mb4');
    }
}