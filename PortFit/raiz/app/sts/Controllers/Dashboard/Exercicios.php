<?php
namespace Sts\Controllers\Dashboard;

use DeleteExercise;
use UpdateExercise;

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 4) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 4) . '/functions/Pagination.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Update/ExerciseUpdate.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Delete/ExerciseDelete.php');


/**
 * Controller da página dashboard -> exercicios
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Exercicios {
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

        // EXERCICIOS
        $Exercise = new \Sts\Models\Exercise\Read();


        // Caso Tenha resultado em busca
        if(isset($_GET['search'])) {
            $search = $_GET['search'];

            if(!$search) header("Location: $this->url/dashboard/exercicios");
            
            // Buscando quantidade de exercicios para definir quantidade de paginas
            $totalExercise = $Exercise->countSearch('%' . $search . '%');
            $totalExercise = $totalExercise[0];

            /**
             * @function pagination
             * Resposável por criar numero de paginacao das paginas
             * E enviar 'start' para incio de select no DB
             * Diretorio: app/functions/Pagination.php
             */
            // Montando paginacao
            $pagination = pagination($totalExercise, $amount, "$this->url/dashboard/exercicios?search=$search");

            // Buscando no DB
            $start = $pagination['start'];
            $exercise = $Exercise->exerciseSearch($amount, $start, '%' . $search . '%');

            $this->data['link'] = "$this->url/dashboard/exercicios?search=$search";
            $this->data['count-search'] = $totalExercise;    
        
        // Caso tenha algum filtro
        } elseif(isset($_GET['filter'])) {
            // Buscando quantidade de exercicios para definir quantidade de paginas
            $filter = $_GET['filter'];


            if($filter === 'active') {
                $totalExercise = $Exercise->countSituation(true);
            } elseif($filter === 'inactive') {
                $totalExercise = $Exercise->countSituation(0);
            } else {
                $totalExercise = $Exercise->count();
            }
            
            $totalExercise = $totalExercise[0];


            $pagination = pagination($totalExercise, $amount, "$this->url/dashboard/exercicios?filter=$filter");
            $start = $pagination['start'];

            $exercise = $this->filter($amount, $start, $filter);
            $this->data['link'] = "$this->url/dashboard/exercicios?filter=$filter";

        } else {
            // Buscando quantidade de exercicios para definir quantidade de paginas
            $totalExercise = $Exercise->count();
            $totalExercise = $totalExercise[0];

            $pagination = pagination($totalExercise, $amount, "$this->url/dashboard/exercicios");
            $start = $pagination['start'];

            $exercise = $Exercise->allExercise($amount, $start);
            $this->data['link'] = "$this->url/dashboard/exercicios";
        }

        // Buscando categorias
        $categories = $Exercise->allCategory();

        // Checando se categoria esta em uso
        for($i = 0; $i < count($categories); $i++) {
            $using = $Exercise->usingCategory($categories[$i]['id']);
            $categories[$i]['using'] = isset($using['exCategory_id']) ? true : false;
        }

        // Colocando class para situation
        for($i = 0; $i < count($exercise); $i++) {
            $exercise[$i]['class-situation'] = $exercise[$i]['situation'] ? null : 'sketch';
        }



        // Finalizando
        $this->data['categories'] = $categories;
        $this->data['exercise'] = $exercise;
        $this->data['pagination'] = $pagination;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Alterando Situacao
        if(isset($_POST['situation-exercise'])) {
            $Update = new UpdateExercise();
            // Retorna para pagina '/dashboard/exercicios'
            $return = $Update->updateSituation();
            if($return) {
                return $this->data;
            }
        }

        // Excluindo Exercicio
        if(isset($_POST['delete-exercise'])) {
            $Delete = new DeleteExercise;
            $return = $Delete->deleteExercise();
            if($return) {
                return $this->data;
            }
        }

        
        // Alterando Categoria
        if(isset($_POST['update-category'])) {
            $Update = new UpdateExercise();
            // Retorna para pagina '/dashboard/exercicios'
            $return = $Update->updateCategory();
            if($return) {
                return $this->data;
            }
        }

        // Deletando Categoria
        if(isset($_POST['delete-category'])) {
            $Delete = new DeleteExercise();
            // Retorna para pagina '/dashboard/exercicios'
            $return = $Delete->deleteCategory();
            if($return) {
                return $this->data;
            }
        }



        $loadView = new \Core\ConfigView("sts/views/dashboard/exercises", $this->data);
        $loadView->loadView();
    }


    // FUNCAO PARA FILTRAR BUSCA
    private function filter($amount, $start, $filter) {
        $Result = new \Sts\Models\Exercise\Read();

        if($filter === 'A-Z') {
            $result = $Result->exerciseOrderName($amount, $start, 'ASC');

        } elseif($filter === 'Z-A') {
            $result = $Result->exerciseOrderName($amount, $start, 'DESC');

        } elseif($filter === 'active') {
            $result = $Result->exerciseSituation($amount, $start, true);

        } elseif($filter === 'inactive') {
            $result = $Result->exerciseSituation($amount, $start, 0);
        }

        return $result;
    }
}
