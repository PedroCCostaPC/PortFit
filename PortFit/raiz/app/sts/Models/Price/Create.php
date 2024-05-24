<?php

namespace Sts\Models\Price;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para CRIAR precos
 */
class Create {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // CRIAR PRECO
    public function createPrice($price) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO prices (
            name,
            time,
            price,
            month,
            emphasis,
            situation
        ) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $price['name'],
            $price['time'],
            $price['price'],
            $price['month'],
            $price['emphasis'],
            $price['situation']
        ]);
    }

    // -------------------- SHCEMES --------------------
    // CRIAR COMPONENTES DO PRECO
    public function createScheme($scheme, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO scheme_price (
            scheme,
            price_id
        ) VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $scheme,
            $id
        ]);
    }

}