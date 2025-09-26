<?php
// header.php
$titleFromCtrl =
  $controllerObj->page_title
  ?? ($controller->page_title ?? 'Administración de Empleados');
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($titleFromCtrl) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

