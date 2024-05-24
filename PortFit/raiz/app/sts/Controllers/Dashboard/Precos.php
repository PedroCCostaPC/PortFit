<?php
namespace Sts\Controllers\Dashboard;

use DeletePrice;
use UpdatePrice;

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 4) . '/functions/PricesFunctions.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Update/PriceUpdate.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Delete/PriceDelete.php');


/**
 * Controller da página dashboard -> precos
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Precos {
    /**
    * @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     *Instanciar a classe responsável em carregar a View
     * @return void
     */

    public function index() {
        // PRECOS
        $Price = new \Sts\Models\Price\Read();
        $prices = $Price->allPrice();
        for($i = 0; $i < count($prices); $i++) {
            /**
             * @function priceFormat -> Formata os precos da academia para VIEW
             * priceFormat recebe a class do Price e array com os dados do preco
             * diretório da funcao -> app/functions/PricesFunciotns.php
             */
            $this->data['prices'][$i] = priceFormat($Price, $prices[$i]);
            $this->data['prices'][$i]['situation'] = $prices[$i]['situation'];
            $this->data['prices'][$i]['situation-class'] = $prices[$i]['situation'] ? null : 'inactive';
        }
    
        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para destacar preco
        if(isset($_POST['emphasis-price'])) {
            $Update = new UpdatePrice();
            // Retorna para pagina 'dashboard/precos'
            $return = $Update->updateEmphasis();
            if($return) {
                return $this->data;
            }
        }

        // Form para alterar situacao da preco
        if(isset($_POST['situation-price'])) {
            $Update = new UpdatePrice();
            // Retorna para pagina 'dashboard/precos'
            $return = $Update->updateSituation();
            if($return) {
                return $this->data;
            }
        }

        // Form para deletar preco
        if(isset($_POST['delete-price'])) {
            $Delete = new DeletePrice();
            // Retorna para pagina 'dashboard/precos'
            $return = $Delete->deletePrice();
            if($return) {
                return $this->data;
            }
        }


        // Caso nao tenha preco cadastrado
        if(!$prices) $this->data['prices'] = [];


        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // $this->data = null;
        $loadView = new \Core\ConfigView("sts/views/dashboard/prices", $this->data);
        $loadView->loadView();
    }
}
