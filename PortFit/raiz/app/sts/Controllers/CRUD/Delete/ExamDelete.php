<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 

/**
 * Class DeleteExam -> Responsável por deletar exames
 */
class DeleteExam {
    /**
     * $url -> variavel para link inicial do projeto
     *
     * @var string
     */
    private $url = URL;

    /**
     * Funcao para Deletar exame
     */
    public function deleteExam($student) {
        $return = "$this->url/dashboard/alunos/avaliacoes?student=$student";

        // Retornar error se não encrontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível deletar exame!';
            $_SESSION['msg-type'] = 'error';

            header("Location: $return");
            return true;
        }

        $id = $_POST['id'];

        // Excluindo do DB
        $Delete = new \Sts\Models\Exam\Delete();
        $Delete->deleteExam($id);


        $_SESSION['msg'] = 'Exame deletado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $return");

        return true;
    }

}