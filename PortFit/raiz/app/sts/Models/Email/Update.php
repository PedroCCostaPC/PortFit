<?php

namespace Sts\Models\Email;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para ALTERAR email
 */
class Update {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // ALTERAR VIEW DO EMAIL
    public function updateView($email) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE email SET 
            view = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $email['view'],
            $email['id']
        ]);
    }
}