<?php

namespace Sts\Models\Exam;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para LER exames
 */
class Read {
    /** @var object $conn Recebe a conexão com bacno de dados */
    private object $conn;

    private $situation = true;

    // BUSCANDO EXAMES DO ALUNO
    public function exam($student, $order) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM exam 
                WHERE student_id = :student_id
                ORDER BY dateExam $order
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('student_id', $student);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    // BUSCANDO ULTIMO EXAME DO ALUNO
    public function lastExam($student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM exam 
                WHERE student_id = :student_id
                ORDER BY dateExam DESC
                LIMIT 1
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('student_id', $student);
       
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }


    // BUSCANDO EXAME POR ID
    public function examId($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM exam 
                WHERE id = :id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);
       
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

}