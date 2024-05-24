<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 2) . '/ImageCreate.php');


/**
 * Class CreateBlog -> Responsável por criar blog
 */
class CreateBlog {
    /**
     * @var string $url -> variavel para link inicial do projeto
     */
    private $url = URL;

    /**
     * Funcao para criar blog
     */
    public function newBlog() {
        $title = ucfirst($_POST['title']);
        $category = isset($_POST['category']) ? $_POST['category'] : null;
        $newCategory = ucwords($_POST['new-category']);
        $post = $_POST['post'];


        // Checando se campos obrigatorios foram preenchidos
        if(!$title || !$_FILES['blog']['name'] || !$post) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/blog/adicionar");
            return true;
        }


        if(!$category && !$newCategory) {
            $_SESSION['msg'] = 'Selecione ou adicione uma categoria!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/blog/adicionar");
            return true;
        }


        // Criando imagem
        $NewImage = new ImageCreate();
        $directory = 'assets/img/blog/';
        $banner = $NewImage->newImage($_FILES, $directory, 'blog');

        if(!$banner) {
            header("Location: $this->url/dashboard/blog/adicionar");
            return true;
        }


        // Criando nova categoria caso nao tenha sido selecionado uma
        if(!$category) {
            // Checando se nome da categoria ja existe
            $CategoryRead = new \Sts\Models\Blog\Read();
            $catExists = $CategoryRead->categoryBlogName($newCategory);

            if($catExists) {
                $category = $catExists['id'];

            // Para nova categoria
            } else {
                $CategoryCreate = new \Sts\Models\Blog\Create();
                $CategoryCreate->createCategory($newCategory);
    
                // buscando id da nova categoria criada
                $category = $CategoryRead->lastCategory();
                $category = $category['id'];
            }
        }


        // Preparando array para enviar ao Model
        $result['title'] = $title;
        $result['published'] = date('Y-m-d');
        $result['banner'] = $banner;
        $result['post'] = $post;
        $result['views'] = 0;
        $result['situation'] = true;
        $result['employee_id'] = $_SESSION['employee']['id'];
        $result['category_id'] = $category;
        $result['send_email'] = true;


        // Enviando ao Model
        $End = new \Sts\Models\Blog\Create();
        $End->createBlog($result);

        $_SESSION['msg'] = 'Post publicado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/blog");

        return true;
    }



    // ---------------- FUNCAO PARA DISPARAR E-MAIL ----------------
    /**
     * Funcao para disparar email do post do blog
     */
    public function shootEmail($id) {
        $Blog = new \Sts\Models\Blog\Read();
        $post = $Blog->blogIdSendEmail($id);

        if(!$post) {
            $_SESSION['msg'] = 'Não foi pssível disparar E-Mails!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  #");
            return true;
        }

        // Buscando alunos
        $Student = new \Sts\Models\Student\Read();
        $students = $Student->studentSendEmail();
        


        // Preparando variaveis para envio de email
        $banner = $post['banner'];
        $banner = "$this->url/assets/img/blog/$banner";
        $postText = $post['post'];



        // Enviando senha para email do aluno
        $title = $post['title'];

        /**
         * @var $Text -> Recebe a funcao create() da Classe PostEmail()
         * Responsavel pelo conteudo do email
         * Diretorio da Classe: app/sts/Views/email/PostEmail.php
         */
        $Text = new PostEmail();

        foreach($students as $student) {
            echo $student['name'] . '<br>';
            echo $student['email'] . '<br>';
            $text = $Text->create($id, $student['name'], $banner, $postText);


            /**
         * @function sendEmail -> Responsavel pelo envio de email
         * Recebe 5 parametros
         * 1 - Email do destinatario ($email)
         * 2 - Nome do destinatario ($student['name'])
         * 3 - Titulo do email ($title)
         * 4 - e o conteudo ($text)
         * 5 - Boolean (Opcional) - true para o nome do usuario no email, false ou null para nome da academia no email
         * 
         * Diretorio da funcao: core/ConfigEmail.php
         */
        sendEmail($student['email'], $student['name'], $title, $text);
        }


        // Preparando array para enviar ao Model
        $result['send_email'] = false;
        $result['id'] = $id;

        // Enviando ao Model
        $End = new \Sts\Models\Blog\Update();
        $End->updateSendEmail($result);


        // Finalizando
        $_SESSION['msg'] = 'E-Mail disparado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }
    
}