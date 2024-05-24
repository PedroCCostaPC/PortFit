<?php

namespace Sts\Models\Social;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para LER Redes socias da academia
 */
class Read {
    /** @var object $conn Recebe a conexão com bacno de dados */
    private object $conn;


    // BUSCANDO REDES SOCIAIS
    public function social($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM social
                WHERE unit_id = :unit_id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("unit_id", $id);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    // BUSCANDO SOCIAL POR ID
    public function socialId($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM social WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("id", $id);

        $stmt->execute();
        $result = $stmt->fetch();
        
        return $result;
    }
}