<?php
require_once(dirname(__FILE__, 3) . '/core/BlockFile.php'); 


// ---------------------------------------------------------------------------------------
// FUNCAO PARA PREPARAR SESSAO APOS LOGIN
function prepareSession($user, $type) {
    $token = tokenGenerate();

    $_SESSION[$type]['id'] = $user['id'];
    $_SESSION[$type]['first_name'] = $user['firstName'];
    $_SESSION[$type]['last_name'] = $user['lastName'];
    $_SESSION[$type]["email"] = $user["email"];
    $_SESSION[$type]['photo'] = $user['photo'];
    
    // Caso seja funcionario
    if($type === 'employee') {
        $_SESSION[$type]["position_id"] = $user["position_id"];
        $_SESSION[$type]["position"] = $user["position"];

        // Enviando token para DB
        $Employee = new \Sts\Models\Employee\Update();
        $Employee->updateMyToken($_SESSION[$type]['id'], $token);

    // Caso seja aluno
    } elseif($type === 'student') {
        $_SESSION[$type]["position"] = 'Aluno';

        // Enviando token para DB
        $Student = new \Sts\Models\Student\Update();
        $Student->updateMyToken($_SESSION[$type]['id'], $token);
    }


    $exp = time() + 20 * 24 * 60 * 60;
    setcookie($type, $_SESSION[$type]['id'], $exp);
    setcookie('email', $_SESSION[$type]['email'], $exp);
    setcookie('token', $token, $exp);
}

// FUNCAO PARA GERAR TOKEN
function tokenGenerate() {
    $result = '';
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    $size = strlen($characters);

    for( $x = 0; $x < 20; $x++ ) {
        $result = $result . $characters[rand( 0, $size - 1 )];  
    }

    return $result;
}
