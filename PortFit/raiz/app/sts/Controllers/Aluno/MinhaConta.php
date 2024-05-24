<?php
namespace Sts\Controllers\Aluno;

use UpdateStudent;

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/StudentCheck.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Update/StudentUpdate.php');

/**
 * Controller da pagina do aluno -> alterar minha conta
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class MinhaConta {
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
        $myId = $_SESSION['student']['id'];
        $Student = new \Sts\Models\Student\Read();

        // Aluno
        $student = $Student->studentId($myId);
        $this->data = $student;

        // Dividindo data de aniversario para formulario
        $this->data['day'] = substr($student['birth'], -2, 2);
        $this->data['month'] = substr($student['birth'], 5, 2);
        $this->data['year'] = substr($student['birth'], 0, 4);

        $this->data['block-nav'] = true;
        $this->data['title-student'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar modalidade
        if(isset($_POST['update-account'])) {
            $Update = new UpdateStudent();
            // Retorna para pagina 'aluno/minhaConta'
            $return = $Update->updateMyAccount();
            if($return) {
                return $this->data;
            }
        }

        // Form para alterar senha
        if(isset($_POST['update-password'])) {
            $Update = new UpdateStudent();
            // Retorna para pagina 'aluno/minhaConta'
            $return = $Update->updateMyPassword();
            if($return) {
                return $this->data;
            }
        }

        $loadView = new \Core\ConfigView("sts/views/student/myAccount", $this->data);
        $loadView->loadView();
    }
}
