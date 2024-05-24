<?php
require_once(dirname(__FILE__, 3) . '/core/BlockFile.php');

// ---------------------------------------------------------------------------------------
// CLASSE BLOQUEAR PAGINAS DO ALUNO CASO ALUNO NAO ESTEJA LOGADO
class CheckStudent {  
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    function valid() {
        if(!isset($_SESSION['student'])) {
            header("Location: $this->url/login");
        }
    }
}

$CheckStudent = new CheckStudent();
$checkStudent = $CheckStudent->valid();