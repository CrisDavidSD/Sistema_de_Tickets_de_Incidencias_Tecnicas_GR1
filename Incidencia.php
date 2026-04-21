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
}
?>