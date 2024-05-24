<?php
namespace Sts\Controllers\Dashboard\Funcionarios;

use CreateEmployee;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 5) . '/helpers/AdminCheck.php');


/**
 * Controller da página dashboard -> adicionar funcionario
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
        $Employee = new \Sts\Models\Employee\Read();

        // Buscando ID do cargo
        $positionId = $Employee->employeeId($_SESSION['employee']['id']);
        $positionId = $positionId['position_id'];

        // Buscando cargos (cargo boss só aparece para o boss)
        if($positionId === BOSS) {
            $positions = $Employee->allPositions();
        } else {
            $positions = $Employee->allPositionsNotBoss();
        }


        $this->data['positions'] = $positions;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para criar aluno
        if(isset($_POST['create-employee'])) {
            require_once(dirname(__FILE__, 3) . '/CRUD/Create/EmployeeCreate.php');
            
            $Create = new CreateEmployee();
            // Retorna para pagina 'dashboard/funcionarios/adicionar' caso form erro
            // Retorna para pagina 'dashboard/funcionarios' caso form sucesso
            $return = $Create->newEmployee();
            if($return) {
                return $this->data;
            }
        }
        

        $loadView = new \Core\ConfigView("sts/views/dashboard/createEmployee", $this->data);
        $loadView->loadView();
    }
}
