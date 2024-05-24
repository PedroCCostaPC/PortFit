<?php

namespace Sts\Models\Price;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para LER Precos
 */
class Read {
    /** @var object $conn Recebe a conexão com bacno de dados */
    private object $conn;

    private $situation = true;

    // BUSCANDO TODOS PRECOS
    public function allPrice() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();
    
        $sql = "SELECT * FROM prices ORDER BY price ASC";
    
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
    
        return $result;
    }

    
    // BUSCANDO PRECOS ATIVOS E NORMAIS
    public function active() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();
        $emphasis = false;
    
        $sql = "SELECT * FROM prices 
                WHERE situation = :situation 
                AND emphasis = :emphasis
                ORDER BY price ASC
            ";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("situation", $this->situation);
        $stmt->bindParam("emphasis", $emphasis);

        $stmt->execute();
        $result = $stmt->fetchAll();
    
        return $result;
    }

    // BUSCANDO PRECO DESTACADO
    public function priceEmphasis() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();
        $emphasis = true;
    
        $sql = "SELECT * FROM prices 
                WHERE situation = :situation 
                AND emphasis = :emphasis
                ORDER BY price ASC
            ";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("situation", $this->situation);
        $stmt->bindParam("emphasis", $emphasis);

        $stmt->execute();
        $result = $stmt->fetch();
    
        return $result;
    }


    // BUSCANDO PRECO POR ID
    public function priceId($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();
    
        $sql = "SELECT * FROM prices WHERE id = :id";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("id", $id);

        $stmt->execute();
        $result = $stmt->fetch();
    
        return $result;
    }


    // BUSCANDO ULTIMO PRECO
    public function lastPrice() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();
    
        $sql = "SELECT * FROM prices ORDER BY id DESC LIMIT 1";
    
        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetch();
    
        return $result;
    }



    // -------------- PLANOS DOS PRECOS --------------

    // BUSCANDO PLANOS DO PRECO
    public function schemePrice($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();
    
        $sql = "SELECT * FROM scheme_price WHERE price_id = :price_id ORDER BY scheme ASC";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("price_id", $id);

        $stmt->execute();
        $result = $stmt->fetchAll();
    
        return $result;
    }
}