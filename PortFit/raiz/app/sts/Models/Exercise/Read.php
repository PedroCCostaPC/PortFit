<?php

namespace Sts\Models\Exercise;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para LER exercicios
 */
class Read {
    /** @var object $conn Recebe a conexão com bacno de dados */
    private object $conn;

    private $situation = true;

    // BUSCANDO EXERCICIOS POR ORDEM DE ID MAIS NOVO
    public function allExercise($amount, $start) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT exercises.*,
                ex_category.name AS category
                FROM exercises
                LEFT JOIN ex_category ON exercises.exCategory_id = ex_category.id
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO EXERCICIOS PELO CAMPO DE PESQUISA
    public function exerciseSearch($amount, $start, $search) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT exercises.*,
                ex_category.name AS category
                FROM exercises
                LEFT JOIN ex_category ON exercises.exCategory_id = ex_category.id
                WHERE exercises.name LIKE :name
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('name', $search);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }


    // BUSCANDO EXERCICIOS POR ORDEM DO NOME
    public function exerciseOrderName($amount, $start, $order) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT exercises.*,
                ex_category.name AS category
                FROM exercises
                LEFT JOIN ex_category ON exercises.exCategory_id = ex_category.id
                ORDER BY exercises.name $order
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO EXERCICIOS POR ATIVO OU INATIVO
    public function exerciseSituation($amount, $start, $situation) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT exercises.*,
                ex_category.name AS category
                FROM exercises
                LEFT JOIN ex_category ON exercises.exCategory_id = ex_category.id
                WHERE exercises.situation = $situation
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }


    // BUSCANDO EXERCICIOS POR ID
    public function exerciseId($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT exercises.*,
                ex_category.name AS category
                FROM exercises
                LEFT JOIN ex_category ON exercises.exCategory_id = ex_category.id
                WHERE exercises.id = :id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }


    // BUSCANDO EXERCICIOS POR CATEGORIA E SITUACAO ATIVA (SOMENTE NOME E ID)
    public function categoryExerciseBase($category) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT id, name FROM exercises 
                WHERE exCategory_id = :exCategory_id
                AND situation = :situation
                ORDER BY name ASC
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("exCategory_id", $category);
        $stmt->bindParam("situation", $this->situation);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

    // ----------------------------- BUSCANDO QUANTIDADES -----------------------------
    // FUNCAO PARA QUNATIDADE DE REGISTRO
    public function count() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM exercises";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }

    // FUNCAO PARA QUANTIDADE DE REGISTRO ACHADO EM CAMPO DE PESQUISA
    public function countSearch($search) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM exercises
                WHERE name LIKE :name
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('name', $search);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }

    // FUNCAO PARA QUANTIDADE DE REGISTRO DE ATIVO OU INATIVO
    public function countSituation($situation) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM exercises
                WHERE situation LIKE :situation
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('situation', $situation);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }

    // ----------------------------- BUSCANDO CATEGORIAS -----------------------------
    // BUSCANDO TODAS CATEGORIAS
    public function allCategory() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM ex_category ORDER BY name ASC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }


    // BUSCANDO ULTIMA CATEGORIA
    public function lastCategory() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT id FROM ex_category ORDER BY id DESC LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }

    // CHECANDO SE CATEGORIA ESTA VINCULADA A ALGUM EXERCICIO
    public function usingCategory($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM exercises WHERE exCategory_id = :exCategory_id LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('exCategory_id', $id);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }


    // BUSCANDO CATEGORIA DE UM EXERCICIO
    public function exerciseCategoryId($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT exCategory_id FROM exercises
                WHERE id = :id
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('id', $id);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }

    // BUSCANDO CATEGORIA POR NOME
    public function categoryName($name) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM ex_category
                WHERE name = :name
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('name', $name);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }
}