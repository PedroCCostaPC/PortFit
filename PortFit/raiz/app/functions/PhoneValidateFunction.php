<?php
require_once(dirname(__FILE__, 3) . '/core/BlockFile.php'); 


// ---------------------------------------------------------------------------------------
// FUNCOES PARA VALIDAR NUMEROS DE TELEFONE NOS FORMULARIOS

// Validando DDD
function checkPhone($ddd, $phone) {
    // Validando DDD
    if($ddd && strlen($ddd) !== 2) {
        $_SESSION['msg'] = 'DDD inválido!';
        $_SESSION['msg-type'] = 'error';

        return true;
    }

    // Validando telefone
    if($phone) {
        if(strlen($phone) < 8 || strlen($phone) > 9) {
            $_SESSION['msg'] = 'Telefone inválido!';
            $_SESSION['msg-type'] = 'error';
    
            return true;
        }
    }

    // Verificando se ddd e telefone foram preenchidos
    if($ddd && !$phone) {
        $_SESSION['msg'] = 'Informe o telefone!';
        $_SESSION['msg-type'] = 'error';

        return true;
    }
    if($phone && !$ddd) {
        $_SESSION['msg'] = 'Informe o DDD!';
        $_SESSION['msg-type'] = 'error';

        return true;
    }

}

