<?php

namespace Sts\Models\Email;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para LER emails
 */
class Read {
    /** @var object $conn Recebe a conexão com bacno de dados */
    private object $conn;

    // BUSCANDO EMAILS POR ORDEM DE ID MAIS NOVO
    public function allEmail($amount, $start) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM email
                ORDER BY id DESC
                LIMIT $amount OFFSET $start
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetchAll();
        return $result;
    }

    // BUSCANDO EMAIL POR ID
    public function emailId($id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM email WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam("id", $id);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }

    // BUSCANDO EMAIL NAO LIDOS / LIDOS
    public function unread($amount, $start, $view) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT * FROM email WHERE view = :view LIMIT $amount OFFSET $start";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('view', $view);
       
        $stmt->execute();
        $result = $stmt->fetchAll();

        return $result;
    }


    // ----------------------------- BUSCANDO QUANTIDADES -----------------------------
    // FUNCAO PARA QUNATIDADE DE REGISTRO
    public function count() {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) FROM email";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }

    // BUSCANDO QUANTIDADE DE EMAIL NAO LIDOS / LIDOS
    public function countUnread($view) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "SELECT COUNT(id) AS view FROM email
                WHERE view = :view
            ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam('view', $view);
       
        $stmt->execute();
        $result = $stmt->fetch();

        return $result;
    }

}