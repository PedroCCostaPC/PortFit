<?php
namespace Sts\Controllers\Dashboard;

use UpdateEmployee;

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Update/EmployeeUpdate.php');



/**
 * Controller da página dashboard -> alterar minha conta
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class MinhaConta {
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

        // Funcionario
        $employee = $Employee->employeeId($_SESSION['employee']['id']);

        $this->data = $employee;
        

        // Dividindo data de aniversario para formulario
        $this->data['day'] = substr($employee['birth'], -2, 2);
        $this->data['month'] = substr($employee['birth'], 5, 2);
        $this->data['year'] = substr($employee['birth'], 0, 4);

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar modalidade
        if(isset($_POST['update-account'])) {
            $Update = new UpdateEmployee();
            // Retorna para pagina 'dashboard/minhaConta'
            $return = $Update->updateMyAccount();
            if($return) {
                return $this->data;
            }
        }

        // Form para alterar senha
        if(isset($_POST['update-password'])) {
            $Update = new UpdateEmployee();
            // Retorna para pagina 'dashboard/minhaConta'
            $return = $Update->updateMyPassword();
            if($return) {
                return $this->data;
            }
        }
        

        $loadView = new \Core\ConfigView("sts/views/dashboard/myAccount", $this->data);
        $loadView->loadView();
    }
}
