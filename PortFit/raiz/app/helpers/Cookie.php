<?php
require_once(dirname(__FILE__, 3) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 2) . '/functions/UserFunctions.php');

// ---------------------------------------------------------------------------------------
// CLASSE PARA CRIAR SESSAO CASO HAJA COOKIE
class Cookie {    
    function recoverUser() {
        // Caso seja funcionario
        if(isset($_COOKIE['employee']) && !isset($_SESSION['employee'])) {
            $id = $_COOKIE['employee'];
            $email = $_COOKIE['email'];
            $token = $_COOKIE['token'];

            $Employee = new \Sts\Models\Employee\Read();
            $employee = $Employee->employeeIdActive($id, $email, $token);

            if($employee && $employee['token']) {
                prepareSession($employee, 'employee');

            // Encerrar sessao caso Funcionario esteja com situacao inativo
            } else {
                // Limpando token no DB
                $Employee = new \Sts\Models\Employee\Update();
                $Employee->updateMyToken($_COOKIE['employee'], null);

                unset($_COOKIE['employee']);
                setcookie('employee', null);

                unset($_COOKIE['email']);
                setcookie('email', null);

                unset($_COOKIE['token']);
                setcookie('token', null);

                session_destroy();

                header('Location: admin');
                return;
            }

        // Caso seja aluno
        } elseif(isset($_COOKIE['student']) && !isset($_SESSION['student'])) {
            $id = $_COOKIE['student'];
            $email = $_COOKIE['email'];
            $token = $_COOKIE['token'];

            $Student = new \Sts\Models\Student\Read();
            $student = $Student->studentIdActive($id, $email, $token);

            if($student && $student['token']) {
                prepareSession($student, 'student');

            // Encerrar sessao caso Aluno esteja com situacao inativo
            } else {
                // Limpando token no DB
                $Student = new \Sts\Models\Student\Update();
                $Student->updateMyToken($_COOKIE['student'], null);

                unset($_COOKIE['student']);
                setcookie('student', null);

                unset($_COOKIE['email']);
                setcookie('email', null);

                unset($_COOKIE['token']);
                setcookie('token', null);

                session_destroy();

                header('Location: login');
                return;
            }
        }
    }
}

$Cookie = new Cookie();
$cookie = $Cookie->recoverUser();