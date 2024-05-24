<?php
namespace Sts\Controllers\Dashboard;

use DeleteBlog;
use UpdateBlog;
use CreateBlog;

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 4) . '/functions/Pagination.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Update/BlogUpdate.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Delete/BlogDelete.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Create/BlogCreate.php');

/**
 * Controller da página dashboard -> blog
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Blog {
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
        $amount = 15;

        // BLOG
        $Blog = new \Sts\Models\Blog\Read();


        // Caso Tenha resultado em busca
        if(isset($_GET['search'])) {
            $search = $_GET['search'];

            if(!$search) header("Location: $this->url/dashboard/blog");
            
            // Buscando quantidade de blog para definir quantidade de paginas
            $totalBlog = $Blog->countSearch('%' . $search . '%');
            $totalBlog = $totalBlog[0];

            /**
             * @function pagination
             * Resposável por criar numero de paginacao das paginas
             * E enviar 'start' para incio de select no DB
             * Diretorio: app/functions/Pagination.php
             */
            // Montando paginacao
            $pagination = pagination($totalBlog, $amount, "$this->url/dashboard/blog?search=$search");

            // Buscando no DB
            $start = $pagination['start'];
            $blog = $Blog->blogSearch($amount, $start, '%' . $search . '%');

            $this->data['link'] = "$this->url/dashboard/blog?search=$search";
            $this->data['count-search'] = $totalBlog;
        
        // Caso tenha algum filtro
        } elseif(isset($_GET['filter'])) {
            // Buscando quantidade de blog para definir quantidade de paginas
            $filter = $_GET['filter'];


            if($filter === 'active') {
                $totalBlog = $Blog->countSituation(true);
            } elseif($filter === 'inactive') {
                $totalBlog = $Blog->countSituation(0);
            } else {
                $totalBlog = $Blog->count();
            }
            
            $totalBlog = $totalBlog[0];


            $pagination = pagination($totalBlog, $amount, "$this->url/dashboard/blog?filter=$filter");
            $start = $pagination['start'];

            $blog = $this->filter($amount, $start, $filter);
            $this->data['link'] = "$this->url/dashboard/blog?filter=$filter";

        } else {
            // Buscando quantidade de blog para definir quantidade de paginas
            $totalBlog = $Blog->count();
            $totalBlog = $totalBlog[0];

            $pagination = pagination($totalBlog, $amount, "$this->url/dashboard/blog");
            $start = $pagination['start'];

            $blog = $Blog->allBlog($amount, $start);
            $this->data['link'] = "$this->url/dashboard/blog";
        }

        // Buscando categorias
        $categories = $Blog->allCategory();

        // Checando se categoria esta em uso
        for($i = 0; $i < count($categories); $i++) {
            $using = $Blog->usingCategory($categories[$i]['id']);
            $categories[$i]['using'] = isset($using['category_id']) ? true : false;
        }

        // Pegando quantidade de comentarios do post
        for($i = 0; $i < count($blog); $i++) {
            $commentCount[$i] = $Blog->commentCount($blog[$i]['id']);
            $blog[$i]['comment'] = $commentCount[$i][0];
        }

        // Checando cargo do usuario para definir css da pagina
        if($_SESSION['employee']['position_id'] === BOSS || $_SESSION['employee']['position_id'] === ADMIN) {
            $this->data['user-position'] = 5;
        } else {
            $this->data['user-position'] = 3;
        }

        // Formatando data
        for($i = 0; $i < count($blog); $i++) {
            $dateArray = explode('-', $blog[$i]['published']);
            $day = $dateArray[2];
            $month = $dateArray[1];
            $year = $dateArray[0];

            $blog[$i]['published'] = "$day/$month/$year";
        }

        // Colocando class css para publicado ou rascunho
        for($i = 0; $i < count($blog); $i++) {
            $blog[$i]['class-situation'] = $blog[$i]['situation'] ? null : 'inactive';
        }

        // Finalizando
        $this->data['categories'] = $categories;
        $this->data['blog'] = $blog;
        $this->data['pagination'] = $pagination;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Alterando Situacao
        if(isset($_POST['situation-blog'])) {
            $Update = new UpdateBlog();
            // Retorna para pagina '/dashboard/blog'
            $return = $Update->updateSituation();
            if($return) {
                return $this->data;
            }
        }

        // Excluindo Blog
        if(isset($_POST['delete-blog'])) {
            $Delete = new DeleteBlog;
            $return = $Delete->deleteBlog();
            if($return) {
                return $this->data;
            }
        }

        // Alterando Categoria
        if(isset($_POST['update-category'])) {
            $Update = new UpdateBlog();
            // Retorna para pagina '/dashboard/blog'
            $return = $Update->updateCategory();
            if($return) {
                return $this->data;
            }
        }

        // Deletando Categoria
        if(isset($_POST['delete-category'])) {
            $Delete = new DeleteBlog();
            // Retorna para pagina '/dashboard/blog'
            $return = $Delete->deleteCategory();
            if($return) {
                return $this->data;
            }
        }


        // Disparando e-mails
        if(isset($_POST['shoot-email'])) {
            require_once(dirname(__FILE__, 5) . '/core/ConfigEmail.php');
            require_once(dirname(__FILE__, 3) . '/Views/email/PostEmail.php');

            $Create = new CreateBlog();
            // Retorna para pagina '/dashboard/blog'
            $return = $Create->shootEmail($_POST['id']);
            if($return) {
                return $this->data;
            }
        }


        $loadView = new \Core\ConfigView("sts/views/dashboard/blog", $this->data);
        $loadView->loadView();
    }


    // FUNCAO PARA FILTRAR BUSCA
    private function filter($amount, $start, $filter) {
        $Result = new \Sts\Models\Blog\Read();

        if($filter === 'A-Z') {
            $result = $Result->blogOrderName($amount, $start, 'ASC');

        } elseif($filter === 'Z-A') {
            $result = $Result->blogOrderName($amount, $start, 'DESC');

        } elseif($filter === 'active') {
            $result = $Result->blogSituation($amount, $start, true);

        } elseif($filter === 'inactive') {
            $result = $Result->blogSituation($amount, $start, 0);
        }

        return $result;
    }
}
