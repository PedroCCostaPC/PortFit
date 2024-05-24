<?php

namespace Sts\Models\Supplement;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para LER auplementacao
 */
class Read {
    /** @var object $conn Recebe a conexão com bacno de dados */
    private object $conn;

    private $situation = true;

    // BUSCANDO QUANTIDADE DE SUPLEMENTOS POR DIA
    public function countDaySupplement($student, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) AS counter
                FROM supplements
                WHERE day = :day
                AND student_id = :student_id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('day', $day);
        $stmt->bindParam('student_id', $student);
       
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

    // BUSCANDO TODA SUPLEMENTACAO DO ALUNO POR DIA
    public function allSupplement($student, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM supplements WHERE day = :day AND student_id = :student_id ORDER BY time ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('day', $day);
        $stmt->bindParam('student_id', $student);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    // BUSCANDO TODA SUPLEMENTACAO DO ALUNO POR DIA (SOMENTE ID)
    public function allSupplementId($student, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT id FROM supplements WHERE day = :day AND student_id = :student_id ORDER BY time ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('day', $day);
        $stmt->bindParam('student_id', $student);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    // BUSCANDO ALGUMA SUPLEMENTACAO DO ALUNO
    public function existSupplement($student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT id FROM supplements WHERE student_id = :student_id LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('student_id', $student);
       
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }
}