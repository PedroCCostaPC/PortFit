<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');


/**
 * Class UpdateSupplement -> Responsável por alterar Suplementacao
 */
class UpdateSupplement {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;


    /**
     * Funcao para alterar Suplemento
     */
    public function updateSupplement() {
        $id = $_POST['id'];
        $hour = intval($_POST['hour']);
        $minute = intval($_POST['minute']);
        $supplement = $_POST['supplement'];

        // Validando campos obrigatorios
        if(!$supplement) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location: #");
            return true;
        }

        // Preparando array para enviar ao Model
        $result['time'] = date("$hour:$minute:00");
        $result['supplement'] = $supplement;
        $result['id'] = $id;

        
        // Enviando ao Model
        $End = new \Sts\Models\Supplement\Update();
        $End->updateSupplement($result);


        $_SESSION['msg'] = 'Suplementação alterada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header('Location: #');

        return true;

    }

} 