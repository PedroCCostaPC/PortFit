<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 
require_once(dirname(__FILE__, 2) . '/ImageCreate.php'); 


/**
 * Class UpdateBlog -> Responsável por alterar Blog
 */
class UpdateBlog {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;


    /**
     * Funcao para alterar Blog
     */
    public function updateBlog($id, $banner) {
        $return = "$this->url/dashboard/blog/alterar?key=$id";

        $title = ucfirst($_POST['title']);
        $category = isset($_POST['category']) ? $_POST['category'] : null;
        $newCategory = ucwords($_POST['new-category']);
        $post = $_POST['post'];
        


        // Checando se campos obrigatorios foram preenchidos
        if(!$title || !$post) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $return");
            return true;
        }


        if(!$category && !$newCategory) {
            $_SESSION['msg'] = 'Selecione ou adicione uma categoria!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $return");
            return true;
        }

        // Criando imagem caso houver
        if($_FILES['blog']['name']) {
            $directory = 'assets/img/blog/';

            // Removendo banner antigo do diretorio
            unlink($directory . $banner);

            $NewImage = new ImageCreate();
            $banner = $NewImage->newImage($_FILES, $directory, 'blog');
    
            if(!$banner) {
                header("Location: $return");
                return true;
            }
        }

        // Criando nova categoria caso nao tenha sido selecionado uma
        if($newCategory) {
            // Checando se nome da categoria ja existe
            $CategoryRead = new \Sts\Models\Blog\Read();
            $catExists = $CategoryRead->categoryBlogName($newCategory);

            if($catExists) {
                $category = $catExists['id'];

            // Para nova categoria
            } else {
                $CategoryCreate = new \Sts\Models\Blog\Create();
                $CategoryCreate->createCategory($newCategory);

                // buscando id da nova categoria criada
                $category = $CategoryRead->lastCategory();
                $category = $category['id'];
            }
        }

        // Preparando array para enviar ao Model
        $result['title'] = $title;
        $result['banner'] = $banner;
        $result['category_id'] = $category;
        $result['post'] = $post;
        $result['id'] = $id;

        // Enviando ao Model
        $End = new \Sts\Models\Blog\Update();
        $End->updateBlog($result);

        $_SESSION['msg'] = 'Post alterado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $return");

        return true;
    }
    
    // -------------------- FUNCAO PARA ALTERAR SITUACAO DO BLOG --------------------
    public function updateSituation() {
        $id = $_POST['id'];

        // Buscando situacao do blog
        $Blog = new \Sts\Models\Blog\Read;
        $blog = $Blog->blogId($id);
        $situation = $blog['situation'];

        // Preparando array para enviar ao Model
        $result['id'] = $id;
        $result['situation'] = $situation ? false : true;
        
        // Definindo mensagem de retorno com base na situacao
        $title = $blog['title'];
        $msg = $situation ? "<b>$title</b> desativado com sucesso!" : "<b>$title</b> ativado com sucesso!";

        // Enviando ao Model
        $End = new \Sts\Models\Blog\Update();
        $End->updateSituation($result);

        $_SESSION['msg'] = $msg;
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }


    // -------------------- FUNCAO PARA ALTERAR CATEGORIA --------------------
    public function updateCategory() {
        $id = $_POST['id'];
        $name = $_POST['name'];

        if(!isset($id) || !$id) {
            $_SESSION['msg'] = 'Não foi possível alterar categoria!';
            $_SESSION['msg-type'] = 'error';
            header("Location: #");
            return true;
        }

        // Checando se $name foi preenchido
        if(!$name) {
            $_SESSION['msg'] = 'Digite o nome da categoria!';
            $_SESSION['msg-type'] = 'error';
            header("Location: #");
            return true;
        }


        // Preparando array para enviar ao Model
        $result['id'] = $id;
        $result['name'] = ucwords($name);

        // Enviando ao Model
        $End = new \Sts\Models\Blog\Update();
        $End->updateCategory($result);

        $_SESSION['msg'] = 'Categoria alterada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }
    
} 