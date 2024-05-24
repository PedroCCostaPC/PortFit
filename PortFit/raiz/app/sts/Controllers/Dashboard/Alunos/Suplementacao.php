<?php
namespace Sts\Controllers\Dashboard\Alunos;

use UpdateSupplement;
use DeleteSupplement;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 5) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Update/SupplementUpdate.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Delete/SupplementDelete.php');


/**
 * Controller da página dashboard -> Toda a suplementacao do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Suplementacao {
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
                header("Location: $this->url/dashboard/alunos/suplementacao?student=$student[id]");
                return;
            }

            $day = $_GET['day'];

        } else {
            $day = 1;
        }


        $Supplement = new \Sts\Models\Supplement\Read();

        // Quantidade de suplementacao por dia
        for($i = 0; $i <= 6; $i++) {
            $counterDay[$i] = $Supplement->countDaySupplement($student['id'], $i);
            $counterDay[$i] = $counterDay[$i]['counter'];

            // Checando se aluno possui suplementacao em algum dia
            if($counterDay[$i] > 0) $hasSupplement = true;
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

        // Pegando suplementacao do dia
        $supplement = $Supplement->allSupplement($student['id'], $day);

        // Formatando horario
        for($i = 0; $i < count($supplement); $i++) {
            $time = explode(':', $supplement[$i]['time']);

            $hour = $time[0];
            $minute = $time[1];

            $supplement[$i]['time'] = "$hour:$minute";
            $supplement[$i]['hour'] = $hour;
            $supplement[$i]['minute'] = $minute;
        }

        // Redirecionado para pagina do primeiro dia que achar treino
        $forCount = 0;
        if(!$supplement) {
            for($i = 1; $i <= 6; $i++) {
                $checkDay = $Supplement->countDaySupplement($student['id'], $i);
    
                if($checkDay['counter'] > 0) {
                    header("Location: $this->url/dashboard/alunos/suplementacao?student=$student[id]&day=$i");
                    break;
                }

                $forCount = $i + 1;
            }
        }
        if($forCount === 7) {
            $checkDay = $Supplement->countDaySupplement($student['id'], 0);
            if($checkDay['counter'] > 0) {
                header("Location: $this->url/dashboard/alunos/suplementacao?student=$student[id]&day=0");
            }
        }

        // Definindo pronome
        $this->data['pronoun'] = $student['sex'] ? 'do' : 'da';

        $this->data['student'] = $student;
        $this->data['day'] = $week[$day];
        $this->data['counterDay'] = $counterDay;
        $this->data['supplement'] = $supplement;
        $this->data['day-class'] = $dayClass;
        $this->data['hasSupplement'] = isset($hasSupplement) ? $hasSupplement : null;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar suplementacao
        if(isset($_POST['update-supplement'])) {
            $Update = new UpdateSupplement();
            // Retorna para pagina '/dashboard/alunos/suplementacao'
            $return = $Update->updateSupplement();
            if($return) {
                return $this->data;
            }
        }

        // Form para deletar suplementacao
        if(isset($_POST['delete-supplement'])) {
            $Delete = new DeleteSupplement();
            // Retorna para pagina '/dashboard/alunos/suplementacao'
            $return = $Delete->deleteSupplement();
            if($return) {
                return $this->data;
            }
        }

        
        
        


        $loadView = new \Core\ConfigView("sts/views/dashboard/supplementAll", $this->data);
        $loadView->loadView();
    }


   
}
