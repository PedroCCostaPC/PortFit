<?php

namespace Sts\Models\Student;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para ALTERAR alunos
 */
class Update {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;


    // ALTERAR ALUNO
    public function updateStudent($student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE students SET
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
            $student['firstName'],
            $student['lastName'],
            $student['fullName'],
            $student['birth'],
            $student['sex'],
            $student['rg'],
            $student['email'],
            $student['ddd'],
            $student['phone'],
            $student['photo'],
            $student['id']
        ]);
    }

    // ALTERAR SITUACAO DO ALUNO
    public function updateSituation($student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE students SET 
            situation = ?
            WHERE id = ?
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $student['situation'],
            $student['id']
        ]);
    }


    // ALTERAR MINHA CONTA
    public function updateMyAccount($student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE students SET
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
            $student['firstName'],
            $student['lastName'],
            $student['fullName'],
            $student['birth'],
            $student['sex'],
            $student['rg'],
            $student['email'],
            $student['ddd'],
            $student['phone'],
            $student['photo'],
            $student['id']
        ]);
    }


    // ALTERAR MINHA SENHA
    public function updateMyPassword($id, $password) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "UPDATE students SET
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

        $sql = "UPDATE students SET
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