<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');


/**
 * Class UpdateEmail -> Responsável por alterar Email
 */
class UpdateEmail {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;


    /**
     * Funcao para alterar View
     */
    public function updateView() {
        $id = $_POST['id'];
        
        // Buscando view do email
        $Email = new \Sts\Models\Email\Read;
        $email = $Email->emailId($id);
        $view = $email['view'];

        // Preparando array para enviar ao Model
        $result['id'] = $id;
        $result['view'] = $view ? false : true;


        // Premarando mensagem de retorno
        if($view) {
            $msg = 'E-mail marcado como <b>Não lido</b>';
        } else {
            $msg = 'E-mail marcado como <b>Lido</b>';
        }

        // Enviando ao Model
        $End = new \Sts\Models\Email\Update();
        $End->updateView($result);

        $_SESSION['msg'] = $msg;
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }

} 