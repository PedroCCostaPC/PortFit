<?php

namespace Sts\Models\Student;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para DELETAR Alunos
 */
class Delete {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // DELETAR ALUNO
    public function deleteStudent($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "DELETE FROM students WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }
}