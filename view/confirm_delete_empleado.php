<?php require __DIR__ . '/template/header.php'; ?>
<?php
  // Toma los datos del empleado que vienen del controlador.
  // $dataToView['data'] contiene el empleado a eliminar.
  $emp = $dataToView['data'] ?? null; 

  // Si no encuentra datos del empleado...
  if (!$emp) { 
?>
  <!-- Muestra un mensaje de error en un alert de Bootstrap -->
  <div class="alert alert-danger">No se encontró el empleado a eliminar.</div>
  <!-- Botón para volver al listado de empleados -->
  <a class="btn btn-secondary" href="index.php?controller=empleado&action=list">Volver</a>
<?php
  // Incluye el footer y corta la ejecución de la vista
  require __DIR__ . '/template/footer.php';
  return; 
}
?>

<!-- Contenedor central (fila centrada) -->
<div class="row justify-content-center">
  <div class="col-md-8 col-lg-6"><!-- Columna central -->
    <div class="card shadow-sm"><!-- Tarjeta con sombra -->
      
      <!-- Cabecera de la tarjeta en color de advertencia -->
      <div class="card-header bg-warning">
        <strong>Confirmar eliminación</strong>
      </div>

      <div class="card-body">
        <p class="mb-2">¿Confirmás que querés eliminar este empleado?</p>

        <!-- Lista con los datos principales del empleado -->
        <ul class="list-group mb-3">
          <li class="list-group-item">
            <strong>Nombre:</strong>
            <?= htmlspecialchars($emp['nombre'] ?? '') ?>
          </li>
          <li class="list-group-item">
            <strong>Apellido:</strong>
            <?= htmlspecialchars($emp['apellido'] ?? '') ?>
          </li>

          <!-- Si tiene DNI, se muestra -->
          <?php if (!empty($emp['dni'])): ?>
          <li class="list-group-item">
            <strong>DNI:</strong>
            <?= htmlspecialchars($emp['dni']) ?>
          </li>
          <?php endif; ?>

          <!-- Si tiene puesto, se muestra -->
          <?php if (!empty($emp['puesto'])): ?>
          <li class="list-group-item">
            <strong>Puesto:</strong>
            <?= htmlspecialchars($emp['puesto']) ?>
          </li>
          <?php endif; ?>
        </ul>

        <!-- Formulario de confirmación -->
        <form class="d-flex gap-2" 
              action="index.php?controller=empleado&action=delete" 
              method="POST">
          
          <!-- Campo oculto con el ID del empleado -->
          <input type="hidden" name="id" value="<?= (int)($emp['id'] ?? 0) ?>">

          <!-- Botón rojo para eliminar -->
          <button type="submit" class="btn btn-danger">Eliminar</button>

          <!-- Botón gris para cancelar y volver al listado -->
          <a class="btn btn-outline-secondary" href="index.php?controller=empleado&action=list">Cancelar</a>
        </form>

      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/template/footer.php'; ?>