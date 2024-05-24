<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');


/**
 * Class CreateComment -> Responsável por criar Comentario de post
 */
class CreateComment {
    /**
     * @var string $url -> variavel para link inicial do projeto
     */
    private $url = URL;
    
    /**
     * Funcao para criar comentario de post
     */
    public function newComment($postId) {
        $return = "$this->url/blog/post?key=$postId";


        // POST
        $name = ucwords($_POST['name']);
        $email = $_POST['email'];
        $comment = $_POST['comment'];


        // Checando se campos obrigatorios foram preenchidos
        if(!$name || !$email || !$comment) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $return");
            return true;
        }


        // Validando E-Mail
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg'] = 'E-Mail inválido!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $return");
            return true;
        }


        // Pegando data e hora de envio do email
        $date = date('Y-m-d');


        // Preparando array para enviar ao Model
        $result['name'] = $name;
        $result['email'] = $email;
        $result['comment'] = $comment;
        $result['date'] = $date;
        $result['blog_id'] = $postId;


        // Enviando ao Model
         $End = new \Sts\Models\Blog\Create();
         $End->createComment($result);

        // Finalizando
        $_SESSION['msg'] = "Comentário enviado com sucesso!";
        $_SESSION['msg-type'] = 'success';
        header("Location: $return");

        return true;

    }
}
    
    