<?php 
require_once "Latihan_05.php";

class Alumni {
    private $conn;
    private $table_name = "alumni";

    public $id;
    public $nama;
    public $email;
    public $jurusan;
    public $tahun_lulus;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function getById() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        return $stmt;
    }

    public function add() {
        $query = "INSERT INTO " . $this->table_name . " (nama, email, jurusan, tahun_lulus)
                  VALUES (:nama, :email, :jurusan, :tahun_lulus)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":jurusan", $this->jurusan);
        $stmt->bindParam(":tahun_lulus", $this->tahun_lulus);
        return $stmt->execute();
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET nama = :nama, email = :email, jurusan = :jurusan, tahun_lulus = :tahun_lulus 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":jurusan", $this->jurusan);
        $stmt->bindParam(":tahun_lulus", $this->tahun_lulus);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }
}
?>
