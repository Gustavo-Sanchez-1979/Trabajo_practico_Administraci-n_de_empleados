<?php
require_once __DIR__ . '/../model/empleado.php';

class empleadoController {
  public $page_title = '';
  public $view = 'list_empleado';
  private $empleado;

  public function __construct() {
    $this->empleado = new Empleado();
  }

  public function list() {
    $this->page_title = 'Listado de empleados';
    $this->view = 'list_empleado';
    return $this->empleado->getEmployees();
  }

  public function edit($id = null) {
    $this->page_title = 'Editar empleado';
    $this->view = 'edit_empleado';
    if (isset($_GET['id'])) $id = (int)$_GET['id'];
    return $id ? $this->empleado->getEmployeeById($id) : []; 
  }

  public function save() {
    $this->page_title = 'Editar empleado';
    $this->view = 'edit_empleado';
    $id = $this->empleado->save($_POST);
    $_GET['response'] = true;
    return $this->empleado->getEmployeeById($id);
  }

  public function confirmDelete() {
    $this->page_title = 'Eliminar empleado';
    $this->view = 'confirm_delete_empleado';
    return $this->empleado->getEmployeeById((int)($_GET['id'] ?? 0)); 
  }

  public function delete() {
    $this->page_title = 'Listado de empleados';
    $this->view = 'delete_empleado';
    $ok = $this->empleado->deleteEmployeeById((int)($_POST['id'] ?? 0)); 
    return ['ok'=>$ok,'id'=>$_POST['id'] ?? null];
  }
}