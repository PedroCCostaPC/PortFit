<?php
require_once(dirname(__FILE__, 3) . '/core/BlockFile.php'); 


// ---------------------------------------------------------------------------------------
// FUNCAO PARA TRATAR MODALIDADES PARA VIEW
function modalityFormat($modalities, $boolean) {
    $result['id'] = $modalities['id'];
    $result['name'] = $modalities['name'];
    $result['phrase'] = $modalities['phrase'];
    $result['banner'] = $modalities['banner'];
    $result['summary'] = $modalities['summary'];

    if($boolean) {
        $result['about'] = $modalities['about'];
        $result['whyte'] = $modalities['whyte'];
        $result['image'] = $modalities['image'];
    }

    return $result;
}
