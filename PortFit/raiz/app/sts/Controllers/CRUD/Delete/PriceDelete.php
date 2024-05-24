<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 

/**
 * Class DeletePrice -> Responsável por deletar preco
 */
class DeletePrice {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    /**
     * Funcao para Deletar precos
     */
    public function deletePrice() {
        // Retornar error se não encrontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível deletar preço!';
            $_SESSION['msg-type'] = 'error';

            header("Location: $this->url/dashboard/precos");
            return true;
        }

        $id = $_POST['id'];

        // Excluindo do DB
        $Delete = new \Sts\Models\Price\Delete();
        $Delete->deleteSchemesPrice($id);
        $Delete->deletePrice($id);


        $_SESSION['msg'] = 'Preço deletado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/precos");

        return true;
    }

}