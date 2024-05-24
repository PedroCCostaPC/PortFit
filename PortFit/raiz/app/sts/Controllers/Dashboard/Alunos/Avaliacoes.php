<?php
namespace Sts\Controllers\Dashboard\Alunos;

use DeleteExam;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 5) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Delete/ExamDelete.php');


/**
 * Controller da página dashboard -> Avaliacoes do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Avaliacoes {
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

        $this->data['student'] = $student;

        // Pegando avaliacoes fisicas do aluno
        $Exam = new \Sts\Models\Exam\Read();
        $exam = $Exam->exam($student['id'], 'DESC');


        if($exam) {

            if(!isset($_GET['order'])) {
                $exam = $this->formatExam($exam);
    
                $this->data['last-exam'] = $exam[0];
                unset($exam[0]);
            }
    
            // Da mais antiga para mais nova
            if(isset($_GET['order']))  {
                $exam = $Exam->exam($student['id'], 'ASC');
                $lastExam = count($exam) - 1;

                $exam = $this->formatExam($exam);

                $this->data['last-exam'] = $exam[$lastExam];
                unset($exam[$lastExam]);

            };
            
            $this->data['all-exam'] = $exam;
        }

        // Definindo pronome
        $this->data['pronoun'] = $student['sex'] ? 'do' : 'da';

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar situacao do aluno
        if(isset($_POST['delete-exam'])) {
            $Delete = new DeleteExam();
            // Retorna para pagina '/dashboard/alunos/avaliacoes'
            $return = $Delete->deleteExam($student['id']);
            if($return) {
                return $this->data;
            }
        }


        $loadView = new \Core\ConfigView("sts/views/dashboard/examsStudent", $this->data);
        $loadView->loadView();
    }


    // Funcao para formatar data do exame e numerando exame
    private function formatExam($exam) {
        $counter = count($exam);
        
        if(!isset($_GET['order'])) {
            for($i = 0; $i < count($exam); $i++) {
                $date = explode('-', $exam[$i]['dateExam']);
    
                $day = $date[2];
                $month = $date[1];
                $year = $date[0];
    
                $exam[$i]['dateExam'] = date("$day/$month/$year");
                $exam[$i]['counter'] = $counter;
                $counter -= 1;
            }

        } else {
            for($i = count($exam) - 1; $i >= 0; $i--) {
                $date = explode('-', $exam[$i]['dateExam']);
    
                $day = $date[2];
                $month = $date[1];
                $year = $date[0];
    
                $exam[$i]['dateExam'] = date("$day/$month/$year");
                $exam[$i]['counter'] = $counter;
                $counter -= 1;
            }
        }


        return $exam;
    }
}
