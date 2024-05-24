<?php

require_once(dirname(__FILE__, 3) . '/core/BlockFile.php'); 


// ---------------------------------------------------------------------------------------
// FUNCAO PARA FORMATAR REDES SOCIAIS PARA VIEW
function formatSocial($social, $dashboard) {
    $result['name'] = $social['name'];
    $result['icon'] = $social['icon'];
    $result['link'] = $social['link'];

    // Para enviar somente para o dashboard
    if($dashboard) {
        $result['id'] = $social['id'];
        $result['unit_id'] = $social['unit_id'];
    }

    return $result;
}