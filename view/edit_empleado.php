<?php
$id = $nombre = $apellido = $dni = $email = $puesto = $fecha_ingreso = "";
$salario = "0.00";

$emp = $dataToView["data"] ?? [];

if (isset($emp["id"]))            $id = (int)$emp["id"];
if (isset($emp["nombre"]))        $nombre = $emp["nombre"];
if (isset($emp["apellido"]))      $apellido = $emp["apellido"];
if (isset($emp["dni"]))           $dni = $emp["dni"];
if (isset($emp["email"]))         $email = $emp["email"];
if (isset($emp["puesto"]))        $puesto = $emp["puesto"];
if (isset($emp["salario"]))       $salario = (string)$emp["salario"];
if (isset($emp["fecha_ingreso"])) $fecha_ingreso = $emp["fecha_ingreso"];
?>
<div class="row">
  <?php if (isset($_GET["response"]) && $_GET["response"]): ?>
    <div class="alert alert-success">
      Operación realizada correctamente.
      <a href="index.php?controller=empleado&action=list">Volver al listado</a>
    </div>
  <?php endif; ?>

  <form class="form" action="index.php?controller=empleado&action=save" method="POST">
    <input type="hidden" name="id" value="<?= $id; ?>" />

    <div class="form-group mb-2">
      <label>Nombre</label>
      <input class="form-control" type="text" name="nombre" required
             value="<?= htmlspecialchars($nombre); ?>" />
    </div>

    <div class="form-group mb-2">
      <label>Apellido</label>
      <input class="form-control" type="text" name="apellido" required
             value="<?= htmlspecialchars($apellido); ?>" />
    </div>

    <div class="form-group mb-2">
      <label>DNI</label>
      <input class="form-control" type="text" name="dni" required
             value="<?= htmlspecialchars($dni); ?>" />
    </div>

    <div class="form-group mb-2">
      <label>Email</label>
      <input class="form-control" type="email" name="email" required
             value="<?= htmlspecialchars($email); ?>" />
    </div>

    <div class="form-group mb-2">
      <label>Puesto</label>
      <input class="form-control" type="text" name="puesto" required
             value="<?= htmlspecialchars($puesto); ?>" />
    </div>

    <div class="form-group mb-2">
      <label>Salario</label>
      <input class="form-control" type="number" step="0.01" min="0" name="salario" required
             value="<?= htmlspecialchars($salario); ?>" />
    </div>

    <div class="form-group mb-3">
      <label>Fecha de ingreso</label>
      <input class="form-control" type="date" name="fecha_ingreso" required
             value="<?= htmlspecialchars($fecha_ingreso ?: date('Y-m-d')); ?>" />
    </div>

    <input type="submit" value="Guardar" class="btn btn-primary" />
    <a class="btn btn-outline-danger" href="index.php?controller=empleado&action=list">Cancelar</a>
  </form>
</div>
