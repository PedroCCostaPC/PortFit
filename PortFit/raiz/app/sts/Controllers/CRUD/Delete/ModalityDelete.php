<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 

/**
 * Class DeleteModality -> Responsável por deletar modalidades
 */
class DeleteModality {
    /**
     * $url -> variavel para link inicial do projeto
     *
     * @var string
     */
    private $url = URL;

    /**
     * Funcao para Deletar modalidades
     */
    public function DeleteModality() {
        // Retornar error se não encontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível deletar modalidade!';
            $_SESSION['msg-type'] = 'error';

            header("Location: $this->url/dashboard/modalidades");
            return true;
        }


        $id = $_POST['id'];
        $directory = 'assets/img/modalities/';

        // Buscando modality no DB para pegar o nome das imagens para remocao
        $Modality = new \Sts\Models\Modality\Read();
        $modality = $Modality->modalityId($id);
        $banner = $modality['banner'];
        $image = $modality['image'];

        // Removendo imagens do diretorio
        unlink($directory . $banner);
        unlink($directory . $image);


        // Excluindo do DB
        $Delete = new \Sts\Models\Modality\Delete();
        $Delete->deleteTimesModality($id);
        $Delete->deleteModality($id);


        $_SESSION['msg'] = 'Modalidade deletada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/modalidades");

        return true;


    }

}