<?php
namespace Sts\Controllers\Dashboard\Funcionarios;

use UpdateEmployee;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 5) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Update/EmployeeUpdate.php');


/**
 * Controller da página dashboard -> alterar funcionario
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
        // Retornando a pagina de funcionarios caso nao tenha $_GET['employee']
        if(!isset($_GET['employee'])) {
            header("Location: $this->url/dashboard/funcionarios");
            return;
        }

        // Retornando a pagina de funcionarios caso $_GET['employee'] seja igual $_SESSION['employee']['id']
        if($_GET['employee'] == $_SESSION['employee']['id']) {
            header("Location: $this->url/dashboard/funcionarios");
            return;
        }


        $Employee = new \Sts\Models\Employee\Read();

        // Funcionario
        $employee = $Employee->employeeId($_GET['employee']);

        // Retornando a pagina de funcionarios caso nao ache funcionario
        if(!$employee) {
            header("Location: $this->url/dashboard/funcionarios");
            return;
        }

        // Buscando ID do cargo
        $positionId = $Employee->employeeId($_SESSION['employee']['id']);
        $positionId = $positionId['position_id'];

        // Buscando cargos (cargo boss só aparece para o boss)
        if($positionId === BOSS) {
            $positions = $Employee->allPositions();
        } else {
            $positions = $Employee->allPositionsNotBoss();
        }

        // Retornando a pagina de funcionarios caso funcionario nao boss tente alterar um boss
        if($positionId <> BOSS && $employee['position_id'] === BOSS) {
            header("Location: $this->url/dashboard/funcionarios");
            return;
        }


        $this->data['employee'] = $employee;
        $this->data['positions'] = $positions;

        // Dividindo data de aniversario para formulario
        $this->data['employee']['day'] = substr($employee['birth'], -2, 2);
        $this->data['employee']['month'] = substr($employee['birth'], 5, 2);
        $this->data['employee']['year'] = substr($employee['birth'], 0, 4);

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;



        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar modalidade
        if(isset($_POST['update-employee'])) {
            $Update = new UpdateEmployee();
            // Retorna para pagina 'dashboard/funcionarios/alterar'
            $return = $Update->updateEmployee($_GET['employee']);
            if($return) {
                return $this->data;
            }
        }
        

        $loadView = new \Core\ConfigView("sts/views/dashboard/updateEmployee", $this->data);
        $loadView->loadView();
    }
}
