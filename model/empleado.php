<?php
// model/empleado.php
require_once __DIR__ . '/db.php';

class Empleado {

    private $conection;
    private $table = 'empleados';

    public function __construct() {
        $db = new Db();
        $this->conection = $db->conection;
    }

    /* ===== Listar todos ===== */
    public function getEmployees(): array {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conection->prepare($sql);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_all(MYSQLI_ASSOC);
    }

    /* ===== Buscar por ID ===== */
    public function getEmployeeById(int $id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res->fetch_assoc(); // null si no existe
    }

    /* ===== Crear / Actualizar =====
       Espera en $param:
       nombre, apellido, dni, email, puesto, salario, fecha_ingreso (+ id opcional)
    */
    public function save(array $param) {
        // Valores por defecto
        $id = null;
        $nombre = $apellido = $dni = $email = $puesto = $fecha_ingreso = '';
        $salario = 0.0;

        // ¿Existe registro?
        $exists = false;
        if (!empty($param['id'])) {
            $id = (int)$param['id'];
            $actual = $this->getEmployeeById($id);
            if ($actual && isset($actual['id'])) {
                $exists = true;
                // fallback a valores actuales
                $nombre        = $actual['nombre'];
                $apellido      = $actual['apellido'];
                $dni           = $actual['dni'];
                $email         = $actual['email'];
                $puesto        = $actual['puesto'];
                $salario       = (float)$actual['salario'];
                $fecha_ingreso = $actual['fecha_ingreso'];
            }
        }

        // Nuevos valores recibidos
        if (isset($param['nombre']))        $nombre = trim($param['nombre']);
        if (isset($param['apellido']))      $apellido = trim($param['apellido']);
        if (isset($param['dni']))           $dni = trim($param['dni']);
        if (isset($param['email']))         $email = trim($param['email']);
        if (isset($param['puesto']))        $puesto = trim($param['puesto']);
        if (isset($param['salario']))       $salario = (float)$param['salario'];
        if (isset($param['fecha_ingreso'])) $fecha_ingreso = $param['fecha_ingreso'];

        if ($exists) {
            $sql = "UPDATE {$this->table}
                       SET nombre=?, apellido=?, dni=?, email=?, puesto=?, salario=?, fecha_ingreso=?
                     WHERE id=?";
            $stmt = $this->conection->prepare($sql);
            // 5 strings + salario (d) + fecha (s) + id (i) => 'sssssdsi'
            $stmt->bind_param(
                'sssssdsi',
                $nombre, $apellido, $dni, $email, $puesto, $salario, $fecha_ingreso, $id
            );
            $stmt->execute();
        } else {
            $sql = "INSERT INTO {$this->table}
                       (nombre, apellido, dni, email, puesto, salario, fecha_ingreso)
                    VALUES (?,?,?,?,?,?,?)";
            $stmt = $this->conection->prepare($sql);
            // 5 strings + salario (d) + fecha (s) => 'sssssds'
            $stmt->bind_param(
                'sssssds',
                $nombre, $apellido, $dni, $email, $puesto, $salario, $fecha_ingreso
            );
            $stmt->execute();
            $id = $this->conection->insert_id;
        }

        return $id; // id insertado o actualizado
    }

    /* ===== Eliminar por ID ===== */
    public function deleteEmployeeById(int $id): bool {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->conection->prepare($sql);
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    /* ===== Alias de compatibilidad ===== */
    public function all(): array { return $this->getEmployees(); }
    public function find(int $id) { return $this->getEmployeeById($id); }
    public function delete(int $id): bool { return $this->deleteEmployeeById($id); }
}