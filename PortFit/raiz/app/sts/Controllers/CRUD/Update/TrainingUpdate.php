<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');


/**
 * Class UpdateTraining -> Responsável por alterar Treinos
 */
class UpdateTraining {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;


    /**
     * Funcao para alterar Treino
     */
    public function updateTraining() {
        $id = $_POST['id'];
        $series = intval($_POST['series']) ? intval($_POST['series']) : 3;
        $min = intval($_POST['min']) ? intval($_POST['min']) : 10;
        $max = intval($_POST['max']) ? intval($_POST['max']) : 15;


        // Preparando array para enviar ao Model
        $result['series'] = $series;
        $result['min'] = $min;
        $result['max'] = $max;
        $result['id'] = $id;

        // Enviando ao Model
        $End = new \Sts\Models\Training\Update();
        $End->updateTraining($result);


        $_SESSION['msg'] = 'Treino alterado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header('Location: #');

        return true;
    }

} 