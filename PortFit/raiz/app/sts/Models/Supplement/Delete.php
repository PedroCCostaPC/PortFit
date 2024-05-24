<?php

namespace Sts\Models\Supplement;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para DELETAR Suplementacao
 */
class Delete {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // DELETAR SUPLEMENTO
    public function deleteSupplement($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM supplements WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

    // DELETAR TODA SUPLEMENTACAO DE UM ALUNO EM UM DIA
    public function deleteAllSupplement($student, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM supplements WHERE student_id = :student_id AND day = :day";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':student_id' => $student,
            ':day' => $day
        ]);
    }

    // DELETAR TODAS SUPLEMENTACAO DE UM ALUNO
    public function deleteAllSupplementFull($student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM supplements WHERE student_id = :student_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':student_id' => $student
        ]);
    }
}