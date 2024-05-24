<?php

namespace Sts\Models\Training;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para ALTERAR treinos
 */
class Update {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // ALTERAR TREINO
    public function updateTraining($training) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE training SET
            series = ?,
            min = ?,
            max = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $training['series'],
            $training['min'],
            $training['max'],
            $training['id']
        ]);
    }

}