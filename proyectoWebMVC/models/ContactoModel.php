
<?php
// models/ContactoModel.php

class ContactoModel {
    private $db;

    public function __construct($conexion) {
        $this->db = $conexion;
    }

    public function guardarContacto($nombre, $correo, $comentario) {
        try {
            $sql = "INSERT INTO contactos (nombre, correo, comentario)
                    VALUES (:nombre, :correo, :comentario)";

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':nombre' => $nombre,
                ':correo' => $correo,
                ':comentario' => $comentario
            ]);
        } catch (PDOException $e) {
            error_log("Error guardando contacto: " . $e->getMessage());
            return false;
        }
    }
}

