<?php
// Define el controlador que se usará por defecto si no se especifica otro en la URL
define('DEFAULT_CONTROLLER','empleado');

// Define la acción (función/método) que se ejecutará por defecto dentro de ese controlador
define('DEFAULT_ACTION','list');

// Datos de conexión a la base de datos MySQL
define('DB_HOST','localhost'); // El servidor de base de datos (local en este caso)
define('DB_USER','root');      // Usuario de MySQL (por defecto "root")
define('DB_PASS','');          // Contraseña del usuario (vacía en XAMPP por defecto)
define('DB_NAME','empresa_tp');// Nombre de la base de datos a la que se conectará

// Texto que se mostrará en el pie de la aplicación
define('APP_FOOTER', 'Administración Baja y Alta de Empleados');

// Activa los reportes de errores de MySQLi
// MYSQLI_REPORT_ERROR -> muestra errores
// MYSQLI_REPORT_STRICT -> lanza excepciones en lugar de warnings
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);