<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');


/**
 * Class UpdateFood -> Responsável por alterar Alimentacao
 */
class UpdateFood {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;


    /**
     * Funcao para alterar Alimentacao
     */
    public function updateFood() {
        $id = $_POST['id'];
        $hour = intval($_POST['hour']);
        $minute = intval($_POST['minute']);
        $food = $_POST['food'];

        // Validando campos obrigatorios
        if(!$food) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location: #");
            return true;
        }

        // Preparando array para enviar ao Model
        $result['time'] = date("$hour:$minute:00");
        $result['food'] = $food;
        $result['id'] = $id;

        
        // Enviando ao Model
        $End = new \Sts\Models\Food\Update();
        $End->updateFood($result);


        $_SESSION['msg'] = 'Alimentação alterada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header('Location: #');

        return true;

    }

} 