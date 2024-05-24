<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');


/**
 * Class CreateTraining -> Responsável por criar Treino
 */
class CreateTraining {
    /**
     * @var string $url -> variavel para link inicial do projeto
     */
    private $url = URL;
    
    /**
     * Funcao para criar Treino
     */
    public function newTraining($day, $student) {
        if($day == 1) {
            $return = "$this->url/dashboard/alunos/treino/montar?student=$student";
        } else {
            $return = "$this->url/dashboard/alunos/treino/montar?student=$student&day=$day";
        }

        $Create = new \Sts\Models\Training\Create();
        $Read = new \Sts\Models\Training\Read();
        $ReadExercise = new \Sts\Models\Exercise\Read();
        $Update = new \Sts\Models\Training\Update();
        $Delete = new \Sts\Models\Training\Delete();
        
        // Buscando ID dos treino ja montado no DB
        $sketchOldTraining = $Read->oldTraining($student, $day);
        for($i = 0; $i < count($sketchOldTraining); $i++) {
            $oldTraining[$i] = $sketchOldTraining[$i]['id'];
        }
        
    
        // Retorna exercicios que ja estavam no treino
        if(isset($_POST['id-training'])) {
            $previeusTraining = $_POST['id-training'];
            $previeusSeries = $_POST['previous-series'];
            $previeusMin = $_POST['previous-min'];
            $previeusMax = $_POST['previous-max'];
            
            
            // Comparando treino do DB com o que retornou do formulario
            // Para remocao os que nao retornarem
            $trainingCompare = array_diff($oldTraining, $previeusTraining);
            
            // Enviando ao Model para deletar
            if($trainingCompare) {
                foreach($trainingCompare as $result) {
                    $Delete->deleteTraining($result);
                }
            }
            
            // Alterar treino antigo que retornaram
            if($previeusTraining) {

                // Preparando array para enviar ao Model
                for($i = 0; $i < count($previeusTraining); $i++) {
                    $resultUpdate[$i]['id'] = $previeusTraining[$i];
                    $resultUpdate[$i]['series'] = $previeusSeries[$i];
                    $resultUpdate[$i]['min'] = $previeusMin[$i];
                    $resultUpdate[$i]['max'] = $previeusMax[$i];
                }

                // Enviando ao Model
                foreach($resultUpdate as $result) {
                    $Update->updateTraining($result);
                }
            }

                
        // Deletar todos os trainos antigos do aluno no dia
        } else {
            $Delete->deleteAllTraining($student, $day);
        }


        // Para novos treinos caso houver
        if(isset($_POST['new-exercise-id'])) {
            $newExercises = $_POST['new-exercise-id'];
            $newSeries = $_POST['new-series'];
            $newMin = $_POST['new-min'];
            $newMax = $_POST['new-max'];

            // Preparando array para envio ao Model
            for($i = 0; $i < count($newExercises); $i++) {
                $newTraining[$i]['series'] = $newSeries[$i];
                $newTraining[$i]['min'] = $newMin[$i];
                $newTraining[$i]['max'] = $newMax[$i];
                $newTraining[$i]['exercise_id'] = $newExercises[$i];
                $newTraining[$i]['category'] = $ReadExercise->exerciseCategoryId($newExercises[$i]);
                $newTraining[$i]['category'] = $newTraining[$i]['category']['exCategory_id'];
            }

            // Enviando ao Model
            foreach($newTraining as $result) {
                $Create->createTraining($result, $day, $student);
            }
        }

        // Formatando semana para msg de retorno
        $week = ['Domingo', 'Segunda-Feira', 'Treça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];
            
        // Finalizando
        $_SESSION['msg'] = "Treino de <b>$week[$day]</b> salvo com sucesso!";
        $_SESSION['msg-type'] = 'success';
        header("Location: $return");

        return true;
    }
}
    
    