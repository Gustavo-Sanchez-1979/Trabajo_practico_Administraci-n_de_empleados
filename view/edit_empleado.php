<?php
// Inicializamos todas las variables con valores vacíos o por defecto
$id = $nombre = $apellido = $dni = $email = $puesto = $fecha_ingreso = "";
$salario = "0.00";

// Tomamos los datos que vienen del controlador (empleado existente si es edición)
$emp = $dataToView["data"] ?? [];

// Si existen datos, los cargamos en las variables correspondientes
if (isset($emp["id"]))            $id = (int)$emp["id"];         // ID del empleado
if (isset($emp["nombre"]))        $nombre = $emp["nombre"];      // Nombre del empleado
if (isset($emp["apellido"]))      $apellido = $emp["apellido"];  // Apellido del empleado
if (isset($emp["dni"]))           $dni = $emp["dni"];            // DNI del empleado
if (isset($emp["email"]))         $email = $emp["email"];        // Email del empleado
if (isset($emp["puesto"]))        $puesto = $emp["puesto"];      // Puesto del empleado
if (isset($emp["salario"]))       $salario = (string)$emp["salario"]; // Salario como string
if (isset($emp["fecha_ingreso"])) $fecha_ingreso = $emp["fecha_ingreso"]; // Fecha de ingreso
?>

<div class="row">
  <?php 
  // Si la URL trae ?response=true mostramos un mensaje de éxito
  if (isset($_GET["response"]) && $_GET["response"]): ?>
    <div class="alert alert-success">
      Operación realizada correctamente.
      <!-- Enlace para volver al listado -->
      <a href="index.php?controller=empleado&action=list">Volver al listado</a>
    </div>
  <?php endif; ?>

  <!-- Formulario para alta o edición de empleados -->
  <form class="form" action="index.php?controller=empleado&action=save" method="POST">

    <!-- Campo oculto con el ID del empleado (sirve para distinguir entre editar o crear) -->
    <input type="hidden" name="id" value="<?= $id; ?>" />

    <!-- Campo Nombre -->
    <div class="form-group mb-2">
      <label>Nombre</label>
      <input class="form-control" type="text" name="nombre" required
             value="<?= htmlspecialchars($nombre); ?>" />
    </div>

    <!-- Campo Apellido -->
    <div class="form-group mb-2">
      <label>Apellido</label>
      <input class="form-control" type="text" name="apellido" required
             value="<?= htmlspecialchars($apellido); ?>" />
    </div>

    <!-- Campo DNI -->
    <div class="form-group mb-2">
      <label>DNI</label>
      <input class="form-control" type="text" name="dni" required
             value="<?= htmlspecialchars($dni); ?>" />
    </div>

    <!-- Campo Email -->
    <div class="form-group mb-2">
      <label>Email</label>
      <input class="form-control" type="email" name="email" required
             value="<?= htmlspecialchars($email); ?>" />
    </div>

    <!-- Campo Puesto -->
    <div class="form-group mb-2">
      <label>Puesto</label>
      <input class="form-control" type="text" name="puesto" required
             value="<?= htmlspecialchars($puesto); ?>" />
    </div>

    <!-- Campo Salario -->
    <div class="form-group mb-2">
      <label>Salario</label>
      <!-- step="0.01" permite decimales / min="0" evita negativos -->
      <input class="form-control" type="number" step="0.01" min="0" name="salario" required
             value="<?= htmlspecialchars($salario); ?>" />
    </div>

    <!-- Campo Fecha de ingreso -->
    <div class="form-group mb-3">
      <label>Fecha de ingreso</label>
      <!-- Si no hay fecha cargada, pone la fecha de hoy por defecto -->
      <input class="form-control" type="date" name="fecha_ingreso" required
             value="<?= htmlspecialchars($fecha_ingreso ?: date('Y-m-d')); ?>" />
    </div>

    <!-- Botones de acción -->
    <input type="submit" value="Guardar" class="btn btn-primary" />
    <a class="btn btn-outline-danger" href="index.php?controller=empleado&action=list">Cancelar</a>
  </form>
</div>