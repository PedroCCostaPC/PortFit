<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');


/**
 * Class CreateSupplement -> Responsável por criar Suplementacao
 */
class CreateSupplement {
    /**
     * @var string $url -> variavel para link inicial do projeto
     */
    private $url = URL;
    
    /**
     * Funcao para criar Suplementacao
     */
    public function newSupplement($day, $student) {
        if($day == 1) {
            $return = "$this->url/dashboard/alunos/suplementacao/montar?student=$student";
        } else {
            $return = "$this->url/dashboard/alunos/suplementacao/montar?student=$student&day=$day";
        }

        $Create = new \Sts\Models\Supplement\Create();
        $Read = new \Sts\Models\Supplement\Read();
        $Update = new \Sts\Models\Supplement\Update();
        $Delete = new \Sts\Models\Supplement\Delete();

        // Buscando ID das alimentacoes ja montado no DB
        $sketchOldSupplement = $Read->allSupplementId($student, $day);
        for($i = 0; $i < count($sketchOldSupplement); $i++) {
            $oldSupplement[$i] = $sketchOldSupplement[$i]['id'];
        }


        // Retorna alimentacoes anteriores
        if(isset($_POST['supplement-id'])) {

            $previousId = $_POST['supplement-id'];
            $previousHour = $_POST['previous-hour'];
            $previousMinute = $_POST['previous-minute'];
            $previousSupplement = $_POST['previous-supplement'];


            // Comparando suplementacao do DB com o que retornou do formulario
            // Para remocao os que nao retornarem
            $SupplementCompare = array_diff($oldSupplement, $previousId);

            // Enviando ao Model para deletar
            if($SupplementCompare) {
                foreach($SupplementCompare as $result) {
                    $Delete->deleteSupplement($result);
                }
            }


            // Alterar suplementacao antigo que retornaram
            if($previousId) {
                for($i= 0; $i < count($previousId); $i++) {
                    // Validando campos obrigatorios
                    if(!$previousHour[$i] || !$previousSupplement[$i]) {
                        $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
                        $_SESSION['msg-type'] = 'error';
                        header("Location: $return");
                        return true;
                    }

                    $previousHour[$i] = intval($previousHour[$i]);
                    $previousMinute[$i] = intval($previousMinute[$i]);


                    // Preparando array para enviar ao Model
                    $resultUpdate[$i]['id'] = $previousId[$i];
                    $resultUpdate[$i]['time'] = date("$previousHour[$i]:$previousMinute[$i]:00");
                    $resultUpdate[$i]['supplement'] = $previousSupplement[$i];
                }

                // Enviando ao Model
                foreach($resultUpdate as $result) {
                    $Update->updateSupplement($result);
                }
            }


        } else {
            $Delete->deleteAllSupplement($student, $day);
        }


        // Para novas refeicoes caso houver
        if(isset($_POST['new-supplement'])) {
            $newSupplement = $_POST['new-supplement'];
            $newHour = $_POST['new-hour'];
            $newMinute = $_POST['new-minute'];


            for($i= 0; $i < count($newSupplement); $i++) {
                // Validando campos obrigatorios
                if(!$newSupplement[$i] || !$newHour[$i]) {
                    $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
                    $_SESSION['msg-type'] = 'error';
                    header("Location: $return");
                    return true;
                }

                $newHour[$i] = intval($newHour[$i]);
                $newMinute[$i] = intval($newMinute[$i]);


                // Preparando array para enviar ao Model
                $resultCreate[$i]['time'] = date("$newHour[$i]:$newMinute[$i]:00");
                $resultCreate[$i]['supplement'] = $newSupplement[$i];
            }

            // Enviando ao Model
            foreach($resultCreate as $result) {
                $Create->createSupplement($result, $day, $student);
            }
        }


        // Formatando semana para msg de retorno
        $week = ['Domingo', 'Segunda-Feira', 'Treça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];

        // Finalizando
        $_SESSION['msg'] = "Suplementação de <b>$week[$day]</b> salva com sucesso!";
        $_SESSION['msg-type'] = 'success';
        header("Location: $return");

        return true;

    }
}