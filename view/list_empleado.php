<?php
$rows = $dataToView['data'] ?? [];
$pageTitle = $controllerObj->page_title ?? 'Listado de empleados';
?>
<div class="container mt-3">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h3 class="m-0"><?= htmlspecialchars($pageTitle) ?></h3>
    <a href="index.php?controller=empleado&action=edit" class="btn btn-primary">➕ Nuevo empleado</a>
  </div>

  <?php if (empty($rows)): ?>
    <div class="alert alert-info">Sin empleados.</div>
  <?php else: ?>
    <div class="table-responsive">
      <table class="table table-striped table-hover align-middle">
        <thead class="table-light">
          <tr>
            <th>ID</th><th>Nombre</th><th>Apellido</th><th>DNI</th><th>Email</th>
            <th>Puesto</th><th>Salario</th><th>Ingreso</th><th style="width:170px">Acciones</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach($rows as $r): ?>
            <tr>
              <td><?= (int)$r['id'] ?></td>
              <td><?= htmlspecialchars($r['nombre']) ?></td>
              <td><?= htmlspecialchars($r['apellido']) ?></td>
              <td><?= htmlspecialchars($r['dni']) ?></td>
              <td><?= htmlspecialchars($r['email']) ?></td>
              <td><?= htmlspecialchars($r['puesto']) ?></td>
              <td>$<?= number_format((float)$r['salario'], 2, ',', '.') ?></td>
              <td><?= htmlspecialchars($r['fecha_ingreso']) ?></td>
              <td>
                <a class="btn btn-sm btn-outline-secondary"
                   href="index.php?controller=empleado&action=edit&id=<?= (int)$r['id'] ?>">Editar</a>
                <a class="btn btn-sm btn-outline-danger"
                   href="index.php?controller=empleado&action=confirmDelete&id=<?= (int)$r['id'] ?>">Eliminar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>
</div>
