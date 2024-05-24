<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 

/**
 * Class DeleteTraining -> Responsável por deletar treinos
 */
class DeleteTraining {
    /**
     * $url -> variavel para link inicial do projeto
     *
     * @var string
     */
    private $url = URL;

    /**
     * Funcao para Deletar Treino
     */
    public function deleteTraining() {
        // Retornar error se não encrontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível excluir treino!';
            $_SESSION['msg-type'] = 'error';

            header("Location: #");
            return true;
        }

        $id = $_POST['id'];

        // Excluindo do DB
        $End = new \Sts\Models\Training\Delete;
        $End->deleteTraining($id);

        $_SESSION['msg'] = 'Exercício removido com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }

}