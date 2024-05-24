<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 

/**
 * Class DeleteSupplement -> Responsável por deletar suplementacao
 */
class DeleteSupplement {
    /**
     * $url -> variavel para link inicial do projeto
     *
     * @var string
     */
    private $url = URL;

    /**
     * Funcao para Deletar suplementacao
     */
    public function deleteSupplement() {
        // Retornar error se não encrontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível excluir suplementação!';
            $_SESSION['msg-type'] = 'error';

            header("Location: #");
            return true;
        }

        $id = $_POST['id'];

        // Excluindo do DB
        $End = new \Sts\Models\Supplement\Delete;
        $End->deleteSupplement($id);

        $_SESSION['msg'] = 'Suplementação removida com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }

}