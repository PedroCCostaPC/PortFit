<?php
namespace Sts\Controllers\Dashboard\Modalidades;

use CreateModality;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Create/ModalityCreate.php');



/**
 * Controller da página dashboard -> nova modalidade
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
        // Form para criar modalidade
        if(isset($_POST['create-modality'])) {
            $Create = new CreateModality();
            // Retorna para pagina 'dashboard/modalidades/adicionar' caso form erro
            // Retorna para pagina 'dashboard/modalidades' caso form sucesso
            $return = $Create->newModality();
            if($return) {
                return $this->data;
            }
        }

        $loadView = new \Core\ConfigView("sts/views/dashboard/createModality", $this->data);
        $loadView->loadView();
    }
}
