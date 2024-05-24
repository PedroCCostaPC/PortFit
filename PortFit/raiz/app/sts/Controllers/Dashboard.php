<?php
namespace Sts\Controllers;
require_once(dirname(__FILE__, 4) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 3) . '/helpers/EmployeeCheck.php');



/**
 * Controller da página dashboard
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Dashboard {
    /**
    * @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     *Instanciar a classe responsável em carregar a View
     * @return void
     */

    public function index() {

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;
        
        $loadView = new \Core\ConfigView("sts/views/dashboard/start", $this->data);
        $loadView->loadView();
    }

}
