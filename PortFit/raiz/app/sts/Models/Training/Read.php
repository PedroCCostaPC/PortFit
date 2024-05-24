<?php

namespace Sts\Models\Training;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para LER treinos
 */
class Read {
    /** @var object $conn Recebe a conexão com bacno de dados */
    private object $conn;

    private $situation = true;

    // BUSCANDO CATEGORIAS DO TREINO DE UM DIA DO ALUNO (EXERCICIO DEVE ESTAR COM SITUACAO ATIVA)
    public function trainingCategory($student, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT training.exCategory_id
                FROM training 
                LEFT JOIN ex_category ON training.exCategory_id = ex_category.id
                LEFT JOIN exercises ON training.exercise_id = exercises.id
                WHERE student_id = :student_id 
                AND day = :day
                AND situation = :situation
                ORDER BY ex_category.name ASC
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('student_id', $student);
        $stmt->bindParam('day', $day);
        $stmt->bindParam('situation', $this->situation);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    // BUSCANDO TODOS TREINO DO ALUNO (EXERCICIO DEVE ESTAR COM SITUACAO ATIVA)
    public function allTrainingBase($student, $category, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT training.*, ex_category.name AS category, exercises.name AS exercise
                FROM training
                LEFT JOIN ex_category ON training.exCategory_id = ex_category.id
                LEFT JOIN exercises ON training.exercise_id = exercises.id
                WHERE training.student_id = :student_id 
                AND exercises.situation = :situation
                AND training.exCategory_id = :exCategory_id
                AND training.day = :day
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('student_id', $student);
        $stmt->bindParam('situation', $this->situation);
        $stmt->bindParam('exCategory_id', $category);
        $stmt->bindParam('day', $day);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    // BUSCANDO TODOS TREINO DO ALUNO (ID)
    public function oldTraining($student, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT id FROM training
                WHERE training.student_id = :student_id
                AND training.day = :day
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('student_id', $student);
        $stmt->bindParam('day', $day);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    // BUSCANDO QUANTIDADE DE EXERCICIO POR DIA
    public function countDayExercise($student, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(training.id) AS counter, exercises.situation AS situation
                FROM training
                LEFT JOIN exercises ON training.exercise_id = exercises.id
                WHERE training.day = :day
                AND training.student_id = :student_id
                AND exercises.situation = :situation
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('student_id', $student);
        $stmt->bindParam('day', $day);
        $stmt->bindParam('situation', $this->situation);
       
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }


    // BUSCA DIAS DA SEMANA QUE ALUNO TREINA (EXERCICIO DEVE ESTAR COM SITUACAO ATIVA)
    public function activeDay($student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT training.day FROM training
                LEFT JOIN exercises ON training.exercise_id = exercises.id
                WHERE student_id = :student_id
                AND situation = :situation
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('student_id', $student);
        $stmt->bindParam('situation', $this->situation);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    // BUSCANDO CATEGORIAS DE UM DIA DO ALUNO (EXERCICIO DEVE ESTAR COM SITUACAO ATIVA)
    public function categoryDay($student, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT training.exCategory_id AS category_id, ex_category.name AS category
                FROM training 
                LEFT JOIN ex_category ON training.exCategory_id = ex_category.id
                LEFT JOIN exercises ON training.exercise_id = exercises.id
                WHERE student_id = :student_id 
                AND day = :day
                AND situation = :situation
                ORDER BY ex_category.name ASC
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('student_id', $student);
        $stmt->bindParam('day', $day);
        $stmt->bindParam('situation', $this->situation);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }




    // BUSCANDO TODOS TREINO DO ALUNO (EXERCICIO DEVE ESTAR COM SITUACAO ATIVA)
    // TODOS OS DADOS DO EXERCICIO
    public function allCompleteTrainingBase($student, $category, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT training.*, training.id AS training_id, ex_category.name AS category, exercises.*
                FROM training
                LEFT JOIN ex_category ON training.exCategory_id = ex_category.id
                LEFT JOIN exercises ON training.exercise_id = exercises.id
                WHERE training.student_id = :student_id 
                AND exercises.situation = :situation
                AND training.exCategory_id = :exCategory_id
                AND training.day = :day
                ORDER BY exercises.name ASC
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('student_id', $student);
        $stmt->bindParam('situation', $this->situation);
        $stmt->bindParam('exCategory_id', $category);
        $stmt->bindParam('day', $day);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }



    // BUSCANDO TREINO DO ALUNO (EXERCICIO DEVE ESTAR COM SITUACAO ATIVA)
    public function trainingDetails($training, $student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT training.*, ex_category.name AS category, exercises.*
                FROM training
                LEFT JOIN ex_category ON training.exCategory_id = ex_category.id
                LEFT JOIN exercises ON training.exercise_id = exercises.id
                WHERE training.id = :id 
                AND training.student_id = :student_id
                AND exercises.situation = :situation
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $training);
        $stmt->bindParam('student_id', $student);
        $stmt->bindParam('situation', $this->situation);
       
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

}