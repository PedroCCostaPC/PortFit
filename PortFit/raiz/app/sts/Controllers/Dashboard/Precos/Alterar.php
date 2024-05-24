<?php
namespace Sts\Controllers\Dashboard\Precos;

use UpdatePrice;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Update/PriceUpdate.php');



/**
 * Controller da página dashboard -> alterar preco
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
        // Retornando a pagina de precos caso nao tenha $_GET['key']
        if(!isset($_GET['key'])) {
            header("Location: $this->url/dashboard/precos");
            return;
        }

        // Buscando modalidade
        $Price = new \Sts\Models\Price\Read();
        $price = $Price->priceId($_GET['key']);

        // Retornando a pagina de precos caso nao ache preco
        if(!$price){
            header("Location: $this->url/dashboard/precos");
            return;
        }

        // Buscando Scheme do preco
        $scheme = $Price->schemePrice($_GET['key']);


        $this->data = $price;
        $this->data['scheme'] = $scheme;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        if(isset($_POST['update-price'])) {
            $Update = new UpdatePrice();
            // Retorna para pagina 'alterarPreco' caso form sucesso
            $return = $Update->updatePrice($price['id']);
            if($return) {
                return $this->data;
            }
        }


        $loadView = new \Core\ConfigView("sts/views/dashboard/updatePrice", $this->data);
        $loadView->loadView();
    }


    // --------------------FUNCOES PARA FORMATACOES DE VIEWS
}
