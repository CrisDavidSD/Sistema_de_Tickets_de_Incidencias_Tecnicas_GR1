<?php
require_once 'ConexionBDD.php';

/**
 * Clase que representa una incidencia del sistema.
 */
class Incidencia {
    private $id;
    private $nombre;
    private $descripcion;
    private $prioridad;
    private $usuario_id;

    public function __construct($nombre = null, $descripcion = null, $prioridad = null, $usuario_id = null) {
        $this->nombre      = $nombre;
        $this->descripcion = $descripcion;
        $this->prioridad   = $prioridad;
        $this->usuario_id  = $usuario_id;
    }

    // ---------- Getters ----------

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getPrioridad() {
        return $this->prioridad;
    }

    public function getUsuarioId() {
        return $this->usuario_id;
    }

    // ---------- Setters ----------

    public function setId($id) {
        $this->id = $id;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setPrioridad($prioridad) {
        $this->prioridad = $prioridad;
    }

    public function setUsuarioId($usuario_id) {
        $this->usuario_id = $usuario_id;
    }

    public function toString() {
        return "| id: " . $this->getId() .
               " | nombre: " . $this->getNombre() .
               " | descripcion: " . $this->getDescripcion() .
               " | prioridad: " . $this->getPrioridad() .
               " | usuario_id: " . $this->getUsuarioId();
    }

    // ---------- Operaciones BDD ----------

    /**
     * Inserta una nueva incidencia en la base de datos.
     * Retorna true si la inserción fue exitosa, false si no.
     * Lanza PDOException si ocurre un error de base de datos.
     */
    public function insertar() {
        $sql = "INSERT INTO incidencia (nombre, descripcion, prioridad, usuario_id) 
                VALUES (?, ?, ?, ?)";

        $conn = new ConexionBDD();
        $stmt = $conn->getConexion()->prepare($sql);
        $resultado = $stmt->execute([
            $this->nombre,
            $this->descripcion,
            $this->prioridad,
            $this->usuario_id
        ]);

        return $resultado; // true si se insertó correctamente
    }

    /**
	 * Obtener todas las incidencias por el Id de un usuario.
     * Retorna un array de objetos Incidencia.
     * Lanza Exception si ocurre un error de base de datos.
	 */
    public function obtenerPorUsuarioId($usuario_id){
         $sql = "SELECT * FROM incidencia WHERE usuario_id = ?";

        try {
            $cnn = new ConexionBDD();
            $stmt = $cnn->getConexion()->prepare($sql);
            $stmt->execute([$usuario_id]);
            
            $filas = $stmt->fetchAll();
            $incidencias = [];
            foreach ($filas as $fila) {
                $incidencia = new Incidencia($fila['nombre']);
                $incidencia->setId($fila['id']);
                $incidencias[] = $incidencia;
            }
            return $incidencias;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener incidencias: " . $e->getMessage());
        }
    }

    /**
     * Obtener una incidencia por su ID.
     * Retorna un objeto Incidencia o null si no se encuentra.
     */
    public function obtenerPorId($id) {
        $sql = "SELECT * FROM incidencia WHERE id = ?";

        try {
            $cnn = new ConexionBDD();
            $stmt = $cnn->getConexion()->prepare($sql);
            $stmt->execute([$id]);

            $fila = $stmt->fetch();
            if ($fila) {
                $incidencia = new Incidencia(
                    $fila['nombre'],
                    $fila['descripcion'],
                    $fila['prioridad'],
                    $fila['usuario_id']
                );
                $incidencia->setId($fila['id']);
                return $incidencia;
            }
            return null;
        } catch (PDOException $e) {
            throw new Exception("Error al obtener la incidencia: " . $e->getMessage());
        }
    }
}
?>