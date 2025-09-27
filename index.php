<?php
// index.php (front controller principal de la app)
// Carga la configuración global (constantes, mysqli_report, etc.)
require_once __DIR__ . '/config/config.php';


// 1) Resolver controller/action con valores por defecto

// Si no vienen por query string (?controller=...&action=...), usa DEFAULT_*
$controller = $_GET['controller'] ?? DEFAULT_CONTROLLER; // p.ej. 'empleado'
$action     = $_GET['action']     ?? DEFAULT_ACTION;     // p.ej. 'list'


// 2) Sanitizar controller y action

// Evita nombres con caracteres raros/inyección de rutas. Solo letras, números y guión bajo.
if (!preg_match('/^[a-zA-Z0-9_]+$/', $controller)) $controller = DEFAULT_CONTROLLER;
if (!preg_match('/^[a-zA-Z0-9_]+$/', $action))     $action     = DEFAULT_ACTION;


// 3) Resolver archivo físico del controller

// Se espera un archivo en /controller/{controller}.php  (ej: controller/empleado.php)
$controllerFile = __DIR__ . "/controller/{$controller}.php";

// Si NO existe el archivo del controller solicitado, cae al controller/acción por defecto
if (!file_exists($controllerFile)) {
  $controller = DEFAULT_CONTROLLER;
  $action     = DEFAULT_ACTION;
  $controllerFile = __DIR__ . "/controller/{$controller}.php";

  // Si tampoco existe el controller por defecto, devolvemos 500 y abortamos
  if (!file_exists($controllerFile)) {
    http_response_code(500);
    exit("No se encontró el controller por defecto. Revisa config/config.php y controller/{$controller}.php");
  }
}


// 4) Cargar clase del controller e instanciar

// Incluye el archivo del controller ya resuelto
require_once $controllerFile;

// Convención: el nombre de clase es {controller}Controller (ej: empleadoController)
$controllerClass = $controller . 'Controller';

// Si la clase no existe dentro del archivo, es un error de configuración
if (!class_exists($controllerClass)) {
  http_response_code(500);
  exit("Clase de controller no encontrada: {$controllerClass}");
}

// Instancia del controller (tendrá props como $page_title y $view)
$controllerObj = new $controllerClass();


// 5) Ejecutar la acción solicitada

// $dataToView almacenará lo que la acción retorne para que la vista lo use
$dataToView = ['data' => []];

// Si el método/acción existe en el controller, lo invocamos y guardamos su retorno
if (method_exists($controllerObj, $action)) {
  $dataToView['data'] = $controllerObj->$action();
} else {
  // Si la acción no existe, preparamos una vista de error amigable
  $controllerObj->page_title = 'Acción no encontrada';
  $controllerObj->view = 'error_action';
  $dataToView['data'] = ['message' => "La acción '{$action}' no existe en {$controllerClass}."];
}


// 6) Renderizado (header + vista + footer)

// Rutas de las plantillas comunes
$header = __DIR__ . '/view/template/header.php';
$footer = __DIR__ . '/view/template/footer.php';

// Vista principal a renderizar, definida por el controller (ej: list_empleado.php)
$view   = __DIR__ . "/view/{$controllerObj->view}.php";

// Incluye el header si existe; si no, usa uno de respaldo (fallback)
require file_exists($header) ? $header : __DIR__ . '/view/template/header_fallback.php';

// Incluye la vista principal si existe; si no, muestra alerta de error
if (file_exists($view)) {
  require $view;
} else {
  echo '<div class="container mt-3"><div class="alert alert-danger">Vista no encontrada: '
     . htmlspecialchars($controllerObj->view) . '.php</div></div>';
}

// Incluye siempre tu footer
require __DIR__ . '/view/template/footer.php';