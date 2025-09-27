<?php
// Incluye el archivo de configuración donde están las constantes de conexión
require_once __DIR__ . '/../config/config.php';

// Clase Db: se encarga de conectar a la base de datos
class Db {
    // Propiedad pública que guarda el objeto de conexión mysqli
    public $conection;

    // Constructor: se ejecuta automáticamente al crear un objeto Db
    public function __construct() {
        // Crea la conexión usando las constantes definidas en config.php
        $this->conection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // Si hay error al conectar, termina la ejecución mostrando el error
        if ($this->conection->connect_error) 
            die('Falló la conexión: ' . $this->conection->connect_error);

        // Define el conjunto de caracteres para la conexión (UTF-8 moderno con emojis y más)
        $this->conection->set_charset('utf8mb4');
    }
}