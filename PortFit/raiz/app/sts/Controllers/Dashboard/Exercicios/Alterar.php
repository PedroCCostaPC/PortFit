<?php
namespace Sts\Controllers\Dashboard\Exercicios;

use UpdateExercise;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 5) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Update/ExerciseUpdate.php');


/**
 * Controller da página dashboard -> alterar exercicio
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
        // Retornando a pagina de exercicios caso nao tenha $_GET['key']
        if(!isset($_GET['key'])) {
            header("Location: $this->url/dashboard/exercicios");
            return;
        }


        $Exercise = new \Sts\Models\Exercise\Read();

        // CATEGORIAS
        $category = $Exercise->allCategory();
        $this->data['category'] = $category;

        // Exercicio
        $exercise = $Exercise->exerciseId($_GET['key']);

        // Retornando a pagina de exercicios caso nao ache exercicio
        if(!$exercise) {
            header("Location: $this->url/dashboard/exercicios");
            return;
        }

        $this->data['exercise'] = $exercise;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;



        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar exercicio
        if(isset($_POST['update-exercise'])) {
            $Update = new UpdateExercise();
            // Retorna para pagina 'dashboard/exercicios/alterar' caso form erro
            // Retorna para pagina 'dashboard/exercicios/alterar' caso form sucesso
            $return = $Update->updateExercise($_GET['key'], $exercise['banner'], $exercise['video'], $exercise['external']);
            if($return) {
                return $this->data;
            }
        }
        

        $loadView = new \Core\ConfigView("sts/views/dashboard/updateExercise", $this->data);
        $loadView->loadView();
    }
}
