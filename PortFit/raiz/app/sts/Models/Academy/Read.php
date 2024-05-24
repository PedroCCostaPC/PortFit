<?php

namespace Sts\Models\Academy;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para LER informacoes da Academia (endereco, telefone, email, horarios, etc)
 */
class Read {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // BUSCANDO ACADEMIA 'MATRIZ'
    public function academy() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();
        $headquarters = true;

        $sql = "SELECT * FROM unit 
                WHERE headquarters = :headquarters
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("headquarters", $headquarters);
       
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    // BUSCANDO ACADEMIA POR ID
    public function academyId($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM unit 
                WHERE id = :id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("id", $id);
       
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    // BUSCANDO CONTATO DA CADEMIA
    public function contact($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM contact 
                WHERE unit_id = :unit_id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("unit_id", $id);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    // BUSCANDO PRINCIPAL CONTATO DA CADEMIA
    public function contactMain($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM contact 
                WHERE unit_id = :unit_id
                ORDER BY id ASC
                LIMIT 1
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("unit_id", $id);
       
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }


    // ---------------------- FOTOS ----------------------
    // BUSCANDO TODAS FOTOS DE UMA UNIDADE
    public function selectPhotos($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM photos WHERE unit_id = :unit_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("unit_id", $id);

        $stmt->execute();
        $result = $stmt->fetchAll();
        
        return $result;
    }

    // BUSCANDO FOTO POR ID
    public function photoId($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM photos WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("id", $id);

        $stmt->execute();
        $result = $stmt->fetch();
        
        return $result;
    }

}