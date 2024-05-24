<?php
require_once(dirname(__FILE__, 3) . '/core/BlockFile.php');

// ---------------------------------------------------------------------------------------
// CLASSE BLOQUEAR PAGINAS DO DASHBOARD CASO FUNCIONARIO NAO ESTEJA LOGADO
class CheckEmployee {   
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    function valid() {
        if(!isset($_SESSION['employee'])) {
            header("Location: $this->url/admin");
        }
    }
}

$CheckEmployee = new CheckEmployee();
$checkEmployee = $CheckEmployee->valid();