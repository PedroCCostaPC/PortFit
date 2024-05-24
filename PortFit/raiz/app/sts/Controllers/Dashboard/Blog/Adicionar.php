<?php
namespace Sts\Controllers\Dashboard\Blog;

use CreateBlog;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Create/BlogCreate.php');


/**
 * Controller da página dashboard -> adicionar exercicio
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Adicionar {
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

        $Blog = new \Sts\Models\Blog\Read();

        // Checando cargo do usuario para definir css da pagina
        if($_SESSION['employee']['position_id'] === BOSS || $_SESSION['employee']['position_id'] === ADMIN) {
            $this->data['user-position'] = 5;
        } else {
            $this->data['user-position'] = 3;
        }

        // CATEGORIAS
        $category = $Blog->allCategory();
        $this->data['category'] = $category;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para criar modalidade
        if(isset($_POST['create-blog'])) {
            $Create = new CreateBlog();
            // Retorna para pagina 'dashboard/blog/adicionar' caso form erro
            // Retorna para pagina 'dashboard/blog' caso form sucesso
            $return = $Create->newBlog();
            if($return) {
                return $this->data;
            }
        }

        

        $loadView = new \Core\ConfigView("sts/views/dashboard/createBlog", $this->data);
        $loadView->loadView();
    }
}
