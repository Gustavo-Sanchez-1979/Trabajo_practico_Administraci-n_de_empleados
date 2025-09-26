<?php require __DIR__ . '/template/header.php'; ?>
<?php
  // $dataToView["data"] debe traer el empleado desde empleadoController->confirmDelete()
  $emp = $dataToView['data'] ?? null;
  if (!$emp) {
?>
  <div class="alert alert-danger">No se encontró el empleado a eliminar.</div>
  <a class="btn btn-secondary" href="index.php?controller=empleado&action=list">Volver</a>
<?php
  require __DIR__ . '/template/footer.php';
  return;
}
?>

<div class="row justify-content-center">
  <div class="col-md-8 col-lg-6">
    <div class="card shadow-sm">
      <div class="card-header bg-warning">
        <strong>Confirmar eliminación</strong>
      </div>
      <div class="card-body">
        <p class="mb-2">¿Confirmás que querés eliminar este empleado?</p>

        <ul class="list-group mb-3">
          <li class="list-group-item">
            <strong>Nombre:</strong>
            <?= htmlspecialchars($emp['nombre'] ?? '') ?>
          </li>
          <li class="list-group-item">
            <strong>Apellido:</strong>
            <?= htmlspecialchars($emp['apellido'] ?? '') ?>
          </li>
          <?php if (!empty($emp['dni'])): ?>
          <li class="list-group-item">
            <strong>DNI:</strong>
            <?= htmlspecialchars($emp['dni']) ?>
          </li>
          <?php endif; ?>
          <?php if (!empty($emp['puesto'])): ?>
          <li class="list-group-item">
            <strong>Puesto:</strong>
            <?= htmlspecialchars($emp['puesto']) ?>
          </li>
          <?php endif; ?>
        </ul>

        <form class="d-flex gap-2" action="index.php?controller=empleado&action=delete" method="POST">
          <input type="hidden" name="id" value="<?= (int)($emp['id'] ?? 0) ?>">
          <button type="submit" class="btn btn-danger">Eliminar</button>
          <a class="btn btn-outline-secondary" href="index.php?controller=empleado&action=list">Cancelar</a>
        </form>

      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/template/footer.php'; ?>
