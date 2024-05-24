<?php
namespace Sts\Controllers\Dashboard\Alunos\Avaliacao;

use UpdateExam;


require_once(dirname(__FILE__, 7) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 6) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 6) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 6) . '/functions/AgeCalculation.php');
require_once(dirname(__FILE__, 4) . '/CRUD/Update/ExamUpdate.php');



/**
 * Controller da página dashboard -> Alterar Avaliacao do aluno
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

        // Buscando exame
        $Exam = new \Sts\Models\Exam\Read();
        $exam = $Exam->examId($_GET['exam']);

        // Retornando a pagina de alunos caso nao ache exame
        if(!$exam) {
            header("Location: $this->url/dashboard/alunos");
            return;
        }

        // Retornando a pagina de alunos caso id do aluno nao seja o student_id do exame
        if($exam['student_id'] !== $student['id']) {
            header("Location: $this->url/dashboard/alunos");
            return;
        }

        // Formatando data
        $date = explode('-', $exam['dateExam']);

        $day = $date[2];
        $month = $date[1];
        $year = $date[0];

        $exam['dateExam'] = date("$day/$month/$year");

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
        $this->data['exam']['day'] = $day;
        $this->data['exam']['month'] = $month;
        $this->data['exam']['year'] = $year;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar exame
        if(isset($_POST['update-exam'])) {
            $Update = new UpdateExam();
            // Retorna para pagina 'dashboard/alunos/avaliacao/alterar'
            $return = $Update->newExam($student['id'], $exam['id']);
            if($return) {
                return $this->data;
            }
        }

        $loadView = new \Core\ConfigView("sts/views/dashboard/updateExam", $this->data);
        $loadView->loadView();
    }
}
