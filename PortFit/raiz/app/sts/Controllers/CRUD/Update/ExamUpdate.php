<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');


/**
 * Class UpdateExam -> Responsável por alterar Exames
 */
class UpdateExam {
    /**
     * $url -> variavel para link inicial do projeto
     *
     * @var string
     */
    private $url = URL;

    /**
     * Funcao para alterar exame
     */
    public function newExam($student, $exam) {
        $return = "$this->url/dashboard/alunos/avaliacao/alterar?student=$student&exam=$exam";

        // Checando se existe 'smoke' e 'alcoholic'
        if(!isset($_POST['smoke']) || !isset($_POST['alcoholic'])) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $return");
            return true;
        }

        $height = $_POST['height'];
        $weight = $_POST['weight'];
        $idealWeight = $_POST['weight-ideal'];
        $leanMass = $_POST['lean-mass'];
        $idealLeanMass = $_POST['lean-mass-ideal'];
        $fatMass = $_POST['fat-mass'];
        $idealFatMass = $_POST['fat-mass-ideal'];
        $tbw = $_POST['tbw'];
        $idealTbw = $_POST['tbw-ideal'];
        $ecw = $_POST['ecw'];
        $idealEcw = $_POST['ecw-ideal'];
        $icw = $_POST['icw'];
        $idealIcw = $_POST['icw-ideal'];
        $systolic = $_POST['systolic'];
        $diastolic = $_POST['diastolic'];
        $smoke = $_POST['smoke'];
        $alcoholic = $_POST['alcoholic'];
        $injuries = $_POST['injuries'];
        $allergy = $_POST['allergy'];
        $deficiency = $_POST['deficiency'];
        $surgeries = $_POST['surgeries'];
        $pains = $_POST['pains'];
        $day = $_POST['day'];
        $month = $_POST['month'];
        $year = $_POST['year'];


        // Checando se campos obrigatorios foram preenchidos
        if(!$height || !$weight || !$idealWeight || !$leanMass || !$idealLeanMass || !$fatMass || !$idealFatMass || !$tbw || !$idealTbw || !$ecw || !$idealEcw || !$icw || !$idealIcw || !$systolic || !$diastolic) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $return");
            return true;
        }

        // Validando smoke
        if($smoke !== 'Não' && $smoke !== 'Sim') {
            $_SESSION['msg'] = 'Preencha todos os campos corretamente!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $return");
            return true;
        }

        // Validando alcoholic
        if($alcoholic !== 'Não' && $alcoholic !== 'Pouco' && $alcoholic !== 'Muito') {
            $_SESSION['msg'] = 'Preencha todos os campos corretamente!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $return");
            return true;
        }


        // Validando data do exame caso informado
        if($day && $month && $year) {
            if(!checkdate($month, $day, $year)) {
                $_SESSION['msg'] = 'Data inválida!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $return");
                return true;
            }

            $dateExam = new DateTime("$year-$month-$day");
            $dateExam = $dateExam->format('Y-m-d');

            if($dateExam > date('Y-m-d')) {
                $_SESSION['msg'] = 'Data inválida!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $return");
                return true;
            }

        // Pega data atual do registro caso nao foi registrado uma data
        } else {
            $dateExam = date('Y-m-d');
        }



        // Preparando array para enviar ao Model
        $result['height'] = $height;
        $result['weight'] = $weight;
        $result['idealWeight'] = $idealWeight;
        $result['leanMass'] = $leanMass;
        $result['idealLeanMass'] = $idealLeanMass;
        $result['fatMass'] = $fatMass;
        $result['idealFatMass'] = $idealFatMass;
        $result['tbw'] = $tbw;
        $result['idealTbw'] = $idealTbw;
        $result['ecw'] = $tbw;
        $result['idealEcw'] = $idealEcw;
        $result['icw'] = $icw;
        $result['idealIcw'] = $idealIcw;
        $result['systolic'] = $systolic;
        $result['diastolic'] = $diastolic;
        $result['smoke'] = $smoke;
        $result['alcoholic'] = $alcoholic;
        $result['injuries'] = ucfirst($injuries);
        $result['allergy'] = ucfirst($allergy);
        $result['deficiency'] = ucfirst($deficiency);
        $result['surgeries'] = ucfirst($surgeries);
        $result['pains'] = ucfirst($pains);
        $result['dateExam'] = $dateExam;
        $result['id'] = $exam;


        // Enviando ao Model
        $End = new \Sts\Models\Exam\Update();
        $End->updateExam($result);


        // Finalizando
        $_SESSION['msg'] = 'Exame alterado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $return");

        return true; 
    }
    
}