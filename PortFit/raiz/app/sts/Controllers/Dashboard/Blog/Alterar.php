<?php
namespace Sts\Controllers\Dashboard\Blog;

use UpdateBlog;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Update/BlogUpdate.php');


/**
 * Controller da página dashboard -> alterar blog
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Alterar {
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

        // Checando cargo do usuario para definir css da pagina
        if($_SESSION['employee']['position_id'] === BOSS || $_SESSION['employee']['position_id'] === ADMIN) {
            $this->data['user-position'] = 5;
        } else {
            $this->data['user-position'] = 3;
        }

        $Blog = new \Sts\Models\Blog\Read();

        // CATEGORIAS
        $category = $Blog->allCategory();
        $this->data['category'] = $category;

        // Blog
        $blog = $Blog->blogId($_GET['key']);

        // Retornando a pagina de blog caso nao ache blog
        if(!$blog) {
            header("Location: $this->url/dashboard/blog");
            return;
        }

        $this->data['blog'] = $blog;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar blog
        if(isset($_POST['update-blog'])) {
            $Update = new UpdateBlog();
            // Retorna para pagina 'dashboard/blog/alterar' caso form
            $return = $Update->updateBlog($_GET['key'], $blog['banner']);
            if($return) {
                return $this->data;
            }
        }
        

        $loadView = new \Core\ConfigView("sts/views/dashboard/updateBlog", $this->data);
        $loadView->loadView();
    }
}
