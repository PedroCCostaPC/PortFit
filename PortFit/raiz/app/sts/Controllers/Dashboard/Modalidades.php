<?php
namespace Sts\Controllers\Dashboard;

use DeleteModality;
use UpdateModality;

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 4) . '/functions/ModalitiesFunctions.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Update/ModalityUpdate.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Delete/ModalityDelete.php');



/**
 * Controller da página dashboard -> modalidades
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Modalidades {
    /**
    * @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     *Instanciar a classe responsável em carregar a View
     * @return void
     */

    public function index() {
        // MODALIDADES
        $Modality = new \Sts\Models\Modality\Read();
        $modalities = $Modality->allModality();

        if($modalities) {
            for($i = 0; $i < count($modalities); $i++) {
                $this->data['modality'][$i] = modalityFormat($modalities[$i], true);
                $this->data['modality'][$i]['situation'] = $modalities[$i]['situation'];
                $this->data['modality'][$i]['situation-class'] = $modalities[$i]['situation'] ? null : 'card-sketch';
            }
        } else {
            $this->data['modality'] = [];
        }

  
        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar situacao da modalidade
        if(isset($_POST['situation-modality'])) {
            $Update = new UpdateModality();
            // Retorna para pagina 'dashboardModalidades'
            $return = $Update->updateSituation();
            if($return) {
                return $this->data;
            }
        }

        // Form para excluir modalidades
        if(isset($_POST['delete-modality'])) {
            $Delete = new DeleteModality;
            $return = $Delete->DeleteModality();
            if($return) {
                return $this->data;
            }
        }

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        $loadView = new \Core\ConfigView("sts/views/dashboard/modalities", $this->data);
        $loadView->loadView();
    }
}
