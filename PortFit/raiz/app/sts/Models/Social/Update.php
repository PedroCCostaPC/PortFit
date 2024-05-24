<?php

namespace Sts\Models\Social;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para ALTERAR rede social
 */
class Update {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // ALTERAR REDE SOCIAL
    public function updateSocial($social) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE social SET 
            name = ?,
            icon = ?,
            link = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $social['name'],
            $social['icon'],
            $social['link'],
            $social['id']
        ]);
    }
}