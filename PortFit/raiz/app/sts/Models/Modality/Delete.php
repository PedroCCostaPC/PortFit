<?php

namespace Sts\Models\Modality;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para DELETAR Modalidades
 */
class Delete {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // DELETAR MODALIDADE
    public function deleteModality($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM modalities WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

    // -------------------- HORARIO --------------------
    // DELETAR HORARIO
    public function deleteTime($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM time_modality WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

    // DELETAR TODOS OS HORARIOS DE UMA MODALIDADE
    public function deleteTimesModality($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM time_modality WHERE day = :modality_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':modality_id' => $id
        ]);
    }
}