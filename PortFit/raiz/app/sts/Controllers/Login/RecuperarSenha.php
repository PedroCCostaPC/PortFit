<?php
namespace Sts\Controllers\login;

use StudentRecoverEmail;

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');


/**
 * Controller da página Login - Recuperar senha
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class RecuperarSenha {
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


        // --------------- POST ---------------
        if($_POST) {
            require_once(dirname(__FILE__, 5) . '/core/ConfigEmail.php');
            require_once(dirname(__FILE__, 3) . '/Views/email/StudentRecoverEmail.php');

            $Read = new \Sts\Models\Student\Read();
            $email = $_POST['email'];

            // Buscando aluno
            $student = $Read->studentEmail($email);

            // Checando se aluno existe
            if(!$student) {
                $_SESSION['return-email'] = $email;

                $_SESSION['msg'] = 'E-Mail inválido!';
                $_SESSION['msg-type'] = 'error';
                header("Location: $this->url/login/recuperarsenha");

                return true;
            }

            // Checando se aluno esta ativo
            if(!$student['situation']) {
                $_SESSION['return-email'] = $email;

                $_SESSION['msg'] = 'Usuário inativo!';
                $_SESSION['msg-type'] = 'error';
                header("Location: $this->url/login/recuperarsenha");

                return true;
            }


            // Gerando Nova Senha
            $strings = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $password = substr(str_shuffle($strings), 0, 7);
            $cryptoPass = sha1($password);


            // Enviando ao Model
            $End = new \Sts\Models\Student\Update();
            $End->updateMyPassword($student['id'], $cryptoPass);


            // Enviando senha para email do aluno
            $title = 'Nova senha';

            /**
             * @var $Text -> Recebe a funcao create() da Classe StudentRecoverEmail()
             * Responsavel pelo conteudo do email
             * Diretorio da Classe: app/sts/Views/email/StudentRecoverEmail.php
             */
            $Text = new StudentRecoverEmail();
            $text = $Text->create($student['firstName'], $password);

            /**
             * @function sendEmail -> Responsavel pelo envio de email
             * Recebe 5 parametros
             * 1 - Email do destinatario ($email)
             * 2 - Nome do destinatario ($result['fullName'])
             * 3 - Titulo do email ($title)
             * 4 - e o conteudo ($text)
             * 5 - Boolean - true para o nome do usuario no email, false para nome da academia no email
             * 
             * Diretorio da funcao: core/ConfigEmail.php
             */
            sendEmail($email, $student['fullName'], $title, $text);


            // Finalizando
            $_SESSION['return-email'] = $email;
            $_SESSION['msg'] = 'Sua nova senha foi enviada para o seu E-Mail!';
            $_SESSION['msg-type'] = 'success';
            header("Location: $this->url/login");

            return true;
        }


        $this->data['page-login'] = true;
        
        
        $loadView = new \Core\ConfigView("sts/views/public/loginRecover", $this->data);
        $loadView->loadView();
    }
    
    
}