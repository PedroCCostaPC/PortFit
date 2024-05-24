<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 

/**
 * Class DeleteStudent -> Responsável por deletar preco
 */
class DeleteStudent {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    /**
     * Funcao para Deletar aluno
     */
    public function deleteStudent() {
        // Retornar error se não encrontrar $_POST['id']
        if(!isset($_POST['id'])) {
            $_SESSION['msg'] = 'Não foi possível remover aluno!';
            $_SESSION['msg-type'] = 'error';

            header("Location: #");
            return true;
        }

        $id = $_POST['id'];
        $directoryPhoto = 'assets/img/students/';

        // Removendo foto do aluno no diretorio
        $Student = new sts\Models\Student\Read();
        $student = $Student->studentId($id);
        $photo = $student['photo'];

        if($photo) unlink($directoryPhoto . $photo);


        // Excluindo do DB
        $DeleteTraining = new \Sts\Models\Training\Delete;
        $DeleteFood = new \Sts\Models\Food\Delete;
        $DeleteSupplement = new \Sts\Models\Supplement\Delete;
        $DeleteExam = new \Sts\Models\Exam\Delete;
        $Delete = new \Sts\Models\Student\Delete;

        $DeleteTraining->deleteAllTrainingFull($id);
        $DeleteFood->deleteAllFoodFull($id);
        $DeleteSupplement->deleteAllSupplementFull($id);
        $DeleteExam->deleteAllExam($id);
        $Delete->deleteStudent($id);


        $_SESSION['msg'] = 'Aluno removido com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }

}