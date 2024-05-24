<?php

namespace Sts\Models\Academy;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para CRIAR informacoes da Academia (endereco, telefone, email, horarios, etc)
 */
class Create {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // CRIAR ENDERECO DA ACADEMIA
    public function createUnit($academy) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO unit (
            headquarters,
            address,
            road,
            number,
            cep,
            state,
            uf,
            map,
            banner
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $academy['headquarters'],
            $academy['address'],
            $academy['road'],
            $academy['number'],
            $academy['cep'],
            $academy['state'],
            $academy['uf'],
            $academy['map'],
            $academy['banner']
        ]);
    }


    // CRIAR CONTATO DA ACADEMIA
    public function createContact($contact) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO contact (
            ddd,
            phone,
            dddSapp,
            whatsapp,
            email,
            unit_id
        ) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $contact['ddd'],
            $contact['phone'],
            $contact['dddSapp'],
            $contact['whatsapp'],
            $contact['email'],
            $contact['unit_id']
        ]);
    }

    // ----------------- CRIANDO FOTOS -----------------
    public function createPhoto($photo, $id) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO photos (
            name,
            unit_id
        ) VALUES (?, ?)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $photo,
            $id
        ]);
    }
}