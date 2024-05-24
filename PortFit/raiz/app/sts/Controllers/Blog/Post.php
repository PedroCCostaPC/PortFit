<?php
namespace Sts\Controllers\Blog;

use CreateComment;


require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Create/CommentCreate.php');

/**
 * Controller da página Post do blog
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

class Post {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    /**
    * @var array|string|null $data Receb os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     *Instanciar a classe responsável em carregar a View
     * @return void
     */

    public function index() {
        // BLOG
        $Blog = new \Sts\Models\Blog\Read();

        // Retorna para pagina blog, caso nao exista $_GET['key'];
        if(!isset($_GET['key'])) {
            header("Location: $this->url/blog");
        }

        // Buscando Post
        $post = $Blog->blogIdActive($_GET['key']);

        // Retorna para pagina blog, caso nao encontre post;
        if(!$post) {
            header("Location: $this->url/blog");
        }

        // Formatando data de publicacao
        $published = explode('-', $post['published']);
        $year = $published[0];
        $month = $published[1];
        $day = $published[2];
        $post['published'] = "$day/$month/$year";


        // Buscando Comentarios do post
        $comments = $Blog->comments($post['id']);
        $countComent = count($comments);

        // Formatando data dos comentarios
        for($i = 0; $i < count($comments); $i++) {
            $date = explode('-', $comments[$i]['date']);
            $year = $date[0];
            $month = $date[1];
            $day = $date[2];
            $comments[$i]['date'] = "$day/$month/$year";
        }


        // Buscando categorias
        $categories = $Blog->allCategory();

        // Checando se categoria esta em uso
        for($i = 0; $i < count($categories); $i++) {
            $using = $Blog->usingCategory($categories[$i]['id']);
            if($using) {
                $categoryUsing[$i] = $categories[$i];
            }
        }
        $categories = [];
        $categories = $categoryUsing;

        // Buscando mais vistos
        $mostView = $Blog->blogMostView(7);


        // Acrescentando mais 1 view
        $views = $post['views'] + 1;
        $Update = new \Sts\Models\Blog\Update();
        $Update->updateViews($views, $post['id']);
                

        // Finalizando
        $this->data['post'] = $post;
        $this->data['categories'] = $categories;
        $this->data['most-views'] = $mostView;
        $this->data['count-comment'] = $countComent;
        $this->data['comments'] = $comments;



        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para criar modalidade
        if(isset($_POST['create-comment'])) {
            $Create = new CreateComment();
            // Retorna para pagina 'blog/post'
            $return = $Create->newComment($post['id']);
            if($return) {
                return $this->data;
            }
        }


        $loadView = new \Core\ConfigView("sts/views/public/post", $this->data);
        $loadView->loadView();
    }
}