<?php 

class TypesServices {
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
        try {
            $sql = "SELECT * FROM types";
            $stmt = $this->db->query($sql)->fetchAll();
            return $stmt;
        } catch(Exception $e) {
            throw new Exception("Error al traer las categorias de la base de datos");
        }
    }
}