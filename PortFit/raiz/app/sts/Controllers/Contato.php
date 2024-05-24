<?php
namespace Sts\Controllers;

use NewContact;


require_once(dirname(__FILE__, 4) . '/core/BlockFile.php');


/**
 * Controller da página Contato
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

class Contato {
    /**
    * @var array|string|null $data Receb os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     *Instanciar a classe responsável em carregar a View
     * @return void
     */

    public function index() {
        $Academy = new \Sts\Models\Academy\Read();
        
        // Buscando academia (Matriz)
        $academy = $Academy->academy();

        // Buscando fotos da academia
        if($academy) $photos = $Academy->selectPhotos($academy['id']);


        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para criar um contato
        if(isset($_POST['create-contact'])) {
            require_once(dirname(__FILE__) . '/CRUD/Create/EmailCreate.php');
            
            $Create = new NewContact();
            // Retorna para pagina '/Contato'
            $return = $Create->createEmail($academy['id']);
            if($return) {
                return $this->data;
            }
        }



        $this->data['photos'] = isset($photos) ? $photos : null;

        $loadView = new \Core\ConfigView("sts/views/public/contact", $this->data);
        $loadView->loadView();
    }
}