<?php require __DIR__ . '/template/header.php'; ?>
<?php
  // Desde empleadoController->delete() podés retornar 
  $res = $dataToView['data'] ?? [];
  $ok  = $res['ok'] ?? true;   // si redirigís y no pasás datos, asumimos OK
  $id  = $res['id'] ?? null;
?>

<div class="row">
  <div class="col-12">
    <?php if ($ok): ?>
      <div class="alert alert-success">
        Empleado<?= $id ? " #".(int)$id : "" ?> eliminado correctamente.
        <a class="alert-link" href="index.php?controller=empleado&action=list">Volver al listado</a>
      </div>
    <?php else: ?>
      <div class="alert alert-danger">
        No se pudo eliminar<?= $id ? " el empleado #".(int)$id : " el empleado" ?>.
        <a class="alert-link" href="index.php?controller=empleado&action=list">Volver al listado</a>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php require __DIR__ . '/template/footer.php'; ?>