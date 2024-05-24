<?php

namespace Sts\Models\Price;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para ALTERAR precos
 */
class Update {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // ALTERAR PRECO
    public function updatePrice($Price) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE prices SET 
            name = ?,
            time = ?,
            price = ?,
            month = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $Price['name'],
            $Price['time'],
            $Price['price'],
            $Price['month'],
            $Price['id']
        ]);
    }

    // ALTERAR SITUACAO DO PRECO
    public function updateSituation($price) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE prices SET 
            situation = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $price['situation'],
            $price['id']
        ]);
    }

    // ALTERAR DESTAQUE DO PRECO
    public function updateEmphasis($price) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE prices SET 
            emphasis = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $price['emphasis'],
            $price['id']
        ]);
    }

    // ALTERAR DESTAQUE DE TODOS PRECO PARA FALSE
    public function updateAllEmphasis($price) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $emphasis = false;

        $sql = "UPDATE prices SET 
            emphasis = ?
            WHERE id <> ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $emphasis,
            $price['id']
        ]);
    }


    // -------------------- SHCEMES --------------------
    // ALTERAR SHCEMES
    public function updateScheme($scheme) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE scheme_price SET 
            scheme = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $scheme['scheme'],
            $scheme['id']
        ]);
    }
    
}