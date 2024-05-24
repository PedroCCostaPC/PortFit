<?php

namespace Sts\Models\Employee;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para ALTERAR funcionarios
 */
class Update {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // ALTERAR FUNCIONARIO
    public function updateEmployee($employee) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE employees SET
            firstName = ?,
            lastName = ?,
            fullName = ?,
            birth = ?,
            sex = ?,
            rg = ?,
            email = ?,
            ddd = ?,
            phone = ?,
            photo = ?,
            position_id = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $employee['firstName'],
            $employee['lastName'],
            $employee['fullName'],
            $employee['birth'],
            $employee['sex'],
            $employee['rg'],
            $employee['email'],
            $employee['ddd'],
            $employee['phone'],
            $employee['photo'],
            $employee['position_id'],
            $employee['id']
        ]);
    }

    // ALTERAR SITUACAO DO FUNCIONARIO
    public function updateSituation($employee) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE employees SET 
            situation = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $employee['situation'],
            $employee['id']
        ]);
    }


    // ALTERAR MINHA CONTA
    public function updateMyAccount($employee) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE employees SET
            firstName = ?,
            lastName = ?,
            fullName = ?,
            birth = ?,
            sex = ?,
            rg = ?,
            email = ?,
            ddd = ?,
            phone = ?,
            photo = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $employee['firstName'],
            $employee['lastName'],
            $employee['fullName'],
            $employee['birth'],
            $employee['sex'],
            $employee['rg'],
            $employee['email'],
            $employee['ddd'],
            $employee['phone'],
            $employee['photo'],
            $employee['id']
        ]);
    }

    // ALTERAR MINHA SENHA
    public function updateMyPassword($id, $password) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE employees SET
            password = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $password,
            $id
        ]);
    }

    // ALTERAR TOKEN
    public function updateMyToken($id, $token) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE employees SET
            token = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $token,
            $id
        ]);
    }
}