<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');


/**
 * Class CreateFood -> Responsável por criar Alimentacao
 */
class CreateFood {
    /**
     * @var string $url -> variavel para link inicial do projeto
     */
    private $url = URL;
    
    /**
     * Funcao para criar Alimentacao
     */
    public function newFood($day, $student) {
        if($day == 1) {
            $return = "$this->url/dashboard/alunos/alimentacao/montar?student=$student";
        } else {
            $return = "$this->url/dashboard/alunos/alimentacao/montar?student=$student&day=$day";
        }

        $Create = new \Sts\Models\Food\Create();
        $Read = new \Sts\Models\Food\Read();
        $Update = new \Sts\Models\Food\Update();
        $Delete = new \Sts\Models\Food\Delete();

        // Buscando ID das alimentacoes ja montado no DB
        $sketchOldFood = $Read->allFoodId($student, $day);
        for($i = 0; $i < count($sketchOldFood); $i++) {
            $oldFood[$i] = $sketchOldFood[$i]['id'];
        }


        // Retorna alimentacoes anteriores
        if(isset($_POST['food-id'])) {

            $previousId = $_POST['food-id'];
            $previousHour = $_POST['previous-hour'];
            $previousMinute = $_POST['previous-minute'];
            $previousFood = $_POST['previous-food'];


            // Comparando alimentacao do DB com o que retornou do formulario
            // Para remocao os que nao retornarem
            $FoodCompare = array_diff($oldFood, $previousId);

            // Enviando ao Model para deletar
            if($FoodCompare) {
                foreach($FoodCompare as $result) {
                    $Delete->deleteFood($result);
                }
            }


            // Alterar alimentacao antigo que retornaram
            if($previousId) {
                for($i= 0; $i < count($previousId); $i++) {
                    // Validando campos obrigatorios
                    if(!$previousHour[$i] || !$previousFood[$i]) {
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
                    $resultUpdate[$i]['food'] = $previousFood[$i];
                }

                // Enviando ao Model
                foreach($resultUpdate as $result) {
                    $Update->updateFood($result);
                }
            }


        } else {
            $Delete->deleteAllFood($student, $day);
        }


        // Para novas refeicoes caso houver
        if(isset($_POST['new-food'])) {
            $newFood = $_POST['new-food'];
            $newHour = $_POST['new-hour'];
            $newMinute = $_POST['new-minute'];


            for($i= 0; $i < count($newFood); $i++) {
                // Validando campos obrigatorios
                if(!$newFood[$i]) {
                    $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
                    $_SESSION['msg-type'] = 'error';
                    header("Location: $return");
                    return true;
                }

                $newHour[$i] = intval($newHour[$i]);
                $newMinute[$i] = intval($newMinute[$i]);


                // Preparando array para enviar ao Model
                $resultCreate[$i]['time'] = date("$newHour[$i]:$newMinute[$i]:00");
                $resultCreate[$i]['food'] = $newFood[$i];
            }

            // Enviando ao Model
            foreach($resultCreate as $result) {
                $Create->createFood($result, $day, $student);
            }
        }


        // Formatando semana para msg de retorno
        $week = ['Domingo', 'Segunda-Feira', 'Treça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];

        // Finalizando
        $_SESSION['msg'] = "Alimentação de <b>$week[$day]</b> salva com sucesso!";
        $_SESSION['msg-type'] = 'success';
        header("Location: $return");

        return true;

    }
}
    
    