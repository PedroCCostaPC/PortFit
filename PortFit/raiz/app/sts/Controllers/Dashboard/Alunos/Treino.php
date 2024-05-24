<?php
namespace Sts\Controllers\Dashboard\Alunos;

use UpdateTraining;
use DeleteTraining;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 5) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Update/TrainingUpdate.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Delete/TrainingDelete.php');


/**
 * Controller da página dashboard -> Todo o treino do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Treino {
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

        // Aluno
        $Student = new \Sts\Models\Student\Read();
        $student = $Student->studentId($_GET['student']);

        // Retornando a pagina de alunos caso nao ache aluno
        if(!$student) {
            header("Location: $this->url/dashboard/alunos");
            return;
        }

        // Formatando dia da semana
        $week = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];

        // Pegando dia da semana
        if(isset($_GET['day'])) {
            if($_GET['day'] < 0 || $_GET['day'] > 6) {
                header("Location: $this->url/dashboard/alunos/treino?student=$student[id]");
                return;
            }

            $day = $_GET['day'];

        } else {
            $day = 1;
        }

        $Training = new \Sts\Models\Training\Read();

        // Quantidade de exercicios por dia
        for($i = 0; $i <= 6; $i++) {
            $counterDay[$i] = $Training->countDayExercise($student['id'], $i);
            $counterDay[$i] = $counterDay[$i]['counter'];
        }

        // Colocando class css de acordo com o dia da pagina
        for($i = 0; $i <= 6; $i++) {
            if(!isset($_GET['day'])) {
                $dayClass[1] = 'day-page';

                if($i !== 1) $dayClass[$i] = null;

            } else {
                if($_GET['day'] == $i) {
                    $dayClass[$i] = 'day-page';
                } else {
                    $dayClass[$i] = null;
                }
            }
        }

        // Pegando as categorias dos treinos do dia
        $category = $Training->trainingCategory($student['id'], $day);        
        for($i = 0 ; $i < count($category); $i++) {
            $category[$i] = $category[$i]['exCategory_id'];
        }

        // Pegando todos os treinos do dia
        foreach($category as $cat) {
            $training[$cat] = $Training->allTrainingBase($student['id'], $cat, $day);
        }
        
        if($category) {
            $category = null;

            // Pegando o nome da categoria
            foreach($training as $i) {
                $category[] = $i[0]['category'];
            }

            $this->data['category'] = $category;
            $this->data['training'] = $training;
        }
        
        // Redirecionado para pagina do primeiro dia que achar treino
        $forCount = 0;
        if(!isset($training)) {
            for($i = 1; $i <= 6; $i++) {
                $checkDay = $Training->countDayExercise($student['id'], $i);
    
                if($checkDay['counter'] > 0) {
                    header("Location: $this->url/dashboard/alunos/treino?student=$student[id]&day=$i");
                    break;
                }

                $forCount = $i + 1;
            }

        }
        if($forCount === 7) {
            $checkDay = $Training->countDayExercise($student['id'], 0);
            if($checkDay['counter'] > 0) {
                header("Location: $this->url/dashboard/alunos/treino?student=$student[id]&day=0");
            }
        }

        // Definindo pronome
        $this->data['pronoun'] = $student['sex'] ? 'do' : 'da';

        $this->data['student'] = $student;
        $this->data['day'] = $week[$day];
        $this->data['counterDay'] = $counterDay;
        $this->data['day-class'] = $dayClass;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar treino
        if(isset($_POST['update-training'])) {
            $Update = new UpdateTraining();
            // Retorna para pagina '/dashboard/alunos/treino'
            $return = $Update->updateTraining();
            if($return) {
                return $this->data;
            }
        }

        // Form para deletar treino
        if(isset($_POST['delete-training'])) {
            $Delete = new DeleteTraining();
            // Retorna para pagina '/dashboard/alunos/treino'
            $return = $Delete->deleteTraining();
            if($return) {
                return $this->data;
            }
        }
        


        $loadView = new \Core\ConfigView("sts/views/dashboard/trainingAll", $this->data);
        $loadView->loadView();
    }


   
}
