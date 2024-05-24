<?php

namespace Sts\Models\Modality;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para CRIAR modalidade
 */
class Create {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // CRIAR MODALIDADE
    public function createModality($modality) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO modalities (
            name,
            summary,
            phrase,
            about,
            whyte,
            banner,
            image,
            situation
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $modality['name'],
            $modality['summary'],
            $modality['phrase'],
            $modality['about'],
            $modality['whyte'],
            $modality['banner'],
            $modality['image'],
            $modality['situation']
        ]);
    }

    // CRIAR HORARIOS
    public function createTime($time, $day, $modality) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO time_modality (
            day,
            open,
            close,
            modality_id
        ) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $day,
            $time['open'],
            $time['close'],
            $modality
        ]);
    }
}