<?php

namespace Sts\Models\Training;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para DELETAR Treinos
 */
class Delete {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // DELETAR TREINO
    public function deleteTraining($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM training WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

    // DELETAR TODOS TREINO DE UM ALUNO EM UM DIA
    public function deleteAllTraining($student, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM training WHERE student_id = :student_id AND day = :day";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':student_id' => $student,
            ':day' => $day
        ]);
    }

    // DELETAR TODOS TREINO DE UM ALUNO
    public function deleteAllTrainingFull($student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM training WHERE student_id = :student_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':student_id' => $student
        ]);
    }

    // DELETAR TODOS TREINO DE UM EXERCICIO
    public function deleteAllTrainingExercise($exercise) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM training WHERE exercise_id = :exercise_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':exercise_id' => $exercise
        ]);
    }
}