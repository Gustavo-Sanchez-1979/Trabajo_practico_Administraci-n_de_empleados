<?php
// Incluye el archivo del modelo Empleado (la lógica de base de datos)
require_once __DIR__ . '/../model/empleado.php';

// Definición del controlador empleadoController
class empleadoController {
  // Título de la página (se puede mostrar en la vista)
  public $page_title = '';

  // Vista que se cargará por defecto
  public $view = 'list_empleado';

  // Instancia privada del modelo Empleado
  private $empleado;

  // Constructor: inicializa el objeto Empleado
  public function __construct() {
    $this->empleado = new Empleado();
  }

  // Acción: mostrar el listado de empleados
  public function list() {
    $this->page_title = 'Listado de empleados'; // título para la vista
    $this->view = 'list_empleado';              // vista que se va a cargar
    return $this->empleado->getEmployees();     // devuelve la lista desde el modelo
  }

  // Acción: editar un empleado (recibe ID por parámetro o por $_GET)
  public function edit($id = null) {
    $this->page_title = 'Editar empleado';
    $this->view = 'edit_empleado';
    if (isset($_GET['id'])) $id = (int)$_GET['id']; // si viene por GET, se castea a entero
    // si hay ID → busca al empleado, sino devuelve array vacío
    return $id ? $this->empleado->getEmployeeById($id) : []; 
  }

  // Acción: guardar un empleado (nuevo o editado)
  public function save() {
    $this->page_title = 'Editar empleado';
    $this->view = 'edit_empleado';
    // guarda los datos enviados por POST y devuelve el ID del empleado
    $id = $this->empleado->save($_POST);
    $_GET['response'] = true; // indicador de que la acción fue correcta
    return $this->empleado->getEmployeeById($id); // devuelve el empleado guardado
  }

  // Acción: mostrar confirmación de eliminación
  public function confirmDelete() {
    $this->page_title = 'Eliminar empleado';
    $this->view = 'confirm_delete_empleado';
    // obtiene el empleado a eliminar según el ID por GET
    return $this->empleado->getEmployeeById((int)($_GET['id'] ?? 0)); 
  }

  // Acción: eliminar definitivamente al empleado
  public function delete() {
    $this->page_title = 'Listado de empleados';
    $this->view = 'delete_empleado';
    // elimina el empleado según ID recibido por POST
    $ok = $this->empleado->deleteEmployeeById((int)($_POST['id'] ?? 0)); 
    // devuelve array con resultado de la operación
    return ['ok'=>$ok,'id'=>$_POST['id'] ?? null];
  }
}