<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 

/**
 * Class DeleteEmployee -> Responsável por deletar preco
 */
class DeleteEmployee {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    /**
     * Funcao para Deletar funcionario
     */
    public function deleteEmployee() {
        // Retornar error se não encrontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível remover funcionário!';
            $_SESSION['msg-type'] = 'error';

            header("Location: #");
            return true;
        }

        $id = $_POST['id'];
        $directoryPhoto = 'assets/img/employees/';
        $directoryBlog = 'assets/img/blog/';

        // Removendo foto do aluno no diretorio
        $Employee = new sts\Models\Employee\Read();
        $employee = $Employee->employeeId($id);
        $photo = $employee['photo'];

        if($photo) unlink($directoryPhoto . $photo);


        // Buscando posts do blog criado pelo funcionario
        $Blog = new \Sts\Models\Blog\Read();
        $blog = $Blog->AllBlogEmployee($id);


        // Excluindo do DB
        $DeleteBlog = new \Sts\Models\Blog\Delete;
        $Delete = new \Sts\Models\Employee\Delete;

        // Deletando todos comentarios dos post do blog criado pelo funcionario
        foreach($blog as $i) {
            unlink($directoryBlog . $i['banner']);
            $DeleteBlog->deleteAllCommentPost($i['id']);
        }
        // Deletando todos os post do blog criado pelo funcionario
        $DeleteBlog->deleteBlogEmployee($id);
        // Deletando funcionario
        $Delete->deleteEmployee($id);


        $_SESSION['msg'] = 'Funcionário removido com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }

}