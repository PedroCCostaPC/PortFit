<?php

namespace Sts\Models\Food;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para LER alimentacao
 */
class Read {
    /** @var object $conn Recebe a conexão com bacno de dados */
    private object $conn;

    private $situation = true;

    // BUSCANDO QUANTIDADE DE ALIMENTACO POR DIA
    public function countDayFood($student, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) AS counter
                FROM food
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

    // BUSCANDO TODA ALIMENTACAO DO ALUNO POR DIA
    public function allFood($student, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM food WHERE day = :day AND student_id = :student_id ORDER BY time ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('day', $day);
        $stmt->bindParam('student_id', $student);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    // BUSCANDO TODA ALIMENTACAO DO ALUNO POR DIA (SOMENTE ID)
    public function allFoodId($student, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT id FROM food WHERE day = :day AND student_id = :student_id ORDER BY time ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('day', $day);
        $stmt->bindParam('student_id', $student);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }

    // BUSCANDO ALGUMA ALIMENTACAO DO ALUNO
    public function existFood($student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT id FROM food WHERE student_id = :student_id LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('student_id', $student);
       
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

}