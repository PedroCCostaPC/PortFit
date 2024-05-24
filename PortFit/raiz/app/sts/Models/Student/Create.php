<?php

namespace Sts\Models\Student;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para CRIAR alunoas
 */
class Create {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // CRIAR ALUNO
    public function createStudent($student) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO students (
            firstName,
            lastName,
            fullName,
            birth,
            sex,
            rg,
            email,
            ddd,
            phone,
            password,
            situation
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
            $student['password'],
            $student['situation']
        ]);
    }

}