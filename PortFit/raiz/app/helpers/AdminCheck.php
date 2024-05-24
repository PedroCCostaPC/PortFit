<?php
require_once(dirname(__FILE__, 3) . '/core/BlockFile.php');

// ---------------------------------------------------------------------------------------
// CLASSE BLOQUEAR PAGINAS DO DASHBOARD EXCLUSICAS DO ADMIN E BOSS
class CheckAdmin {   
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    function valid() {
        $position = $_SESSION['employee']['position_id'];


        if($position !== BOSS && $position !== ADMIN) {
            header("Location: $this->url/dashboard");
        }
    }
}

$CheckEmployee = new CheckAdmin();
$checkEmployee = $CheckEmployee->valid();