<?php
    class Conexion {
        public function conectar() {
            define('server', 'localhost:33065');
            define('db', 'soa');
            define('user', 'root');
            define('password', '');
            
            try {
                $conn = new PDO("mysql:host=" . server . ";dbname=" . db, user, password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conn;
            } catch (PDOException $e) {
                
                die("Error en la conexión: " . $e->getMessage());
            }
        }
    }

?>
