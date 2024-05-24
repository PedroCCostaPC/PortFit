<?php

namespace Sts\Models\Employee;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

/**
 * Classe para CRIAR funcionarios
 */
class Create {
    /** @var object $conn Recebe a conexão com banco de dados */
    private object $conn;

    // CRIAR FUNCIONARIO
    public function createEmployee($employee) {
        $conn = new \Sts\db\Conn();
        $this->conn = $conn->connectDb();

        $sql = "INSERT INTO employees (
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
            situation,
            position_id
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

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
            $employee['password'],
            $employee['situation'],
            $employee['position_id']
        ]);
    }

}