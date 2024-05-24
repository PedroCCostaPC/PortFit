<?php
namespace Sts\Controllers\Dashboard\Alunos;


require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 5) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 5) . '/functions/AgeCalculation.php');


/**
 * Controller da página dashboard -> Avaliacao do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Avaliacao {
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

        // Formatando titulo
        if(isset($_GET['lastExam'])) {
            $exam['title'] = 'Última avaliação';
        } else {
            if(!isset($_GET['counter'])) {
                header("Location: $this->url/dashboard/alunos");
                return;
            }

            $exam['title'] = $_GET['counter'] . '° Avaliação';
        }

        // Formatando sexo
        $student['sex'] = $student['sex'] ? 'Masculino' : 'Feminino';


        // Formatando idade e idade da avaliacao
        /**
         * @function ageCalculation -> Calcula a idade do usuario
         * ageCalculation recebe 2 array
         * Primeiro array com a data de aniversario do usuario
         * Segundo array com uma data especifica para calculo de idade (Opcional)
         * Se nao enviado segundo array, caclcula a idade com a data atual de acesso a pagina
         * diretório da funcao -> app/functions/AgeCalculation.php
        */
        $student['age'] = ageCalculation($student['birth']);
        $student['age-exam'] = ageCalculation($student['birth'], $exam['dateExam']);


        // Formatando data
        $date = explode('-', $exam['dateExam']);

        $day = $date[2];
        $month = $date[1];
        $year = $date[0];

        $exam['dateExam'] = date("$day/$month/$year");


        // Formatando altura
        $exam['height'] = substr($exam['height'], 0, 1) . ',' . substr($exam['height'], 1);


        // Formatando textos
        $exam['injuries'] = $exam['injuries'] ? $exam['injuries'] : 'Nenhum';
        $exam['allergy'] = $exam['allergy'] ? $exam['allergy'] : 'Nenhum';
        $exam['deficiency'] = $exam['deficiency'] ? $exam['deficiency'] : 'Nenhum';
        $exam['surgeries'] = $exam['surgeries'] ? $exam['surgeries'] : 'Nenhum';
        $exam['pains'] = $exam['pains'] ? $exam['pains'] : 'Nenhum';



        $this->data['student'] = $student;
        $this->data['exam'] = $exam;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        $loadView = new \Core\ConfigView("sts/views/dashboard/examStudent", $this->data);
        $loadView->loadView();
    }


}
