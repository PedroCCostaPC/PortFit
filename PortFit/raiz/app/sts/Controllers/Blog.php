<?php
namespace Sts\Controllers;
require_once(dirname(__FILE__, 4) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 3) . '/functions/Pagination.php');
require_once(dirname(__FILE__, 3) . '/functions/BlogFunctions.php');

/**
 * Controller da página Blog
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

class Blog {
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
        $amount = 10;

        // BLOG
        $Blog = new \Sts\Models\Blog\Read();

        // Caso Tenha resultado em busca
        if(isset($_GET['search'])) {
            $search = $_GET['search'];

            if(!$search) header("Location: $this->url/blog");
            
            // Buscando quantidade de blog para definir quantidade de paginas
            $totalBlog = $Blog->countSearchActive('%' . $search . '%');
            $totalBlog = $totalBlog[0];

            /**
             * @function pagination
             * Resposável por criar numero de paginacao das paginas
             * E enviar 'start' para incio de select no DB
             * Diretorio: app/functions/Pagination.php
             */
            // Montando paginacao
            $pagination = pagination($totalBlog, $amount, "$this->url/blog?search=$search");

            // Buscando no DB
            $start = $pagination['start'];
            $blog = $Blog->blogSearchActive($amount, $start, '%' . $search . '%');

            $this->data['link'] = "$this->url/blog?search=$search";
            $this->data['count-search'] = $totalBlog;
        
        // Caso tenha filtro de categoria
        } elseif(isset($_GET['category'])) {
            $filter = $_GET['category'];

            // Buscando quantidade de blog para definir quantidade de paginas
            $totalBlog = $Blog->countCategoryActive($filter);
            $totalBlog = $totalBlog[0];

            /**
             * @function pagination
             * Resposável por criar numero de paginacao das paginas
             * E enviar 'start' para incio de select no DB
             * Diretorio: app/functions/Pagination.php
             */
            // Montando paginacao
            $pagination = pagination($totalBlog, $amount, "$this->url/blog?category=$filter");

            // Buscando no DB
            $start = $pagination['start'];
            $blog = $Blog->blogCategoryActive($amount, $start, $filter);
            

            $this->data['link'] = "$this->url/blog?category=$filter";
            $this->data['count-search'] = $totalBlog;
            $this->data['filter'] = $blog[0]['category'];


        } else {
            // Buscando quantidade de blog para definir quantidade de paginas
            $totalBlog = $Blog->countActive();
            $totalBlog = $totalBlog[0];

            // Se tiver na primeira pagina, acrescenta mais 5 em amount para os slide
            // Slide só tem na primeira page
            if(!isset($_GET['page'])) {
                $amount = $amount + 5;
            }

            $pagination = pagination($totalBlog, $amount, "$this->url/blog");

            if(!isset($_GET['page'])) {
                $start = $pagination['start'];
            } else {
                $start = $pagination['start'] + 5;
            }

            $blog = $Blog->blog($amount, $start);
            $this->data['link'] = "$this->url/blog";

            // Gerando slide
            if(!isset($_GET['page']) && count($blog) > 7 && !isset($_GET['category'])) {
                for($i = 0; $i <= 4; $i++) {
                    $slide[$i] = $blog[$i];
                    unset($blog[$i]);
                }
                $blog = array_values($blog);
            }
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
        $categories = isset($categoryUsing) ? $categoryUsing : null;


        // Formatando blog
        for($i = 0; $i < count($blog); $i++) {
            $blog[$i] = formatBlog($blog[$i], true);
        }


        // Buscando mais vistos
        $mostView = $Blog->blogMostView(7);

        // Finalizando
        $this->data['categories'] = $categories;
        $this->data['slide'] = isset($slide) ? $slide : null;
        $this->data['blog'] = $blog;
        $this->data['pagination'] = $pagination;
        $this->data['most-views'] = $mostView;
        

        $loadView = new \Core\ConfigView("sts/views/public/blog", $this->data);
        $loadView->loadView();
    }
}