<?php
namespace Sts\Controllers\Dashboard\Alunos\Avaliacao;

use CreateExam;


require_once(dirname(__FILE__, 7) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 6) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 6) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 6) . '/functions/AgeCalculation.php');
require_once(dirname(__FILE__, 4) . '/CRUD/Create/ExamCreate.php');



/**
 * Controller da página dashboard -> Adicionar Avaliacao do aluno
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

        // Buscando ultimo exame
        $Exam = new \Sts\Models\Exam\Read();
        $exam = $Exam->lastExam($student['id']);

        if(!$exam) {
            $exam['height'] = null;
            $exam['idealWeight'] = null;
            $exam['idealLeanMass'] = null;
            $exam['idealFatMass'] = null;
            $exam['idealTbw'] = null;
            $exam['idealEcw'] = null;
            $exam['idealIcw'] = null;
            $exam['injuries'] = null;
            $exam['allergy'] = null;
            $exam['deficiency'] = null;
            $exam['surgeries'] = null;
            $exam['pains'] = null;
        }

        // Pegando idade
        /**
         * @function ageCalculation -> Calcula a idade do usuario
         * ageCalculation recebe 2 array
         * Primeiro array com a data de aniversario do usuario
         * Segundo array com uma data especifica para calculo de idade (Opcional)
         * Se nao enviado segundo array, caclcula a idade com a data atual de acesso a pagina
         * diretório da funcao -> app/functions/AgeCalculation.php
        */
        $student['age'] = ageCalculation($student['birth']);

        // Formatando sexo
        $student['sex'] = $student['sex'] ? 'Masculino' : 'Feminino';


        $this->data['student'] = $student;
        $this->data['exam'] = $exam;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;


        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para criar exame
        if(isset($_POST['create-exam'])) {
            $Create = new CreateExam();
            // Retorna para pagina 'dashboard/alunos/avaliacao/adicionar' caso form erro
            // Retorna para pagina 'dashboard/alunos/avaliacoes' caso form sucesso
            $return = $Create->newExam($student['id']);
            if($return) {
                return $this->data;
            }
        }

        $loadView = new \Core\ConfigView("sts/views/dashboard/createExam", $this->data);
        $loadView->loadView();
    }
}
