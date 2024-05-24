<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 

/**
 * Class DeleteEmail -> Responsável por deletar email
 */
class DeleteEmail {
    /**
     * $url -> variavel para link inicial do projeto
     *
     * @var string
     */
    private $url = URL;

    /**
     * Funcao para Deletar Email
     */
    public function deleteEmail() {
        // Retornar error se não encontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível deletar email!';
            $_SESSION['msg-type'] = 'error';

            header("Location: $this->url/dashboard/email");
            return true;
        }

        $id = $_POST['id'];

        // Excluindo do DB
        $Delete = new \Sts\Models\Email\Delete();
        $Delete->deleteEmail($id);

        $_SESSION['msg'] = 'Email deletado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }

}