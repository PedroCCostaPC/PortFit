<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 

/**
 * Class DeleteComment -> Responsável por deletar comentario do blog
 */
class DeleteComment {
    /**
     * $url -> variavel para link inicial do projeto
     *
     * @var string
     */
    private $url = URL;

    /**
     * Funcao para Deletar Comentario
     */
    public function deleteComment($post) {
        $return = "$this->url/dashboard/blog/comentarios?key=$post";


        // Retornar error se não encontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível deletar comentário!';
            $_SESSION['msg-type'] = 'error';

            header("Location: $return");
            return true;
        }

        $id = $_POST['id'];

        // Excluindo do DB
        $Delete = new \Sts\Models\Blog\Delete();
        $Delete->deleteComment($id);

        $_SESSION['msg'] = 'Comentário deletado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $return");

        return true;
    }



}