<?php
namespace Sts\Controllers;
require_once(dirname(__FILE__, 4) . '/core/BlockFile.php');

/**
 * Controller para fazer Logout
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Logout {
    public function index() {        
        // Caso seja funcionario
        if(isset($_SESSION['employee'])) {
            // Limpando token no DB
            $Employee = new \Sts\Models\Employee\Update();
            $Employee->updateMyToken($_SESSION['employee']['id'], null);

            session_destroy();
            unset($_COOKIE['employee']);
            setcookie('employee', null);

            unset($_COOKIE['email']);
            setcookie('email', null);

            unset($_COOKIE['token']);
            setcookie('token', null);

            header('Location: admin');
            return;

        // Caso seja aluno
        } elseif(isset($_SESSION['student'])) {
            // Limpando token no DB
            $Student = new \Sts\Models\Student\Update();
            $Student->updateMyToken($_SESSION['student']['id'], null);

            session_destroy();
            unset($_COOKIE['student']);
            setcookie('student', null);

            unset($_COOKIE['email']);
            setcookie('email', null);

            unset($_COOKIE['token']);
            setcookie('token', null);

            header('Location: login');
            return;
        }
    }
}
