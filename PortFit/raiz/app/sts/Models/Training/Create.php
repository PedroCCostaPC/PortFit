<?php

namespace Sts\Models\Training;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para CRIAR treinos
 */
class Create {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // CRIAR TREINO
    public function createTraining($training, $day, $student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO training (
            day,
            series,
            min,
            max,
            exercise_id,
            exCategory_id,
            student_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $day,
            $training['series'],
            $training['min'],
            $training['max'],
            $training['exercise_id'],
            $training['category'],
            $student
        ]);
    }
}