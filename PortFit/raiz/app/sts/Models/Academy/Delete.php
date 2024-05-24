<?php

namespace Sts\Models\Academy;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para DELETAR informacoes da Academia
 */
class Delete {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // ---------------------- FOTOS ----------------------
    public function deletePhoto($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM photos WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

}