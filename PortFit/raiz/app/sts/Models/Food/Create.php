<?php

namespace Sts\Models\Food;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para CRIAR Alimentacao
 */
class Create {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // CRIAR ALIMENTACAO
    public function createFood($food, $day, $student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO food (
            day,
            time,
            food,
            student_id
        ) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $day,
            $food['time'],
            $food['food'],
            $student
        ]);
    }
}