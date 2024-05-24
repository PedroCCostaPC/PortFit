<?php
namespace Sts\Controllers\Dashboard\Exercicios;

use CreateExercise;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 5) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Create/ExerciseCreate.php');


/**
 * Controller da página dashboard -> adicionar exercicio
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

        $Exercise = new \Sts\Models\Exercise\Read();

        // CATEGORIAS
        $category = $Exercise->allCategory();
        $this->data['categories'] = $category;



        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para criar modalidade
        if(isset($_POST['create-exercise'])) {
            $Create = new CreateExercise();
            // Retorna para pagina 'dashboard/exercicios/adicionar' caso form erro
            // Retorna para pagina 'dashboard/exercicios' caso form sucesso
            $return = $Create->newExercise();
            if($return) {
                return $this->data;
            }
        }

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;
        

        $loadView = new \Core\ConfigView("sts/views/dashboard/createExercise", $this->data);
        $loadView->loadView();
    }
}
