<?php
require_once(dirname(__FILE__, 3) . '/core/BlockFile.php'); 

const WEIGHT_SUCCESS = 2;
const WEIGHT_LIGHT = 5;
const WEIGHT_WARM = 20;
const WEIGHT_DANGER = 55;

const LEAN_MASS_SUCCESS = 2;
const LEAN_MASS_LIGHT = 5;
const LEAN_MASS_WARM = 15;
const LEAN_MASS_DANGER = 35;

const FAT_MASS_SUCCESS = 2;
const FAT_MASS_LIGHT = 5;
const FAT_MASS_WARM = 15;
const FAT_MASS_DANGER = 35;

const TBW_SUCCESS = 1;
const TBW_LIGHT = 5;
const TBW_WARM = 10;
const TBW_DANGER = 15;

const ECW_SUCCESS = 1;
const ECW_LIGHT = 5;
const ECW_WARM = 10;
const ECW_DANGER = 15;

const ICW_SUCCESS = 1;
const ICW_LIGHT = 5;
const ICW_WARM = 10;
const ICW_DANGER = 15;

const SYSTOLIC_SUCCESS = 120;
const SYSTOLIC_LIGHT = 139;
const SYSTOLIC_WARM = 159;
const SYSTOLIC_DANGER = 179;

const DIASTOLIC_SUCCESS = 80;
const DIASTOLIC_LIGHT = 89;
const DIASTOLIC_WARM = 99;
const DIASTOLIC_DANGER = 109;


// ---------------------------------------------------------------------------------------
// FUNCAO PARA EVOLUCAO DO ALUNO
function evolution($exam) {
    $countExam = count($exam);

    // CASO NAO POSSUA AVALIACOES
    if($countExam === 0) $result = null;

    // CASO POSSUA AO MENOS 1 AVALIACAO
    if($countExam >= 1) {
        $lastExam = $exam[0];

        // Altura
        $result['height']['last'] = substr_replace($lastExam['height'], ',', 1, 0);

        // Peso
        $result['weight']['last'] = $lastExam['weight'];
        $result['weight']['ideal-min'] = $lastExam['idealWeight'] - WEIGHT_SUCCESS;
        $result['weight']['ideal-max'] = $lastExam['idealWeight'] + WEIGHT_SUCCESS;
        $result['weight']['class'] = ideal($lastExam['idealWeight'], $lastExam['weight'], WEIGHT_SUCCESS, WEIGHT_LIGHT, WEIGHT_WARM, WEIGHT_DANGER);

        // Massa Magra
        $result['leanMass']['last'] = $lastExam['leanMass'];
        $result['leanMass']['ideal-min'] = $lastExam['leanMass'] - LEAN_MASS_SUCCESS;
        $result['leanMass']['ideal-max'] = $lastExam['leanMass'] + LEAN_MASS_SUCCESS;
        $result['leanMass']['class'] = ideal($lastExam['leanMass'], $lastExam['leanMass'], LEAN_MASS_SUCCESS, LEAN_MASS_LIGHT, LEAN_MASS_WARM, LEAN_MASS_DANGER);

        // Massa Gorda
        $result['fatMass']['last'] = $lastExam['fatMass'];
        $result['fatMass']['ideal-min'] = $lastExam['idealFatMass'] - FAT_MASS_SUCCESS;
        $result['fatMass']['ideal-max'] = $lastExam['idealFatMass'] + FAT_MASS_SUCCESS;
        $result['fatMass']['class'] = ideal($lastExam['idealFatMass'], $lastExam['fatMass'], FAT_MASS_SUCCESS, FAT_MASS_LIGHT, FAT_MASS_WARM, FAT_MASS_DANGER);

        // TBW
        $result['tbw']['last'] = $lastExam['tbw'];
        $result['tbw']['ideal-min'] = $lastExam['idealTbw'] - TBW_SUCCESS;
        $result['tbw']['ideal-max'] = $lastExam['idealTbw'] + TBW_SUCCESS;
        $result['tbw']['class'] = ideal($lastExam['idealTbw'], $lastExam['tbw'], TBW_SUCCESS, TBW_LIGHT, TBW_WARM, TBW_DANGER);

        // ECW
        $result['ecw']['last'] = $lastExam['ecw'];
        $result['ecw']['ideal-min'] = $lastExam['idealEcw'] - ECW_SUCCESS;
        $result['ecw']['ideal-max'] = $lastExam['idealEcw'] + ECW_SUCCESS;
        $result['ecw']['class'] = ideal($lastExam['idealEcw'], $lastExam['ecw'], ECW_SUCCESS, ECW_LIGHT, ECW_WARM, ECW_DANGER);

        // ICW
        $result['icw']['last'] = $lastExam['icw'];
        $result['icw']['ideal-min'] = $lastExam['idealIcw'] - ICW_SUCCESS;
        $result['icw']['ideal-max'] = $lastExam['idealIcw'] + ICW_SUCCESS;
        $result['icw']['class'] = ideal($lastExam['idealIcw'], $lastExam['icw'], ICW_SUCCESS, ICW_LIGHT, ICW_WARM, ICW_DANGER);

        // PRESSAO ARTERIAL
        $result['systolic']['last'] = $lastExam['systolic'];
        $result['diastolic']['last'] = $lastExam['diastolic'];
        $result['idealPressure'] = idealPressure(
            $lastExam['systolic'],
            SYSTOLIC_SUCCESS, 
            SYSTOLIC_LIGHT, 
            SYSTOLIC_WARM, 
            SYSTOLIC_DANGER,
            $lastExam['diastolic'], 
            DIASTOLIC_SUCCESS, 
            DIASTOLIC_LIGHT, 
            DIASTOLIC_WARM, 
            DIASTOLIC_DANGER
        );
    }


    // CASO POSSUA AO MENOS 2 AVALIACOES
    if($countExam >= 2) {
        $firstExam = $exam[$countExam - 1];

        // Altura
        $result['height']['first'] = substr_replace($firstExam['height'], ',', 1, 0);

        // Peso
        $result['weight']['first'] = $firstExam['weight'];
        $result['weight']['result-first-title'] = differenceTitle($firstExam['weight'], $lastExam['weight']);
        $result['weight']['result-first'] = difference($firstExam['weight'], $lastExam['weight']);

        // Massa Magra
        $result['leanMass']['first'] = $firstExam['leanMass'];
        $result['leanMass']['result-first-title'] = differenceTitle($firstExam['leanMass'], $lastExam['leanMass']);
        $result['leanMass']['result-first'] = difference($firstExam['leanMass'], $lastExam['leanMass']);

        // Massa Gorda
        $result['fatMass']['first'] = $firstExam['fatMass'];
        $result['fatMass']['result-first-title'] = differenceTitle($firstExam['fatMass'], $lastExam['fatMass']);
        $result['fatMass']['result-first'] = difference($firstExam['fatMass'], $lastExam['fatMass']);

        // TBW
        $result['tbw']['first'] = $firstExam['tbw'];
        $result['tbw']['result-first-title'] = differenceTitle($firstExam['tbw'], $lastExam['tbw']);
        $result['tbw']['result-first'] = difference($firstExam['tbw'], $lastExam['tbw']);

         // ECW
         $result['ecw']['first'] = $firstExam['ecw'];
         $result['ecw']['result-first-title'] = differenceTitle($firstExam['ecw'], $lastExam['ecw']);
         $result['ecw']['result-first'] = difference($firstExam['ecw'], $lastExam['ecw']);

         // ICW
         $result['icw']['first'] = $firstExam['icw'];
         $result['icw']['result-first-title'] = differenceTitle($firstExam['icw'], $lastExam['icw']);
         $result['icw']['result-first'] = difference($firstExam['icw'], $lastExam['icw']);


        // PRESSAO ARTERIAL
        //  SISTOLICA
        $result['systolic']['first'] = $firstExam['systolic'];
        $result['systolic']['result-first-title'] = differenceTitle($firstExam['systolic'], $lastExam['systolic']);
         $result['systolic']['result-first'] = difference($firstExam['systolic'], $lastExam['systolic']);

        // DIASTOLICA
        $result['diastolic']['first'] = $firstExam['diastolic'];
        $result['diastolic']['result-first-title'] = differenceTitle($firstExam['diastolic'], $lastExam['diastolic']);
         $result['diastolic']['result-first'] = difference($firstExam['diastolic'], $lastExam['diastolic']);
    }


    // CASO POSSUA AO MENOS 3 AVALIACOES
    if($countExam >= 3) {
        $penultimateExam = $exam[1];

        // Altura
        $result['height']['penultimate'] = substr_replace($penultimateExam['height'], ',', 1, 0);

        // Peso
        $result['weight']['penultimate'] = $penultimateExam['weight'];
        $result['weight']['result-last-title'] = differenceTitle($penultimateExam['weight'], $lastExam['weight']);
        $result['weight']['result-last'] = difference($penultimateExam['weight'], $lastExam['weight']);

        // Massa Magra
        $result['leanMass']['penultimate'] = $penultimateExam['leanMass'];
        $result['leanMass']['result-last-title'] = differenceTitle($penultimateExam['leanMass'], $lastExam['leanMass']);
        $result['leanMass']['result-last'] = difference($penultimateExam['leanMass'], $lastExam['leanMass']);

        // Massa Gorda
        $result['fatMass']['penultimate'] = $penultimateExam['fatMass'];
        $result['fatMass']['result-last-title'] = differenceTitle($penultimateExam['fatMass'], $lastExam['fatMass']);
        $result['fatMass']['result-last'] = difference($penultimateExam['fatMass'], $lastExam['fatMass']);

        // TBW
        $result['tbw']['penultimate'] = $penultimateExam['tbw'];
        $result['tbw']['result-last-title'] = differenceTitle($penultimateExam['tbw'], $lastExam['tbw']);
        $result['tbw']['result-last'] = difference($penultimateExam['tbw'], $lastExam['tbw']);

        // ECW
        $result['ecw']['penultimate'] = $penultimateExam['ecw'];
        $result['ecw']['result-last-title'] = differenceTitle($penultimateExam['ecw'], $lastExam['ecw']);
        $result['ecw']['result-last'] = difference($penultimateExam['ecw'], $lastExam['ecw']);

        // ICW
        $result['icw']['penultimate'] = $penultimateExam['icw'];
        $result['icw']['result-last-title'] = differenceTitle($penultimateExam['icw'], $lastExam['icw']);
        $result['icw']['result-last'] = difference($penultimateExam['icw'], $lastExam['icw']);

        // PRESSAO ARTERIAL
        //  SISTOLICA
        $result['systolic']['penultimate'] = $penultimateExam['systolic'];
        $result['systolic']['result-last-title'] = differenceTitle($penultimateExam['systolic'], $lastExam['systolic']);
        $result['systolic']['result-last'] = difference($penultimateExam['systolic'], $lastExam['systolic']);

        // DIASTOLICA
        $result['diastolic']['penultimate'] = $penultimateExam['diastolic'];
        $result['diastolic']['result-last-title'] = differenceTitle($penultimateExam['diastolic'], $lastExam['diastolic']);
        $result['diastolic']['result-last'] = difference($penultimateExam['diastolic'], $lastExam['diastolic']);

    }

    return $result;   
    
}


// Funcao para titulo de "checar se ganhou, manteve ou perdeu"
function differenceTitle($first, $last) {
    if($first > $last) {
        $title = "Perdi";
    } elseif($first < $last) {
        $title = "Ganhei";
    } else {
        $title = "Mantive";
    }
        return $title;
}

// Funcao para checar se ganhou, manteve ou perdeu
function difference($first, $last) {
    if($first > $last) {
        $gainLoss = $first - $last;
    } elseif($first < $last) {
        $gainLoss = $last - $first;
    } else {
        $gainLoss = 0;
    }

    return $gainLoss;
}



// Funcao para calculo de situacao com base no valor ideal e o atual
function ideal($ideal, $current, $successVal, $lightVal, $warmVal, $dangerVal) {
    $calculation = $ideal - $current;

    if($calculation <= $successVal && $calculation >= -$successVal) {
        $result = "success";
    } elseif($calculation <= $lightVal && $calculation >= -$lightVal) {
        $result = "light";
    } elseif($calculation <= $warmVal && $calculation >= -$warmVal) {
        $result = "warm";
    } elseif($calculation <= $dangerVal && $calculation >= -$dangerVal) {
        $result = "danger";
    } else {
        $result = "critical";
    }

    return $result;
}


// Funcao para pressao arterial
function idealPressure($systolic, $systolicSuccess, $systolicLight, $systolicWarm, $systolicDanger, $diastolic, $diastolicSuccess, $diastolicLight, $diastolicWarm, $diastolicDanger) {

    if($systolic < $systolicSuccess && $diastolic < $diastolicSuccess) {
        $ideal = "success";
        $message = "Normal";
    } elseif($systolic <= $systolicLight && $diastolic <= $diastolicLight) {
        $ideal = "light";
        $message = "Pré-Hipertensão";
    } elseif($systolic <= $systolicWarm && $diastolic <= $diastolicWarm) {
        $ideal = "warm";
        $message = "Pressão arterial elevada - Hipertensão estágio 1";
    } elseif($systolic <= $systolicDanger && $diastolic <= $diastolicDanger) {
        $ideal = "danger";
        $message = "Pressão arterial elevada - Hipertensão estágio 2";
    } else {
        $ideal = "critical";
        $message = "Crise hipertensiva (Emergência médica)";
    }

    $result["class"] = $ideal;
    $result["message"] = $message;

    return $result;
}