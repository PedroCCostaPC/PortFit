<?php
namespace Sts\db;

use PDO;
use PDOException;

require_once(dirname(__FILE__, 4) . '/core/BlockFile.php'); 

class Conn {
    private string $host = HOST;
    private string $user = USER;
    private string $pass = PASS;
    private string $dbname = DBNAME;
    private int|string $port = PORT;
    private object $connect;

    public function connectDb(): object {
        try {
            // Conexão com a porta
            $this->connect = new PDO("mysql:host={$this->host};post={$this->port};dbname=" . $this->dbname, $this->user, $this->pass);

            return $this->connect;
        } catch(PDOException $err) {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato com o administrador " . EMAILADM);
        }
    }
}
