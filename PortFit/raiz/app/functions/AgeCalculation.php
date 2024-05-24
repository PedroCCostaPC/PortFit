<?php
require_once(dirname(__FILE__, 3) . '/core/BlockFile.php'); 

// ---------------------------------------------------------------------------------------
// FUNCAO PARA CALCULAR IDADE
function ageCalculation($birth, $date = null) {
    $birth = explode('-', $birth);

    $yearBirth = $birth[0];
    $monthBirth = $birth[1];
    $dayBirth = $birth[2];


    // Caso enviado uma data para calculo
    if($date) {
        $date = explode('-', $date);

        $yearCurrent = $date[0];
        $monthCurrent = $date[1];
        $dayCurrent = $date[2];

    // Caso nao enviado data, pega data atual
    } else {
        $yearCurrent = date('Y');
        $monthCurrent = date('m');
        $dayCurrent = date('d');
    }


    $result = $yearCurrent - $yearBirth;

    if($monthCurrent < $monthBirth) {
        $result -= 1;
    } elseif($monthCurrent === $monthBirth && $dayCurrent < $dayBirth) {
        $result -= 1;
    }


    return $result;
}
