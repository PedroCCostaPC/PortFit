<?php
namespace Sts\Controllers\Dashboard\Alunos;

use UpdateFood;
use DeleteFood;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 5) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Update/FoodUpdate.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Delete/FoodDelete.php');


/**
 * Controller da página dashboard -> Toda a alimentacao do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Alimentacao {
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
                header("Location: $this->url/dashboard/alunos/alimentacao?student=$student[id]");
                return;
            }

            $day = $_GET['day'];

        } else {
            $day = 1;
        }

        $Food = new \Sts\Models\Food\Read();

        // Quantidade de alimentacao por dia
        for($i = 0; $i <= 6; $i++) {
            $counterDay[$i] = $Food->countDayFood($student['id'], $i);
            $counterDay[$i] = $counterDay[$i]['counter'];

            // Checando se aluno possui alimentao em algum dia
            if($counterDay[$i] > 0) $hasFood = true;
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

        // Pegando alimentacoes do dia
        $food = $Food->allFood($student['id'], $day);

        // Formatando horario
        for($i = 0; $i < count($food); $i++) {
            $time = explode(':', $food[$i]['time']);

            $hour = $time[0];
            $minute = $time[1];

            $food[$i]['time'] = "$hour:$minute";
            $food[$i]['hour'] = $hour;
            $food[$i]['minute'] = $minute;
        }

        // Redirecionado para pagina do primeiro dia que achar treino
        $forCount = 0;
        if(!$food) {
            for($i = 1; $i <= 6; $i++) {
                $checkDay = $Food->countDayFood($student['id'], $i);
    
                if($checkDay['counter'] > 0) {
                    header("Location: $this->url/dashboard/alunos/alimentacao?student=$student[id]&day=$i");
                    break;
                }

                $forCount = $i + 1;
            }
        }
        if($forCount === 7) {
            $checkDay = $Food->countDayFood($student['id'], 0);
            if($checkDay['counter'] > 0) {
                header("Location: $this->url/dashboard/alunos/alimentacao?student=$student[id]&day=0");
            }
        }

        // Definindo pronome
        $this->data['pronoun'] = $student['sex'] ? 'do' : 'da';

        $this->data['student'] = $student;
        $this->data['day'] = $week[$day];
        $this->data['counterDay'] = $counterDay;
        $this->data['food'] = $food;
        $this->data['day-class'] = $dayClass;
        $this->data['hasFood'] = isset($hasFood) ? $hasFood : null;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar alimentacao
        if(isset($_POST['update-food'])) {
            $Update = new UpdateFood();
            // Retorna para pagina '/dashboard/alunos/alimentacao'
            $return = $Update->updateFood();
            if($return) {
                return $this->data;
            }
        }

        // Form para deletar alimentacao
        if(isset($_POST['delete-food'])) {
            $Delete = new DeleteFood();
            // Retorna para pagina '/dashboard/alunos/alimentacao'
            $return = $Delete->deleteFood();
            if($return) {
                return $this->data;
            }
        }


        $loadView = new \Core\ConfigView("sts/views/dashboard/foodAll", $this->data);
        $loadView->loadView();
    }


   
}
