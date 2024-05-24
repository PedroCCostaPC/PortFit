<?php
namespace Sts\Controllers;
require_once(dirname(__FILE__, 4) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 3) . '/functions/UserFunctions.php');


/**
 * Controller da página Admin
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Admin {
    /**
     * @var string $url -> variavel para link inicial do projeto
     */
    private $url = URL;

    /**
    * @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     *Instanciar a classe responsável em carregar a View
     * @return void
     */

    public function index() {

        // CASO FUNCIONARIO ESTEJA LOGADO -> REDIRECIONA PARA DASHBOARD
        if(isset($_SESSION['employee'])) {
            header("Location: $this->url/dashboard");

        // CASO ALUNO ESTEJA LOGADO -> REDIRECIONA PARA AREA DO ALUNO
        } elseif(isset($_SESSION['student'])) {
            header("Location: $this->url/aluno");
        }


        
        $return = $this->confirmEmployee();
        if($return) {
            $this->data['return'];
        }

        $this->data['page-login'] = true;
        
        $loadView = new \Core\ConfigView("sts/views/public/admin", $this->data);
        $loadView->loadView();
    }


    // FUNCAO PARA VALIDAR FUNCIONARIO PARA LOGIN
    private function confirmEmployee() {
        if($_POST) {
            $email = $_POST['email'];
            $password = sha1($_POST['password']);
    
            $Employee = new \Sts\Models\Employee\Read();
            $employee = $Employee->employee($email, $password);

            // Caso usuario inalido 
            if(!$employee) {
                $_SESSION['return-email'] = $email;

                $_SESSION['msg'] = 'E-Mail ou Senha inválido!';
                $_SESSION['msg-type'] = 'error';
                header('Location: admin');

                return true;

            // Error caso usuario invalido
            } elseif(!$employee['situation']) {
                $_SESSION['return-email'] = $email;

                $_SESSION['msg'] = 'Usuário inativo!';
                $_SESSION['msg-type'] = 'error';
                header('Location: admin');

                return true;

            // Caso usuario valido
            } else {
                /**
                 * @function prepareSession -> prepara a sessao e cookie apos ser efetuado o login
                 * prepareSession recebe array com as informacoes do usuario e categoria do usuario
                 * categoria referese a se é funcionario ou aluno
                 * diretório da funcao -> app/functions/UserFunctions.php
                 */
                prepareSession($employee, 'employee');
                header('Location: dashboard');
                return false;
            }
        }
    }

}