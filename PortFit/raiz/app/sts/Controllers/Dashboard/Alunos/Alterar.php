<?php
namespace Sts\Controllers\Dashboard\Alunos;

use UpdateStudent;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 5) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Update/StudentUpdate.php');


/**
 * Controller da página dashboard -> alterar aluno
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
        // Retornando a pagina de alunos caso nao tenha $_GET['student']
        if(!isset($_GET['student'])) {
            header("Location: $this->url/dashboard/alunos");
            return;
        }


        $Student = new \Sts\Models\Student\Read();

        // Aluno
        $student = $Student->studentId($_GET['student']);

        // Retornando a pagina de alunos caso nao ache aluno
        if(!$student) {
            header("Location: $this->url/dashboard/alunos");
            return;
        }

        $this->data = $student;

        // Dividindo data de aniversario para formulario
        $this->data['day'] = substr($student['birth'], -2, 2);
        $this->data['month'] = substr($student['birth'], 5, 2);
        $this->data['year'] = substr($student['birth'], 0, 4);

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar modalidade
        if(isset($_POST['update-student'])) {
            $Update = new UpdateStudent();
            // Retorna para pagina 'dashboard/alunos/alterar' caso form erro
            // Retorna para pagina 'dashboard/alunos/alterar' caso form sucesso
            $return = $Update->updateStudent($_GET['student']);
            if($return) {
                return $this->data;
            }
        }
        

        $loadView = new \Core\ConfigView("sts/views/dashboard/updateStudent", $this->data);
        $loadView->loadView();
    }
}
