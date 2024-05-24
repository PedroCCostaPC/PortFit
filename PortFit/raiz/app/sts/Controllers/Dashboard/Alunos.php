<?php
namespace Sts\Controllers\Dashboard;

use UpdateStudent;
use DeleteStudent;

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 4) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 4) . '/functions/Pagination.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Update/StudentUpdate.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Delete/StudentDelete.php');


/**
 * Controller da página dashboard -> alunos
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Alunos {
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

        // ALUNOS
        $Student = new \Sts\Models\Student\Read();


        // Caso Tenha resultado em busca
        if(isset($_GET['search'])) {
            $search = $_GET['search'];

            if(!$search) header("Location: $this->url/dashboard/alunos");

            // Buscando quantidade de alunos para definir quantidade de paginas
            $totalStudents = $Student->countSearch('%' . $search . '%');
            $totalStudents = $totalStudents[0];

            // Caso Procure por RG
            if($totalStudents === 0) {
                $totalStudents = $Student->countSearchRG('%' . $search . '%');
                $totalStudents = $totalStudents[0];
            }


            /**
             * @function pagination
             * Resposável por criar numero de paginacao das paginas
             * E enviar 'start' para incio de select no DB
             * Diretorio: app/functions/Pagination.php
             */
            // Montando paginacao
            $pagination = pagination($totalStudents, $amount, "$this->url/dashboard/alunos?search=$search");

            // Buscando no DB
            $start = $pagination['start'];
            $students = $Student->studentSearch($amount, $start, '%' . $search . '%');


            // Caso Procure por RG
            if(!$students) {
                $students = $Student->studentSearchRG($amount, $start, '%' . $search . '%');
            }


            $this->data['link'] = "$this->url/dashboard/alunos?search=$search";
            $this->data['count-search'] = $totalStudents;


        // Caso tenha algum filtro
        } elseif(isset($_GET['filter'])) {
            // Buscando quantidade de alunos para definir quantidade de paginas
            $filter = $_GET['filter'];

            if($filter === 'active') {
                $totalStudents = $Student->countSituation(true);
            } elseif($filter === 'inactive') {
                $totalStudents = $Student->countSituation(0);
            } else {
                $totalStudents = $Student->count();
            }

            $totalStudents = $totalStudents[0];

            $pagination = pagination($totalStudents, $amount, "$this->url/dashboard/alunos?filter=$filter");
            $start = $pagination['start'];

            $students = $this->filter($amount, $start, $filter);
            $this->data['link'] = "$this->url/dashboard/alunos?filter=$filter";

        } else {
            // Buscando quantidade de alunos para definir quantidade de paginas
            $totalStudents = $Student->count();
            $totalStudents = $totalStudents[0];

            $pagination = pagination($totalStudents, $amount, "$this->url/dashboard/alunos");
            $start = $pagination['start'];

            $students = $Student->allStudent($amount, $start);
            $this->data['link'] = "$this->url/dashboard/alunos";
        }

        // formatando situacao
        for($i = 0; $i < count($students); $i++) {
            $students[$i]['situation'] = $students[$i]['situation'] ? null : 'sketch';
        }

        // Finalizando
        $this->data['students'] = $students;
        $this->data['pagination'] = $pagination;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;


        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar situacao do aluno
        if(isset($_POST['situation-student'])) {
            $Update = new UpdateStudent();
            // Retorna para pagina '/dashboard/alunos'
            $return = $Update->updateSituation();
            if($return) {
                return $this->data;
            }
        }

        // Form para deletar aluno
        if(isset($_POST['delete-student'])) {
            $Delete = new DeleteStudent();
            // Retorna para pagina '/dashboard/alunos'
            $return = $Delete->deleteStudent();
            if($return) {
                return $this->data;
            }
        }
        

        $loadView = new \Core\ConfigView("sts/views/dashboard/students", $this->data);
        $loadView->loadView();
    }

    
    // FUNCAO PARA FILTRAR BUSCA
    private function filter($amount, $start, $filter) {
        $Result = new \Sts\Models\Student\Read();

        if($filter === 'A-Z') {
            $result = $Result->studentOrderName($amount, $start, 'ASC');

        } elseif($filter === 'Z-A') {
            $result = $Result->studentOrderName($amount, $start, 'DESC');

        } elseif($filter === 'active') {
            $result = $Result->studentSituation($amount, $start, true);

        } elseif($filter === 'inactive') {
            $result = $Result->studentSituation($amount, $start, 0);
        }

        return $result;
    }


}
