<?php

namespace Sts\Models\Modality;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para ALTERAR modalidade
 */
class Update {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // ALTERAR MODALIDADE
    public function updateModality($modality) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE modalities SET 
            name = ?,
            summary = ?,
            phrase = ?,
            about = ?,
            whyte = ?,
            banner = ?,
            image = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $modality['name'],
            $modality['summary'],
            $modality['phrase'],
            $modality['about'],
            $modality['whyte'],
            $modality['banner'],
            $modality['image'],
            $modality['id']
        ]);
    }

    // ALTERAR SITUACAO DA MODALIDADE
    public function updateSituation($modality) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE modalities SET 
            situation = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $modality['situation'],
            $modality['id']
        ]);
    }


    // -------------------- HORARIO --------------------
    // ALTERAR HORARIO DA MODALIDADE
    public function updateTime($time) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE time_modality SET 
            open = ?,
            close = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $time['open'],
            $time['close'],
            $time['id']
        ]);
    }
}