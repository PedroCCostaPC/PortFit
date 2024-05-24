<?php

namespace Sts\Models\Student;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para LER alunos
 */
class Read {
    /** @var object $conn Recebe a conexão com bacno de dados */
    private object $conn;

    private $situation = true;

    // BUSCANDO ALUNO POR EMAIL E SENHA
    public function student($email, $password) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM students 
                WHERE email = :email
                AND password = :password
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('email', $email);
        $stmt->bindParam('password', $password);
       
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // BUSCANDO ALUNO POR ID
    public function studentId($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM students
                WHERE id = :id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);
       
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // BUSCANDO ALUNO POR RG
    public function studentRG($rg) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM students
                WHERE rg = :rg
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('rg', $rg);
       
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // BUSCANDO ALUNO POR EMAIL
    public function studentEmail($email) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM students
                WHERE email = :email
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('email', $email);
       
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // BUSCANDO ALUNO POR ID / EMAIL / TOKEN - SOMENTE SE SITUACAO TIVER ATIVA
    public function studentIdActive($id, $email, $token) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM students
                WHERE id = :id
                AND email = :email
                AND token = :token
                AND situation = :situation
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('email', $email);
        $stmt->bindParam('token', $token);
        $stmt->bindParam('situation', $this->situation);
       
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // BUSCANDO ALUNOS POR ORDEM DE ID MAIS NOVO
    public function allStudent($amount, $start) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM students
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO ALUNOS PELO CAMPO DE PESQUISA
    public function studentSearch($amount, $start, $search) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM students
                WHERE fullName LIKE :fullName
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('fullName', $search);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO ALUNOS PELO CAMPO DE PESQUISA (RG)
    public function studentSearchRG($amount, $start, $search) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM students
                WHERE rg LIKE :rg
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('rg', $search);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    // BUSCANDO ALUNOS POR ORDEM DO NOME
    public function studentOrderName($amount, $start, $order) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM students
                ORDER BY fullName $order
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO ALUNOS POR ATIVO OU INATIVO
    public function studentSituation($amount, $start, $situation) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM students
                WHERE situation = $situation
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }



    // BUSCANDO ALUNOS PARA ENVIO DE EMAILS MARKETING
    public function studentSendEmail() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT firstName AS name, email FROM students";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }



    // ----------------------------- BUSCANDO QUANTIDADES -----------------------------
    // FUNCAO PARA QUNATIDADE DE REGISTRO
    public function count() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM students";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // FUNCAO PARA QUANTIDADE DE REGISTRO ACHADO EM CAMPO DE PESQUISA - NOME
    public function countSearch($search) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM students
                WHERE fullName LIKE :fullName
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('fullName', $search);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // FUNCAO PARA QUANTIDADE DE REGISTRO ACHADO EM CAMPO DE PESQUISA - RG
    public function countSearchRG($search) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM students
                WHERE rg LIKE :rg
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('rg', $search);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // FUNCAO PARA QUANTIDADE DE REGISTRO DE ATIVO OU INATIVO
    public function countSituation($situation) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM students
                WHERE situation LIKE :situation
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('situation', $situation);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
}