<?php

namespace Sts\Models\Exercise;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para ALTERAR exercicio
 */
class Update {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // ALTERAR EXERCICIO
    public function updateExercise($exercise) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE exercises SET
            name = ?,
            banner = ?,
            description = ?,
            video = ?,
            external = ?,
            exCategory_id = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $exercise['name'],
            $exercise['banner'],
            $exercise['description'],
            $exercise['video'],
            $exercise['external'],
            $exercise['category'],
            $exercise['id']
        ]);
    }

    // ALTERAR SITUACAO DO EXERCICIO
    public function updateSituation($exercise) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE exercises SET 
            situation = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $exercise['situation'],
            $exercise['id']
        ]);
    }


    // ALTERANDO CATEGORIA
    public function updateCategory($category) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE ex_category SET 
            name = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $category['name'],
            $category['id']
        ]);
    }

}