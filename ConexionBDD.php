<?php
/**
 * Clase para gestionar la conexión a la Base de Datos
 * Utiliza PDO para mayor seguridad contra inyecciones SQL
 */
class ConexionBDD {
    private $host = 'localhost:3306';
    private $db = 'bd_sistema_incidencias';
    private $user = 'root';
    private $pass = ''; 
    private $charset = 'utf8mb4';
    
    private $pdo;
    
    /**
     * Constructor: Establece la conexión a la BD
     */
    public function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            
            // Configurar para que lance excepciones en errores
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Configurar para que devuelva arrays asociativos
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            // Si falla la conexión, enviamos un error 500 (Internal Server Error)
            http_response_code(500);
            die("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }
    
    /**
     * Obtener la instancia de PDO
     * @return PDO
     */
    public function getConexion() {
        return $this->pdo;
    }
    
}
?>