<?php

namespace Sts\Models\Exercise;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para CRIAR exercicios
 */
class Create {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // CRIAR EXERCICIO
    public function createExercise($exercise) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO exercises (
            name,
            banner,
            description,
            video,
            external,
            situation,
            exCategory_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $exercise['name'],
            $exercise['banner'],
            $exercise['description'],
            $exercise['video'],
            $exercise['external'],
            $exercise['situation'],
            $exercise['category']
        ]);
    }

    // CRIAR CATEGORIA
    public function createCategory($category) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO ex_category (
            name
        ) VALUES (?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $category
        ]);
    }
}