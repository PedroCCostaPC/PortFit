<?php

namespace Sts\Models\Supplement;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para ALTERAR Suplemento
 */
class Update {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // ALTERAR SUPLEMENTO
    public function updateSupplement($supplement) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE supplements SET
            time = ?,
            supplement = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $supplement['time'],
            $supplement['supplement'],
            $supplement['id']
        ]);
    }

}