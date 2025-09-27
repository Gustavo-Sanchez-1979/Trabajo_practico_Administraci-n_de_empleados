<?php
// Obtiene el título de la página desde el controlador
$titleFromCtrl =
  $controllerObj->page_title                // Si existe $controllerObj con page_title
  ?? ($controller->page_title ?? 'Administración de Empleados'); // Si no, intenta con $controller o usa un título por defecto
?>
<!doctype html>
<html lang="es">
  
<head>
  <meta charset="utf-8">
  <!-- El título dinámico de la página -->
  <title><?= htmlspecialchars($titleFromCtrl) ?></title>

  <!-- Importa Bootstrap desde CDN, Si no podemos crear un archivo con estilos css por que esto puede cambiar en algun momento-->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

