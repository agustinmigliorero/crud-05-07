<?php 

class UsersServices {
    private $db;
    public function __construct()
    {
        try {
            $this->db = DB::connection(); 
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getAll() {
        try{
            $sql = "SELECT * FROM usuarios";
            $stmt = $this->db->query($sql)->fetchAll();

            return $stmt;
        } catch(Exception $e) {
            throw new Exception("Error al buscar todos los usuarios");
        }
    }

    public function getByEmail($email) {
        try{
            $sql = "SELECT * FROM usuarios WHERE email = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$email]);

            return $stmt->fetch();
        } catch(Exception $e) {
            throw new Exception("Error al buscar todos los usuarios");
        }
    }

    public function create($datos) {
        try{
            $sql = "INSERT INTO usuarios (name, email, password) VALUES (?,?,?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$datos["name"], $datos["email"], $datos["password"]]);

            return "Usuario creado correctamente";
        } catch(Exception $e) {
            throw new Exception("Error al crear un usuario");
        }
    }
}