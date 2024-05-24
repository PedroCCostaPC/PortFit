<?php
namespace Sts\Controllers;
require_once(dirname(__FILE__, 4) . '/core/BlockFile.php');

/**
 * Controller da página Modalidades
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

class Modalidades {
    /**
    * @var array|string|null $data Receb os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     *Instanciar a classe responsável em carregar a View
     * @return void
     */

    public function index() {
        $Modalities = new \Sts\Models\Modality\Read();

        // Buscando Modalidades
        $modalites = $Modalities->active();


        $this->data = $modalites;

        $loadView = new \Core\ConfigView("sts/views/public/modalities", $this->data);
        $loadView->loadView();
    }
}