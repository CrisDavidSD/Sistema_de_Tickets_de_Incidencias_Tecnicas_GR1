<?php
require_once 'ConexionBDD.php';
/**
 * Clase que representa un usuario.
 */
class Usuario {
	private $id;
	private $usuario;
	private $clave;

	public function __construct($usuario = null, $clave = null) {
		$this->usuario = $usuario;
		$this->clave = $clave;
	}

	public function getId() {
		return $this->id;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function getUsuario() {
		return $this->usuario;
	}

	public function setUsuario($usuario) {
		$this->usuario = $usuario;
	}

	public function getClave() {
		return $this->clave;
	}

	public function setClave($clave) {
		$this->clave = $clave;
	}

	public function toString(){
		return "| id: ". $this->getId(). 
		" | usuario: ". $this->getUsuario().
		" | clave: ". $this->getClave();
	}

	# metodos operaciones

    public function validarCredenciales($nombreUsuario, $claveIngresada) {
        $sql = "SELECT * FROM usuario WHERE usuario = ? AND clave = ?";
        
        try {
            $conn = new ConexionBDD();
            $stmt = $conn->getConexion()->prepare($sql);
            $stmt->execute([$nombreUsuario, $claveIngresada]);
            
            $fila = $stmt->fetch();
            if ($fila) {
                $this->setId($fila['id']);
                $this->setUsuario($fila['usuario']);
                $this->setClave($fila['clave']);
                return true; // Credenciales válidas
            } else {
                return false; // Credenciales no validas
            }
            
        } catch (PDOException $e) {
            throw new Exception("Error al validar credenciales: " . $e->getMessage());
        }

    }

}?>
