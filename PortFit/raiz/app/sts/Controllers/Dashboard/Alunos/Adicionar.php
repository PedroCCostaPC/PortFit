<?php
namespace Sts\Controllers\Dashboard\Alunos;

use CreateStudent;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 5) . '/helpers/AdminCheck.php');

/**
 * Controller da página dashboard -> adicionar aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Adicionar {
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
        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para criar aluno
        if(isset($_POST['create-student'])) {
            require_once(dirname(__FILE__, 3) . '/CRUD/Create/StudentCreate.php');
            
            $Create = new CreateStudent();
            // Retorna para pagina 'dashboard/alunos/adicionar' caso form erro
            // Retorna para pagina 'dashboard/alunos' caso form sucesso
            $return = $Create->newStudent();
            if($return) {
                return $this->data;
            }
        }
        

        $loadView = new \Core\ConfigView("sts/views/dashboard/createStudent", $this->data);
        $loadView->loadView();
    }
}
