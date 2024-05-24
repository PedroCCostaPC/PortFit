<?php
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

// CLASSE PARA PEGAR MODALIDADES ATIVAS PARA RODAPE
class ModalityFooter {
    function modalities() {
        $Modality = new \Sts\Models\Modality\Read();
        $result = $Modality->modalitiesFooter();

        return $result;
    }
}


$ModalityFooter = new ModalityFooter();
$modalitiesFooter = $ModalityFooter->modalities();