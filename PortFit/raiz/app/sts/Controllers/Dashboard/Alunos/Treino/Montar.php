<?php
namespace Sts\Controllers\Dashboard\Alunos\Treino;

use CreateTraining;

require_once(dirname(__FILE__, 7) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 6) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 6) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 4) . '/CRUD/Create/TrainingCreate.php');



/**
 * Controller da página dashboard -> Montar Treino do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Montar {
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
                header("Location: $this->url/dashboard/alunos/treino/montar?student=$student[id]");
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

        // Pegando as categorias dos treinos do dia
        $categoryDay = $Training->trainingCategory($student['id'], $day);    
        for($i = 0 ; $i < count($categoryDay); $i++) {
            $categoryDay[$i] = $categoryDay[$i]['exCategory_id'];
        }
        
        // Pegando todos os treinos do dia
        foreach($categoryDay as $cat) {
            $training[$cat] = $Training->allTrainingBase($student['id'], $cat, $day);
        }
        
        // Pegando todos exercicios com situacao ativa
        $Exercise = new \Sts\Models\Exercise\Read();
        $exercises = $Exercise->allCategory();

        // Checando se existe exercicio ativo para a categoria
        for($i = 0; $i < count($exercises); $i++) {
            $checkCategory = $Exercise->categoryExerciseBase($exercises[$i]['id']);
            
            if(!$checkCategory) {
                $checkCategoryArray[] = $i; 
            }
        }
        if(isset($checkCategoryArray)) {
            for($i = 0; $i < count($checkCategoryArray); $i++) {
                unset($exercises[$checkCategoryArray[$i]]);
            }
            rsort($exercises);
        }


        for($i = 0; $i < count($exercises); $i++) {
            $exercises[$i]['exercises'] = $Exercise->categoryExerciseBase($exercises[$i]['id']);
        }


        // Checando as categorias que tem exercicio montado
        foreach($categoryDay as $catDay) {
            for($i = 0; $i < count($exercises); $i++) {
                
                if($catDay === $exercises[$i]['id']) {
                    $exercises[$i]['checked'] = true;

                    // Checando os exercicio que estao montado
                    foreach($training as $train) {
                        foreach($train as $ex) {
                            for($j = 0; $j < count($exercises[$i]['exercises']); $j++) {
    
                                if($ex['exercise_id'] === $exercises[$i]['exercises'][$j]['id']) {
                                    $exercises[$i]['exercises'][$j]['training-id'] = $ex['id'];
                                    $exercises[$i]['exercises'][$j]['series'] = $ex['series'];
                                    $exercises[$i]['exercises'][$j]['min'] = $ex['min'];
                                    $exercises[$i]['exercises'][$j]['max'] = $ex['max'];
                                }
                            }
                        }
                    }
                }
            }
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

        // Definindo pronome
        $this->data['pronoun'] = $student['sex'] ? 'do' : 'da';

        $this->data['student'] = $student;
        $this->data['day'] = $week[$day];
        $this->data['counterDay'] = $counterDay;
        $this->data['exercises'] = $exercises;
        $this->data['day-class'] = $dayClass;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para criar treino
        if(isset($_POST['create-training'])) {
            $Create = new CreateTraining();
            // Retorna para pagina '/dashboard/alunos/treino'
            $return = $Create->newTraining($day, $student['id']);
            if($return) {
                return $this->data;
            }
        }


        $loadView = new \Core\ConfigView("sts/views/dashboard/trainingSetup", $this->data);
        $loadView->loadView();
    }
}
