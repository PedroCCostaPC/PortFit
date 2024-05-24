<?php

namespace Sts\Models\Academy;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para ALTERAR informacoes da Academia (endereco, telefone, email, horarios, etc)
 */
class Update {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // ALTERAR ENDERECO DA ACADEMIA
    public function updateAcademy($academy) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE unit SET 
            address = ?,
            road = ?,
            number = ?,
            cep = ?,
            state = ?,
            uf = ?,
            map = ?,
            banner = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $academy['address'],
            $academy['road'],
            $academy['number'],
            $academy['cep'],
            $academy['state'],
            $academy['uf'],
            $academy['map'],
            $academy['banner'],
            $academy['id']
        ]);
    }


    // ALTERAR CONTATO DA ACADEMIA
    public function updateContact($contact) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE contact SET 
            ddd = ?,
            phone = ?,
            dddSapp = ?,
            whatsapp = ?,
            email = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $contact['ddd'],
            $contact['phone'],
            $contact['dddSapp'],
            $contact['whatsapp'],
            $contact['email'],
            $contact['id']
        ]);
    }


    // ALTERAR HORARIO DA ACADEMIA
    public function updateTime($time) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE unit SET 
            openWeek = ?,
            closeWeek = ?,
            openHoliday = ?,
            closeHoliday = ?,
            openSaturday = ?,
            closeSaturday = ?,
            openSunday = ?,
            closeSunday = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $time['openWeek'],
            $time['closeWeek'],
            $time['openHoliday'],
            $time['closeHoliday'],
            $time['openSaturday'],
            $time['closeSaturday'],
            $time['openSunday'],
            $time['closeSunday'],
            $time['id']
        ]);
    }
}