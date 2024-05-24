<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 

/**
 * Class DeleteExercise -> Responsável por deletar exercicios
 */
class DeleteExercise {
    /**
     * $url -> variavel para link inicial do projeto
     *
     * @var string
     */
    private $url = URL;

    /**
     * Funcao para Deletar exercicios
     */
    public function deleteExercise() {
        // Retornar error se não encontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível deletar exercício!';
            $_SESSION['msg-type'] = 'error';

            header("Location: $this->url/dashboard/exercicios");
            return true;
        }

        $id = $_POST['id'];
        $directoryBanner = 'assets/img/exercises/';
        $directoryVideo = 'assets/video/exercises/';

        // Buscando exercicio no DB para pegar o nome do banner e video para remocao
        $Exercise = new \Sts\Models\Exercise\Read();
        $exercise = $Exercise->exerciseId($id);
        $banner = $exercise['banner'];
        $video = $exercise['video'];

        // Removendo banner e video do diretorio
        unlink($directoryBanner . $banner);
        unlink($directoryVideo . $video);

        // Excluindo treinos vinculados ao exercicio
        $Training = new \Sts\Models\Training\Delete();
        $Training->deleteAllTrainingExercise($id);

        // Excluindo do DB
        $Delete = new \Sts\Models\Exercise\Delete();
        $Delete->deleteExercise($id);

        $_SESSION['msg'] = 'Exercício deletado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }


    // -------------------- FUNCAO PARA DELETAR CATEGORIA --------------------
    public function deleteCategory() {
        $id = $_POST['id'];

        if(!isset($id) || !$id) {
            $_SESSION['msg'] = 'Não foi possível excluir categoria!';
            $_SESSION['msg-type'] = 'error';
            header("Location: #");
            return true;
        }
        
        // Checando se categoria esta em uso
        $Category = new \Sts\Models\Exercise\Read();
        $using = $Category->usingCategory($id);
        if($using) {
            $_SESSION['msg'] = 'Não foi possível excluir categoria!';
            $_SESSION['msg-type'] = 'error';
            header("Location: #");
            return true;
        }


        // Excluindo do DB
        $Delete = new \Sts\Models\Exercise\Delete();
        $Delete->deleteCategory($id);

        $_SESSION['msg'] = 'Categoria deletada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }

}