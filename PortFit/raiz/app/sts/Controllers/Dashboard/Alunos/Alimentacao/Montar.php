<?php
namespace Sts\Controllers\Dashboard\Alunos\Alimentacao;

use CreateFood;

require_once(dirname(__FILE__, 7) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 6) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 6) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 4) . '/CRUD/Create/FoodCreate.php');

/**
 * Controller da página dashboard -> Montar Alimentacao do aluno
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
                header("Location: $this->url/dashboard/alunos/alimentacao/montar?student=$student[id]");
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

        // Pegando todas alimentacao do dia
        $allFood = $Food->allFood($student['id'], $day);

        // Formatando horario
        for($i = 0; $i < count($allFood); $i++) {
            $time = explode(':', $allFood[$i]['time']);

            $hour = $time[0];
            $minute = $time[1];

            $allFood[$i]['hour'] = $hour;
            $allFood[$i]['minute'] = $minute;
        }

        // Definindo pronome
        $this->data['pronoun'] = $student['sex'] ? 'do' : 'da';

        $this->data['student'] = $student;
        $this->data['day'] = $week[$day];
        $this->data['counterDay'] = $counterDay;
        $this->data['all-food'] = $allFood;
        $this->data['day-class'] = $dayClass;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para criar alimentacao
        if(isset($_POST['create-food'])) {
            $Create = new CreateFood();
            // Retorna para pagina '/dashboard/alunos/alimentacao/montar'
            $return = $Create->newFood($day, $student['id']);
            if($return) {
                return $this->data;
            }
        }



        $loadView = new \Core\ConfigView("sts/views/dashboard/foodSetup", $this->data);
        $loadView->loadView();
    }
}
