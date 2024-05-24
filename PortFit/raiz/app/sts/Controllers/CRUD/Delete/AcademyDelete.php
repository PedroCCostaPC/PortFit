<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 

/**
 * Class DeleteAcademy -> Responsável por deletar informacoes da academia
 */
class DeleteAcademy {
    /**
     * $url -> variavel para link inicial do projeto
     *
     * @var string
     */
    private $url = URL;

    /**
     * Funcao para Deletar fotos
     */
    public function deletePhoto() {
        // Retornar error se não encrontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível deletar foto!';
            $_SESSION['msg-type'] = 'error';

            header("Location: $this->url/dashboard/academia");
            return true;
        }


        $id = $_POST['id'];
        $directory = 'assets/img/academy/';

        $Photo = new \Sts\Models\Academy\Read();
        $name = $Photo->photoId($id);
        $name = $name['name'];

        // Excluindo foto da pasta
        unlink($directory . $name);

        // Enviando ao Model para excluir nome do banco
        $Delete = new \Sts\Models\Academy\Delete();
        $Delete->deletePhoto($id);

        $_SESSION['msg'] = 'Foto deletada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/academia");

        return true;
    }


    // -------------------- FUNCAO PARA DELETAR REDE SOCIAL --------------------
    /**
     * Funcao para excluir rede social
     */
    public function deleteSocial() {
        // Retornar error se não encrontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível deletar rede social!';
            $_SESSION['msg-type'] = 'error';

            header("Location: $this->url/dashboard/academia");
            return true;
        }

        $id = $_POST['id'];
        $directory = 'assets/img/social/';

        $icon = new \Sts\Models\Social\Read();
        $icon = $icon->socialId($id);
        $icon = $icon['icon'];

        // Excluindo icone da pasta
        unlink($directory . $icon);

        // Enviando ao Model para excluir nome do banco
        $Delete = new \Sts\Models\Social\Delete();
        $Delete->deleteSocial($id);

        $_SESSION['msg'] = 'Rede Social deletada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/academia");

        return true;
    }

}