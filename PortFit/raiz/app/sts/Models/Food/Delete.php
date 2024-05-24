<?php

namespace Sts\Models\Food;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para DELETAR Alimentacoes
 */
class Delete {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // DELETAR ALIMENTACAO
    public function deleteFood($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM food WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

    // DELETAR TODAS ALIMENTACOES DE UM ALUNO EM UM DIA
    public function deleteAllFood($student, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM food WHERE student_id = :student_id AND day = :day";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':student_id' => $student,
            ':day' => $day
        ]);
    }

    // DELETAR TODAS ALIMENTACOES DE UM ALUNO
    public function deleteAllFoodFull($student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM food WHERE student_id = :student_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':student_id' => $student
        ]);
    }
}