<?php
namespace Sts\Controllers\Dashboard\Precos;

use CreatePrice;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Create/PriceCreate.php');



/**
 * Controller da página dashboard -> novo preco
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Adicionar {
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
        
        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        if(isset($_POST['create-price'])) {
            $Create = new CreatePrice();
            // Retorna para pagina 'dashboard/precos/adicionar' caso form erro
            // Retorna para pagina 'dashboard/precos' caso form sucesso
            $return = $Create->newPrice();
            if($return) {
                return $this->data;
            }
        }
        

        $loadView = new \Core\ConfigView("sts/views/dashboard/createPrice", $this->data);
        $loadView->loadView();
    }
}
