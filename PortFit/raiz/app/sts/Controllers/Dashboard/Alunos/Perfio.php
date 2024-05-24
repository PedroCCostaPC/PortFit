<?php
namespace Sts\Controllers\Dashboard\Alunos;


require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 5) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 5) . '/functions/AgeCalculation.php');
require_once(dirname(__FILE__, 5) . '/functions/StudentEvolution.php');


/**
 * Controller da página dashboard -> Perfio do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Perfio {
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


        // Pegando avaliacoes fisicas do aluno
        $Exam = new \Sts\Models\Exam\Read();
        $exam = $Exam->exam($student['id'], 'DESC');

        /**
         * @function evolution -> Formata evolucao do aluno
         * evolution recebe array com exames do aluno
         * diretório da funcao -> app/functions/StudetnEvolution.php
        */
        $exam = evolution($exam);

        $this->data['student'] = $student;
        $this->data['student']['sex'] = $student['sex'] ? 'Masculino' : 'Feminino';
        $this->data['exam'] = $exam;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        $loadView = new \Core\ConfigView("sts/views/dashboard/profileStudent", $this->data);
        $loadView->loadView();
    }
}
