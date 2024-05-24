<?php

namespace Sts\Models\Email;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para CRIAR Email de contato
 */
class Create {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // CRIAR EMAIL DE CONTATO
    public function createContact($email) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO email (
            name,
            email,
            student,
            ddd,
            phone,
            message,
            date,
            time,
            view
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $email['name'],
            $email['email'],
            $email['student'],
            $email['ddd'],
            $email['phone'],
            $email['message'],
            $email['date'],
            $email['time'],
            $email['view']
        ]);
    }
}