<?php require __DIR__ . '/template/header.php'; ?>
<?php
  // Los datos vienen desde empleadoController->delete()
  $res = $dataToView['data'] ?? [];   // Datos devueltos (ok + id)

  // Bandera: true si la eliminación fue correcta, false si hubo error
  $ok  = $res['ok'] ?? true;          // Si no hay datos, asumimos que fue OK

  // ID del empleado eliminado (si se envió)
  $id  = $res['id'] ?? null;
?>

<div class="row">
  <div class="col-12">
    <?php if ($ok): ?>
      <!-- Si la eliminación fue exitosa -->
      <div class="alert alert-success">
        Empleado<?= $id ? " #".(int)$id : "" ?> eliminado correctamente.
        <!-- Link para volver al listado -->
        <a class="alert-link" href="index.php?controller=empleado&action=list">Volver al listado</a>
      </div>
    <?php else: ?>
      <!-- Si hubo un error al eliminar -->
      <div class="alert alert-danger">
        No se pudo eliminar<?= $id ? " el empleado #".(int)$id : " el empleado" ?>.
        <!-- Link para volver al listado -->
        <a class="alert-link" href="index.php?controller=empleado&action=list">Volver al listado</a>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php require __DIR__ . '/template/footer.php'; ?>