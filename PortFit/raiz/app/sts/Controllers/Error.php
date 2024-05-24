<?php
namespace Sts\Controllers;
require_once(dirname(__FILE__, 4) . '/core/BlockFile.php'); 

/**
 * Controller da página Error
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

class Error {
    /**
    * @var array|string|null $data Receb os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     *Instanciar a classe responsável em carregar a View
     * @return void
     */

    public function index() {
        $this->data = null;
        $loadView = new \Core\ConfigView("sts/views/public/error", $this->data);
        $loadView->loadView();
    }
}