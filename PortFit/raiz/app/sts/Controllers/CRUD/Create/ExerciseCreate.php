<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 2) . '/ImageCreate.php');

/**
 * Class CreateExercise -> Responsável por criar Exercicios
 */
class CreateExercise {
    /**
     * @var string $url -> variavel para link inicial do projeto
     */
    private $url = URL;

    /**
     * Funcao para criar exercicio
     */
    public function newExercise() {
        $name = ucfirst($_POST['name']);
        $category = isset($_POST['category']) ? $_POST['category'] : null;
        $newCategory = ucwords($_POST['new-category']);
        $description = $_POST['description'];
        $video = $_POST['video'];

        // Checando se campos obrigatorios foram preenchidos
        if(!$name || !$_FILES['banner']['name']) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/exercicios/adicionar");
            return true;
        }

        if(!$category && !$newCategory) {
            $_SESSION['msg'] = 'Selecione ou adicione uma categoria!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/exercicios/adicionar");
            return true;
        }

        // Validando formato do video caso houver
        if($_FILES['video-upload']['name']) {
            $extension = strtolower(substr($_FILES['video-upload']['name'], -4));

            if($extension !== '.mp4') {
                $_SESSION['msg'] = 'Vídeo deve ser em <b>mp4</b>!';
                $_SESSION['msg-type'] = 'error';
                header("Location: $this->url/dashboard/exercicios/adicionar");
                return true;
            }

            // Validando tamanho do video
            if($_FILES['video-upload']['size'] > 31457280) {
                $_SESSION['msg'] = 'Vídeo deve ter menos de <b>30 MB</b>!';
                $_SESSION['msg-type'] = 'error';
                header("Location: $this->url/dashboard/exercicios/adicionar");
                return true;
            }
        }

        // Criando imagem
        $NewImage = new ImageCreate();
        $directory = 'assets/img/exercises/';
        $banner = $NewImage->newImage($_FILES, $directory, 'banner');

        if(!$banner) {
            header("Location: $this->url/dashboard/exercicios/adicionar");
            return true;
        }

        // Criando nova categoria caso nao tenha sido selecionado uma
        if(!$category) {
            // Checando se nome da categoria ja existe
            $CategoryRead = new \Sts\Models\Exercise\Read();
            $catExists = $CategoryRead->categoryName($newCategory);

            if($catExists) {
                $category = $catExists['id'];

            // Para nova categoria
            } else {
                $CategoryCreate = new \Sts\Models\Exercise\Create();
                $CategoryCreate->createCategory($newCategory);
    
                // buscando id da nova categoria criada
                $category = $CategoryRead->lastCategory();
                $category = $category['id'];
            }
        }

        // Criando video caso houver
        if($video) {
            $result['video'] = $video;
            $result['external'] = true;

        } elseif($_FILES['video-upload']['name']) {
            $directory = 'assets/video/exercises/';

            // Definindo nome
            $date = date('Y_m_d_H_m_s');
            $videoName = 'exercise' . '_' . $date . $extension;

            // Criando video
            move_uploaded_file($_FILES['video-upload']['tmp_name'], $directory.$videoName);
            
            $result['video'] = $videoName;
            $result['external'] = false;

        } else {
            $result['video'] = '';
            $result['external'] = false;
        }


        // Preparando array para enviar ao Model
        $result['banner'] = $banner;
        $result['name'] = $name;
        $result['category'] = $category;
        $result['description'] = $description;
        $result['situation'] = true;

        // Enviando ao Model
        $End = new \Sts\Models\Exercise\Create();
        $End->createExercise($result);

        $_SESSION['msg'] = 'Exercício salvo com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/exercicios");

        return true;
    }
    
}