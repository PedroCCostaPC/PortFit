<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 

/**
 * Class DeleteFood -> Responsável por deletar alimentacao
 */
class DeleteFood {
    /**
     * $url -> variavel para link inicial do projeto
     *
     * @var string
     */
    private $url = URL;

    /**
     * Funcao para Deletar alimentacao
     */
    public function deleteFood() {
        // Retornar error se não encrontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível excluir Refeição!';
            $_SESSION['msg-type'] = 'error';

            header("Location: #");
            return true;
        }

        $id = $_POST['id'];

        // Excluindo do DB
        $End = new \Sts\Models\Food\Delete;
        $End->deleteFood($id);

        $_SESSION['msg'] = 'Refeição removida com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }

}