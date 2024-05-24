<?php
namespace Sts\Controllers\Dashboard;

use UpdateEmployee;
use DeleteEmployee;

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 4) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 4) . '/functions/Pagination.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Update/EmployeeUpdate.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Delete/EmployeeDelete.php');


/**
 * Controller da página dashboard -> funcionarios
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Funcionarios {
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
        $myId = $_SESSION['employee']['id'];

        // FUNCIONARIOS
        $Employee = new \Sts\Models\Employee\Read();


        // Caso Tenha resultado em busca
        if(isset($_GET['search'])) {
            $search = $_GET['search'];

            if(!$search) header("Location: $this->url/dashboard/funcionarios");

            // Buscando quantidade de funcionarios para definir quantidade de paginas
            // Se cargo for 'Boss' busca todos funcionarios
            if($_SESSION['employee']['position'] === 'Boss') {
                $totalEmployee = $Employee->countSearch('%' . $search . '%', $myId);
                
            // Se nao for 'Boss' busca todos que nao seja 'Boss'
            } else {
                $totalEmployee = $Employee->countSearchNotBoss('%' . $search . '%', $myId);
            }
            $totalEmployee = $totalEmployee[0];

            // Caso Procure por RG
            if($totalEmployee === 0) {
                if($_SESSION['employee']['position'] === 'Boss') {
                    $totalEmployee = $Employee->countSearchRG('%' . $search . '%', $myId);
                    
                // Se nao for 'Boss' busca todos que nao seja 'Boss'
                } else {
                    $totalEmployee = $Employee->countSearchRgNotBoss('%' . $search . '%', $myId);
                }
                $totalEmployee = $totalEmployee[0];
            }


            /**
             * @function pagination
             * Resposável por criar numero de paginacao das paginas
             * E enviar 'start' para incio de select no DB
             * Diretorio: app/functions/Pagination.php
             */
            // Montando paginacao
            $pagination = pagination($totalEmployee, $amount, "$this->url/dashboard/funcionarios?search=$search");

            // Buscando no DB
            $start = $pagination['start'];

            // Se cargo for 'Boss' busca todos funcionarios
            if($_SESSION['employee']['position'] === 'Boss') {
                $employee = $Employee->employeeSearch($amount, $start, '%' . $search . '%', $myId);

            // Se nao for 'Boss' busca todos que nao seja 'Boss'
            } else {
                $employee = $Employee->employeeSearchNotBoss($amount, $start, '%' . $search . '%', $myId);
            }
            
            // Caso Procure por RG
            if(!$employee) {
                if($_SESSION['employee']['position'] === 'Boss') {
                    $employee = $Employee->employeeSearchRg($amount, $start, '%' . $search . '%', $myId);
    
                // Se nao for 'Boss' busca todos que nao seja 'Boss'
                } else {
                    $employee = $Employee->employeeSearchRgNotBoss($amount, $start, '%' . $search . '%', $myId);
                }
            }


            $this->data['link'] = "$this->url/dashboard/funcionarios?search=$search";
            $this->data['count-search'] = $totalEmployee;


        // Caso tenha algum filtro
        } elseif(isset($_GET['filter'])) {
            // Buscando quantidade de funcionarios para definir quantidade de paginas
            $filter = $_GET['filter'];

            if($filter === 'active') {
                // Se cargo for 'Boss' busca todos funcionarios
                if($_SESSION['employee']['position'] === 'Boss') {
                    $totalEmployee = $Employee->countSituation(true, $myId);

                // Se nao for 'Boss' busca todos que nao seja 'Boss'
                } else {
                    $totalEmployee = $Employee->countSituationNotBoss(true, $myId);
                }
                
            } elseif($filter === 'inactive') {
                if($_SESSION['employee']['position'] === 'Boss') {
                    $totalEmployee = $Employee->countSituation(0, $myId);

                // Se nao for 'Boss' busca todos que nao seja 'Boss'
                } else {
                    $totalEmployee = $Employee->countSituationNotBoss(0, $myId);
                }
                
            } else {
                // Se cargo for 'Boss' busca todos funcionarios
                if($_SESSION['employee']['position'] === 'Boss') {
                    $totalEmployee = $Employee->count($myId);

                // Se nao for 'Boss' busca todos que nao seja 'Boss'
                } else {
                    $totalEmployee = $Employee->countNotBoss($myId);
                }
            }

            $totalEmployee = $totalEmployee[0];

            $pagination = pagination($totalEmployee, $amount, "$this->url/dashboard/funcionarios?filter=$filter");
            $start = $pagination['start'];

            $employee = $this->filter($amount, $start, $filter, $myId);
            $this->data['link'] = "$this->url/dashboard/funcionarios?filter=$filter";

        } else {
            // Buscando quantidade de funcionarios para definir quantidade de paginas
            // Se cargo for 'Boss' busca todos funcionarios
            if($_SESSION['employee']['position'] === 'Boss') {
                $totalEmployee = $Employee->count($myId);

            // Se nao for 'Boss' busca todos que nao seja 'Boss'
            } else {
                $totalEmployee = $Employee->countNotBoss($myId);
            }
            $totalEmployee = $totalEmployee[0];
            

            $pagination = pagination($totalEmployee, $amount, "$this->url/dashboard/funcionarios");
            $start = $pagination['start'];

            // Se cargo for 'Boss' busca todos funcionarios
            if($_SESSION['employee']['position'] === 'Boss') {
                $employee = $Employee->allEmployee($amount, $start, $myId);

            // Se nao for 'Boss' busca todos que nao seja 'Boss'
            } else {
                $employee = $Employee->allEmployeeNotBoss($amount, $start, $myId);
            }

            $this->data['link'] = "$this->url/dashboard/funcionarios";
        }

        // formatando situacao
        for($i = 0; $i < count($employee); $i++) {
            $employee[$i]['situation'] = $employee[$i]['situation'] ? null : 'sketch';
        }
        
        // Finalizando
        $this->data['employees'] = $employee;
        $this->data['pagination'] = $pagination;
        
        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar situacao do funcionario
        if(isset($_POST['situation-employee'])) {
            $Update = new UpdateEmployee();
            // Retorna para pagina '/dashboard/funcionarios'
            $return = $Update->updateSituation();
            if($return) {
                return $this->data;
            }
        }

        // Form para deletar funcionario
        if(isset($_POST['delete-employee'])) {
            $Delete = new DeleteEmployee();
            // Retorna para pagina '/dashboard/funcionarios'
            $return = $Delete->deleteEmployee();
            if($return) {
                return $this->data;
            }
        }
        

        $loadView = new \Core\ConfigView("sts/views/dashboard/employees", $this->data);
        $loadView->loadView();
    }

    
    // FUNCAO PARA FILTRAR BUSCA
    private function filter($amount, $start, $filter, $myId) {
        $Result = new \Sts\Models\Employee\Read();

        if($filter === 'A-Z') {
            // Se cargo for 'Boss' busca todos funcionarios
            if($_SESSION['employee']['position'] === 'Boss') {
                $result = $Result->employeesOrderName($amount, $start, 'ASC', $myId);
            // Se nao for 'Boss' busca todos que nao seja 'Boss'
            } else {
                $result = $Result->employeesOrderNameNotBoss($amount, $start, 'ASC', $myId);
            }

        } elseif($filter === 'Z-A') {
            // Se cargo for 'Boss' busca todos funcionarios
            if($_SESSION['employee']['position'] === 'Boss') {
                $result = $Result->employeesOrderName($amount, $start, 'DESC', $myId);
            // Se nao for 'Boss' busca todos que nao seja 'Boss'
            } else {
                $result = $Result->employeesOrderNameNotBoss($amount, $start, 'DESC', $myId);
            }

        } elseif($filter === 'active') {
            // Se cargo for 'Boss' busca todos funcionarios
            if($_SESSION['employee']['position'] === 'Boss') {
                $result = $Result->employeeSituation($amount, $start, true, $myId);
            // Se nao for 'Boss' busca todos que nao seja 'Boss'
            } else {
                $result = $Result->employeeSituationNotBoss($amount, $start, true, $myId);
            }

        } elseif($filter === 'inactive') {
            // Se cargo for 'Boss' busca todos funcionarios
            if($_SESSION['employee']['position'] === 'Boss') {
                $result = $Result->employeeSituation($amount, $start, 0, $myId);
            // Se nao for 'Boss' busca todos que nao seja 'Boss'
            } else {
                $result = $Result->employeeSituationNotBoss($amount, $start, 0, $myId);
            }
            
        }

        return $result;
    }

}
