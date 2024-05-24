<?php

namespace Sts\Models\Price;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para DELETAR Precos
 */
class Delete {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // DELETAR PRECOS
    public function deletePrice($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM prices WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

    // -------------------- SCHEMES --------------------
    // DELETAR SCHEME
    public function deleteScheme($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM scheme_price WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

    // DELETAR TODOS OS SCHEME DE UM PRECO
    public function deleteSchemesPrice($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM scheme_price WHERE price_id = :price_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':price_id' => $id
        ]);
    }

}