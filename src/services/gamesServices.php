<?php 

require_once __DIR__ . "/../../config/db.php";

class GamesServices {
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
            $sql = "SELECT videogames.id, title, release_year, developer, types.name as category  FROM videogames INNER JOIN types ON type_id = types.id";
            $stmt = $this->db->query($sql)->fetchAll();

            return $stmt;
        } catch (Exception $e) {
            throw new Exception("Error al traer todos los registros de la base de datos");
        }
    }

    public function getById($id) {
        try {
            $sql = "SELECT * FROM videogames WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch();
        } catch (Exception $e) {
            throw new Exception("Error al traer un registro de la base de datos");
        }
    }

    public function create($datos) {
        try {
            $sql = "INSERT INTO videogames (title, release_year, developer, type_id) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$datos["title"], $datos["release_year"], $datos["developer"], $datos["type_id"]]);
            return "Juego creado correctamente";
        }
        catch (Exception $e){
            throw new Exception("Error al crear un registro en la base de datos");
        }
    }

    public function update($datos, $id) {
        try {
            var_dump($datos, $id);
            $sql = "UPDATE videogames SET title = ?, release_year = ?, developer = ?, type_id = ? WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$datos["title"], $datos["release_year"], $datos["developer"], $datos["type_id"], $id]);
            return "Juego editado correctamente";
        }
        catch (Exception $e){
            throw new Exception("Error al actualizar un registro en la base de datos");
        }
    }
    
    public function delete($id) {
        try {
            $sql = "DELETE FROM videogames WHERE id = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id]);
            return "Registro eliminado correctamente";
        } catch(Exception $e) {
            throw new Exception("Error al eliminar un registro en la base de datos");
        }
    }
}