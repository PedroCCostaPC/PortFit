<?php
namespace Sts\Controllers\Dashboard\Blog;

use DeleteComment;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Delete/BlogCommentDelete.php');


/**
 * Controller da página dashboard -> blog
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Comentarios {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    /**
    * @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     *Instanciar a classe responsável em carregar a View
     * @return void
     */

    public function index() {
        // Retornando a pagina de blog caso nao tenha $_GET['key']
        if(!isset($_GET['key'])) {
            header("Location: $this->url/dashboard/blog");
            return;
        }

        $Blog = new \Sts\Models\Blog\Read();

        // Blog
        $blog = $Blog->blogId($_GET['key']);

        // Retornando a pagina de blog caso nao ache blog
        if(!$blog) {
            header("Location: $this->url/dashboard/blog");
            return;
        }

        // Pegando comentarios
        $comments = $Blog->comments($blog['id']);

        // Formatando data do comentario
        for($i = 0; $i < count($comments); $i++) {
            $date = explode('-', $comments[$i]['date']);

            $day = $date[2];
            $month = $date[1];
            $year = $date[0];

            $comments[$i]['date'] = "$day/$month/$year";
        }

        // Checando cargo do usuario para definir css da pagina
        if($_SESSION['employee']['position_id'] === BOSS || $_SESSION['employee']['position_id'] === ADMIN) {
            $this->data['user-position'] = 5;
        } else {
            $this->data['user-position'] = 3;
        }        
        
        // FINALIZANDO
        $this->data['blog'] = $blog;
        $this->data['commentCount'] = count($comments);
        $this->data['comments'] = $comments;
        $this->data['blog'] = $blog;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Deletando Comentario
        if(isset($_POST['delete-comment'])) {
            $Delete = new DeleteComment();
            // Retorna para pagina '/dashboard/blog/comentarios'
            $return = $Delete->deleteComment($blog['id']);
            if($return) {
                return $this->data;
            }
        }


        $loadView = new \Core\ConfigView("sts/views/dashboard/blogComment", $this->data);
        $loadView->loadView();
    }

}
