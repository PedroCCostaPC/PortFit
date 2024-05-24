<?php

namespace Sts\Models\Exam;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para DELETAR exames
 */
class Delete {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // DELETAR EXAME
    public function deleteExam($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM exam WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

    // DELETAR TODOS EXAMES DE UM ALUNO
    public function deleteAllExam($student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM exam WHERE student_id = :student_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':student_id' => $student
        ]);
    }

}