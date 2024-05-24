<?php

namespace Sts\Models\Modality;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para LER modalidades
 */
class Read {
    /** @var object $conn Recebe a conexão com bacno de dados */
    private object $conn;

    private bool $situation = true;

    // BUSCANDO TODAS MODALIDADES
    public function allModality() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM modalities 
                ORDER BY name ASC
            ";

        $stmt = $this->conn->prepare($sql);
       
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }


    // BUSCANDO MODALIDADES ATIVAS
    public function active() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM modalities 
                WHERE situation = :situation
                ORDER BY name ASC
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("situation", $this->situation);
       
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO MODALIDADES ATIVAS
    public function modalitiesFooter() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT id, name FROM modalities 
                WHERE situation = :situation
                ORDER BY name ASC
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("situation", $this->situation);
       
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO MODALIDADE POR ID
    public function modalityId($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM modalities WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("id", $id);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // BUSCANDO MODALIDADE POR ID - SOMENTE SE SITUACAO TIVER ATIVA
    public function modalityIdActive($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM modalities WHERE id = :id AND situation = :situation";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->bindParam("situation", $this->situation);

        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }


    // -------------------- HORARIO --------------------
    // BUSCANDO HORARIOS DA MODALIDADE
    public function time($id, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM time_modality 
                WHERE modality_id = :modality_id
                AND day = :day
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("modality_id", $id);
        $stmt->bindParam("day", $day);
       
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO QUANTIDADE DE HORARIOS DA MODALIDADE EM UM DIA DA SEMAMA
    public function timeCount($id, $day) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM time_modality
                WHERE modality_id = :modality_id
                AND day = :day
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("modality_id", $id);
        $stmt->bindParam("day", $day);
       
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }

    // BUSCANDO DIAS DA MODALIDADE
    public function dayModality($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT day FROM time_modality 
                WHERE modality_id = :modality_id
                ORDER BY day ASC
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("modality_id", $id);
       
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }

}