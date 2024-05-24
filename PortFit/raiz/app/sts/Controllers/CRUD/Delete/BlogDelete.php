<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 

/**
 * Class DeleteBlog -> Responsável por deletar blog
 */
class DeleteBlog {
    /**
     * $url -> variavel para link inicial do projeto
     *
     * @var string
     */
    private $url = URL;

    /**
     * Funcao para Deletar Blog
     */
    public function deleteBlog() {
        // Retornar error se não encontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível deletar post!';
            $_SESSION['msg-type'] = 'error';

            header("Location: $this->url/dashboard/blog");
            return true;
        }

        $id = $_POST['id'];
        $directory = 'assets/img/blog/';

        // Buscando post no DB para pegar o nome do banner
        $Blog = new \Sts\Models\Blog\Read();
        $blog = $Blog->blogId($id);
        $banner = $blog['banner'];

        // Removendo banner do diretorio
        unlink($directory . $banner);

        // Excluindo do DB
        $Delete = new \Sts\Models\Blog\Delete();
        $Delete->deleteAllCommentPost($id);
        $Delete->deleteBlog($id);

        $_SESSION['msg'] = 'Post deletado com sucesso!';
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
        $Category = new \Sts\Models\Blog\Read();
        $using = $Category->usingCategory($id);
        if($using) {
            $_SESSION['msg'] = 'Não foi possível excluir categoria!';
            $_SESSION['msg-type'] = 'error';
            header("Location: #");
            return true;
        }


        // Excluindo do DB
        $Delete = new \Sts\Models\Blog\Delete();
        $Delete->deleteCategory($id);

        $_SESSION['msg'] = 'Categoria deletada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }

}