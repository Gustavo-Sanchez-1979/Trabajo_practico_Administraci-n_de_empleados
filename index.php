<?php
// index.php (front controller)
require_once __DIR__ . '/config/config.php';

// 1) Resolver controller/action con defaults
$controller = $_GET['controller'] ?? DEFAULT_CONTROLLER;
$action     = $_GET['action']     ?? DEFAULT_ACTION;

// 2) Sanitizar (si no pasa, volver a defaults)
if (!preg_match('/^[a-zA-Z0-9_]+$/', $controller)) $controller = DEFAULT_CONTROLLER;
if (!preg_match('/^[a-zA-Z0-9_]+$/', $action))     $action     = DEFAULT_ACTION;

// 3) Resolver archivo de controller (con fallback al default)
$controllerFile = __DIR__ . "/controller/{$controller}.php";
if (!file_exists($controllerFile)) {
  $controller = DEFAULT_CONTROLLER;
  $action     = DEFAULT_ACTION;
  $controllerFile = __DIR__ . "/controller/{$controller}.php";
  if (!file_exists($controllerFile)) {
    http_response_code(500);
    exit("No se encontró el controller por defecto. Revisa config/config.php y controller/{$controller}.php");
  }
}

// 4) Cargar clase de controller e instanciar
require_once $controllerFile;
$controllerClass = $controller . 'Controller';
if (!class_exists($controllerClass)) {
  http_response_code(500);
  exit("Clase de controller no encontrada: {$controllerClass}");
}
$controllerObj = new $controllerClass();

// 5) Ejecutar acción
$dataToView = ['data' => []];
if (method_exists($controllerObj, $action)) {
  $dataToView['data'] = $controllerObj->$action();
} else {
  $controllerObj->page_title = 'Acción no encontrada';
  $controllerObj->view = 'error_action';
  $dataToView['data'] = ['message' => "La acción '{$action}' no existe en {$controllerClass}."];
}

// 6) Render (header + vista + footer)
$header = __DIR__ . '/view/template/header.php';
$footer = __DIR__ . '/view/template/footer.php';
$view   = __DIR__ . "/view/{$controllerObj->view}.php";

require file_exists($header) ? $header : __DIR__ . '/view/template/header_fallback.php';

if (file_exists($view)) {
  require $view;
} else {
  echo '<div class="container mt-3"><div class="alert alert-danger">Vista no encontrada: '
     . htmlspecialchars($controllerObj->view) . '.php</div></div>';
}

require file_exists($footer) ? $footer : __DIR__ . '/view/template/footer_fallback.php';