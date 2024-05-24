<?php

namespace Sts\Models\Email;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para DELETAR email
 */
class Delete {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // DELETAR EMAIL
    public function deleteEmail($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM email WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }
}