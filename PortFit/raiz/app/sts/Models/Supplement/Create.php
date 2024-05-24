<?php

namespace Sts\Models\Supplement;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para CRIAR Suplementacao
 */
class Create {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // CRIAR SUPLEMENTACAO
    public function createSupplement($supplement, $day, $student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO supplements (
            day,
            time,
            supplement,
            student_id
        ) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $day,
            $supplement['time'],
            $supplement['supplement'],
            $student
        ]);
    }
}