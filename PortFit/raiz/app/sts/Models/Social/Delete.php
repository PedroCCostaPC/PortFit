<?php

namespace Sts\Models\Social;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para DELETAR rede social
 */
class Delete {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // DELETAR REDE SOCIAL
    public function deleteSocial($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM social WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

}