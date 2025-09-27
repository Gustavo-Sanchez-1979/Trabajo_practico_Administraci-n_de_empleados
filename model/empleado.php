<?php

// Incluye la clase Db que maneja la conexión a la base de datos
require_once __DIR__ . '/db.php';

class Empleado {

    // Conexión activa a la base de datos
    private $conection;

    // Nombre de la tabla donde se guardan los empleados
    private $table = 'empleados';

    // Constructor: abre la conexión automáticamente al instanciar Empleado
    public function __construct() {
        $db = new Db();
        $this->conection = $db->conection;
    }
 
    // LISTAR TODOS LOS EMPLEADOS

    public function getEmployees(): array {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conection->prepare($sql); // prepara la consulta
        $stmt->execute();                        // ejecuta la consulta
        $res = $stmt->get_result();              // obtiene el resultado
        return $res->fetch_all(MYSQLI_ASSOC);    // devuelve array asociativo
    }

    
    // BUSCAR EMPLEADO POR ID
    
    public function getEmployeeById(int $id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param('i', $id);   // "i" → entero
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc();    // devuelve un solo registro como array asociativo
    }

   
    // GUARDAR EMPLEADO (NUEVO O EDITADO)

    public function save(array $param) {
        // Variables con valores iniciales
        $id = null;
        $nombre = $apellido = $dni = $email = $puesto = $fecha_ingreso = '';
        $salario = 0.0;

        // Verifica si el empleado ya existe (UPDATE) o no (INSERT)
        $exists = false;
        if (!empty($param['id'])) {
            $id = (int)$param['id'];
            $actual = $this->getEmployeeById($id); // busca al empleado actual
            if ($actual && isset($actual['id'])) {
                $exists = true; // si existe, marcamos que será actualización

                // Carga datos actuales por defecto
                $nombre        = $actual['nombre'];
                $apellido      = $actual['apellido'];
                $dni           = $actual['dni'];
                $email         = $actual['email'];
                $puesto        = $actual['puesto'];
                $salario       = (float)$actual['salario'];
                $fecha_ingreso = $actual['fecha_ingreso'];
            }
        }

        // Sobrescribe con los valores que llegan por formulario ($_POST normalmente)
        if (isset($param['nombre']))        $nombre = trim($param['nombre']);
        if (isset($param['apellido']))      $apellido = trim($param['apellido']);
        if (isset($param['dni']))           $dni = trim($param['dni']);
        if (isset($param['email']))         $email = trim($param['email']);
        if (isset($param['puesto']))        $puesto = trim($param['puesto']);
        if (isset($param['salario']))       $salario = (float)$param['salario'];
        if (isset($param['fecha_ingreso'])) $fecha_ingreso = $param['fecha_ingreso'];

       
        // SI EXISTE → UPDATE
       
        if ($exists) {
            $sql = "UPDATE {$this->table}
                       SET nombre=?, apellido=?, dni=?, email=?, puesto=?, salario=?, fecha_ingreso=?
                     WHERE id=?";
            $stmt = $this->conection->prepare($sql);

            // "sssssdsi" → string, string, string, string, string, double, string, int
            $stmt->bind_param(
                'sssssdsi',
                $nombre, $apellido, $dni, $email, $puesto, $salario, $fecha_ingreso, $id
            );
            $stmt->execute();

       
        // SI NO EXISTE → INSERT
      
        } else {
            $sql = "INSERT INTO {$this->table}
                       (nombre, apellido, dni, email, puesto, salario, fecha_ingreso)
                    VALUES (?,?,?,?,?,?,?)";
            $stmt = $this->conection->prepare($sql);

            // "sssssds" → string, string, string, string, string, double, string
            $stmt->bind_param(
                'sssssds',
                $nombre, $apellido, $dni, $email, $puesto, $salario, $fecha_ingreso
            );
            $stmt->execute();

            // Obtiene el id del nuevo registro insertado
            $id = $this->conection->insert_id;
        }

        return $id; // Devuelve el id del empleado insertado o actualizado
    }


    // ELIMINAR EMPLEADO POR ID
   
    public function deleteEmployeeById(int $id): bool {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param('i', $id); // "i" → entero
        return $stmt->execute();
    }

}