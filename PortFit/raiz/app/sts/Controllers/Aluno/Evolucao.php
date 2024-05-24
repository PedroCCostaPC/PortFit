<?php
namespace Sts\Controllers\Aluno;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/StudentCheck.php');
require_once(dirname(__FILE__, 4) . '/functions/AgeCalculation.php');
require_once(dirname(__FILE__, 4) . '/functions/StudentEvolution.php');

/**
 * Controller da pagina de evolucao do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Evolucao {
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
        $this->data['title-student'] = true;

        $loadView = new \Core\ConfigView("sts/views/student/evolution", $this->data);
        $loadView->loadView();
    }

}
