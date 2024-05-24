<?php

namespace Sts\Models\Employee;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para LER funcionarios
 */
class Read {
    /** @var object $conn Recebe a conexão com bacno de dados */
    private object $conn;

    private $situation = true;
    private $bossId = BOSS;

    // BUSCANDO FUNCIONARIO POR EMAIL E SENHA
    public function employee($email, $password) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT employees.*, positions.name AS position 
                FROM employees LEFT JOIN positions ON employees.position_id = positions.id
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

    // BUSCANDO FUNCIONARIO POR ID
    public function employeeId($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT employees.*, positions.name AS position 
                FROM employees LEFT JOIN positions ON employees.position_id = positions.id
                WHERE employees.id = :id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);
       
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }


    // BUSCANDO FUNCIONARIO POR ID - SOMENTE SE SITUACAO TIVER ATIVA
    public function employeeIdActive($id, $email, $token) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT employees.*, positions.name AS position 
                FROM employees LEFT JOIN positions ON employees.position_id = positions.id
                WHERE employees.id = :id
                AND employees.email = :email
                AND employees.token = :token
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

    // BUSCANDO FUNCIONARIO POR RG
    public function employeeRG($rg) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM employees
                WHERE rg = :rg
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('rg', $rg);
       
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // BUSCANDO FUNCIONARIO POR EMAIL
    public function employeeEmail($email) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM employees
                WHERE email = :email
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('email', $email);
       
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }


    // BUSCANDO FUNCIONARIOS POR ORDEM DE ID MAIS NOVO
    public function allEmployee($amount, $start, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT employees.*, positions.name AS position 
                FROM employees LEFT JOIN positions ON employees.position_id = positions.id
                WHERE employees.id <> :id
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO FUNCIONARIOS POR ORDEM DE ID MAIS NOVO - EXCETO BOSS
    public function allEmployeeNotBoss($amount, $start, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT employees.*, positions.name AS position 
                FROM employees LEFT JOIN positions ON employees.position_id = positions.id
                WHERE employees.id <> :id
                AND position_id <> :position_id
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('position_id', $this->bossId);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    // BUSCANDO FUNCIONARIOS PELO CAMPO DE PESQUISA
    public function employeeSearch($amount, $start, $search, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT employees.*, positions.name AS position 
                FROM employees LEFT JOIN positions ON employees.position_id = positions.id
                WHERE fullName LIKE :fullName
                AND employees.id <> :id
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('fullName', $search);
        $stmt->bindParam('id', $id);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO FUNCIONARIOS PELO CAMPO DE PESQUISA (RG)
    public function employeeSearchRg($amount, $start, $search, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT employees.*, positions.name AS position 
                FROM employees LEFT JOIN positions ON employees.position_id = positions.id
                WHERE rg LIKE :rg
                AND employees.id <> :id
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('rg', $search);
        $stmt->bindParam('id', $id);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    // BUSCANDO FUNCIONARIOS PELO CAMPO DE PESQUISA - EXCETO BOOS
    public function employeeSearchNotBoss($amount, $start, $search, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT employees.*, positions.name AS position 
                FROM employees LEFT JOIN positions ON employees.position_id = positions.id
                WHERE fullName LIKE :fullName
                AND employees.id <> :id
                AND position_id <> :position_id
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('fullName', $search);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('position_id', $this->bossId);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO FUNCIONARIOS PELO CAMPO DE PESQUISA (RG) - EXCETO BOOS
    public function employeeSearchRgNotBoss($amount, $start, $search, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT employees.*, positions.name AS position 
                FROM employees LEFT JOIN positions ON employees.position_id = positions.id
                WHERE rg LIKE :rg
                AND employees.id <> :id
                AND position_id <> :position_id
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('rg', $search);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('position_id', $this->bossId);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    // BUSCANDO FUNCIONARIOS POR ORDEM DO NOME
    public function employeesOrderName($amount, $start, $order, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT employees.*, positions.name AS position 
                FROM employees LEFT JOIN positions ON employees.position_id = positions.id
                WHERE employees.id <> :id
                ORDER BY fullName $order
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO FUNCIONARIOS POR ORDEM DO NOME - EXCETO BOSS
    public function employeesOrderNameNotBoss($amount, $start, $order, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT employees.*, positions.name AS position 
                FROM employees LEFT JOIN positions ON employees.position_id = positions.id
                WHERE employees.id <> :id
                AND position_id <> :position_id
                ORDER BY fullName $order
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('position_id', $this->bossId);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    // BUSCANDO FUNCIONARIOS POR ATIVO OU INATIVO
    public function employeeSituation($amount, $start, $situation, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT employees.*, positions.name AS position 
                FROM employees LEFT JOIN positions ON employees.position_id = positions.id
                WHERE situation = $situation
                AND employees.id <> :id
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO FUNCIONARIOS POR ATIVO OU INATIVO - EXCETO BOSS
    public function employeeSituationNotBoss($amount, $start, $situation, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT employees.*, positions.name AS position 
                FROM employees LEFT JOIN positions ON employees.position_id = positions.id
                WHERE situation = $situation
                AND employees.id <> :id
                AND position_id <> :position_id
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('position_id', $this->bossId);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    // ----------------------------- BUSCANDO QUANTIDADES -----------------------------
    // FUNCAO PARA QUNATIDADE DE REGISTRO
    public function count($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM employees WHERE id <> :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // FUNCAO PARA QUNATIDADE DE REGISTRO - EXCETO BOSS
    public function countNotBoss($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM employees
                WHERE id <> :id
                AND position_id <> :position_id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('position_id', $this->bossId);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // FUNCAO PARA QUANTIDADE DE REGISTRO ACHADO EM CAMPO DE PESQUISA - NOME
    public function countSearch($search, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM employees
                WHERE fullName LIKE :fullName
                AND id <> :id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('fullName', $search);
        $stmt->bindParam('id', $id);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // FUNCAO PARA QUANTIDADE DE REGISTRO ACHADO EM CAMPO DE PESQUISA - RG
    public function countSearchRG($search, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM employees
                WHERE rg LIKE :rg
                AND id <> :id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('rg', $search);
        $stmt->bindParam('id', $id);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // FUNCAO PARA QUANTIDADE DE REGISTRO ACHADO EM CAMPO DE PESQUISA - NOME - EXCETO BOSS
    public function countSearchNotBoss($search, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM employees
                WHERE fullName LIKE :fullName
                AND id <> :id
                AND position_id <> :position_id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('fullName', $search);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('position_id', $this->bossId);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // FUNCAO PARA QUANTIDADE DE REGISTRO ACHADO EM CAMPO DE PESQUISA - RG - EXCETO BOSS
    public function countSearchRgNotBoss($search, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM employees
                WHERE rg LIKE :rg
                AND id <> :id
                AND position_id <> :position_id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('rg', $search);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('position_id', $this->bossId);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // FUNCAO PARA QUANTIDADE DE REGISTRO DE ATIVO OU INATIVO
    public function countSituation($situation, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM employees
                WHERE situation LIKE :situation
                AND id <> :id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('situation', $situation);
        $stmt->bindParam('id', $id);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }

    // FUNCAO PARA QUANTIDADE DE REGISTRO DE ATIVO OU INATIVO - EXCETO BOSS
    public function countSituationNotBoss($situation, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM employees
                WHERE situation LIKE :situation
                AND id <> :id
                AND position_id <> :position_id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('situation', $situation);
        $stmt->bindParam('id', $id);
        $stmt->bindParam('position_id', $this->bossId);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // ----------------------------- BUSCANDO CARGOS -----------------------------
    // FUNCAO PARA BUSCAR GARGOS
    public function allPositions() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM positions
            ";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // FUNCAO PARA BUSCAR GARGOS (EXCETO BOSS)
    public function allPositionsNotBoss() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM positions
                WHERE id <> :id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $this->bossId);

        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


}