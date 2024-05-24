<?php

namespace Sts\Models\Social;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para CRIAR redes sociais
 */
class Create {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // CRIAR REDE SOCIAL DA ACADEMIA
    public function createSocial($social) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO social (
            name,
            icon,
            link,
            unit_id
        ) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $social['name'],
            $social['icon'],
            $social['link'],
            $social['unit_id']
        ]);
    }
}