<?php
namespace Sts\Controllers;
require_once(dirname(__FILE__, 4) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 3) . '/functions/UserFunctions.php');


/**
 * Controller da página Login
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Login {
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

        // Retorna para pagina 'login' caso form invalido
        $return = $this->confirmStudent();
        if($return) {
            $this->data['return'];
        }

        $this->data['page-login'] = true;

        $loadView = new \Core\ConfigView("sts/views/public/login", $this->data);
        $loadView->loadView();
    }


    // FUNCAO PARA VALIDAR FUNCIONARIO PARA LOGIN
    private function confirmStudent() {
        if($_POST) {
            $email = $_POST['email'];
            $password = sha1($_POST['password']);
    
            $Student = new \Sts\Models\Student\Read();
            $student = $Student->student($email, $password);

            // Caso usuario invalido 
            if(!$student) {
                $_SESSION['return-email'] = $email;

                $_SESSION['msg'] = 'E-Mail ou Senha inválido!';
                $_SESSION['msg-type'] = 'error';
                header('Location: login');

                return true;

            // Error caso usuario invalido
            } elseif(!$student['situation']) {
                $_SESSION['return-email'] = $email;

                $_SESSION['msg'] = 'Usuário inativo!';
                $_SESSION['msg-type'] = 'error';
                header('Location: login');

                return true;

            // Caso usuario valido
            } else {
                /**
                 * @function prepareSession -> prepara a sessao e cookie apos ser efetuado o login
                 * prepareSession recebe array com as informacoes do usuario e categoria do usuario
                 * categoria referese a se é funcionario ou aluno
                 * diretório da funcao -> app/functions/UserFunciotns.php
                 */
                prepareSession($student, 'student');
                header('Location: aluno');
                return false;
            }
        }
    }

}