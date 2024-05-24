<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 
require_once(dirname(__FILE__, 2) . '/ImageCreate.php'); 

/**
 * Class UpdateExercise -> Responsável por alterar Exercicio
 */
class UpdateExercise {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;


    /**
     * Funcao para alterar Exercicio
     */
    public function updateExercise($id, $banner, $oldVideo, $checkExternal) {
        $return = "$this->url/dashboard/exercicios/alterar?key=$id";
        $directoryBanner = 'assets/img/exercises/';
        $directoryVideo = 'assets/video/exercises/';

        $name = ucfirst($_POST['name']);
        $category = isset($_POST['category']) ? $_POST['category'] : null;
        $newCategory = ucwords($_POST['new-category']);
        $description = $_POST['description'];
        $video = $_POST['video'];
        $removeVideo = boolval($_POST['remove-video']);
        

        // Checando se campos obrigatorios foram preenchidos
        if(!$name) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $return");
            return true;
        }

        if(!$category && !$newCategory) {
            $_SESSION['msg'] = 'Selecione ou adicione uma categoria!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $return");
            return true;
        }

        // Validando formato do video caso houver
        if($_FILES['video-upload']['name']) {
            $extension = strtolower(substr($_FILES['video-upload']['name'], -4));

            if($extension !== '.mp4') {
                $_SESSION['msg'] = 'Vídeo deve ser em <b>mp4</b>!';
                $_SESSION['msg-type'] = 'error';
                header("Location: $return");
                return true;
            }

            // Validando tamanho do video
            if($_FILES['video-upload']['size'] > 31457280) {
                $_SESSION['msg'] = 'Vídeo deve ter menos de <b>30 MB</b>!';
                $_SESSION['msg-type'] = 'error';
                header("Location: $return");
                return true;
            }
        }
        
        
        // Criando imagem caso enviado
        if($_FILES['banner']['name']) {
            $NewImage = new ImageCreate();
            $banner = $NewImage->newImage($_FILES, $directoryBanner, 'banner', $banner);

            if(!$banner) {
                header("Location: $return");
                return true;
            }
        }

        // Criando nova categoria caso nao tenha sido selecionado uma
        if($newCategory) {
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
            unlink($directoryVideo . $oldVideo);

        } elseif($_FILES['video-upload']['name']) {
            unlink($directoryVideo . $oldVideo);

            // Definindo nome
            $date = date('Y_m_d_H_m_s');
            $videoName = 'exercise' . '_' . $date . $extension;

            // Criando video
            move_uploaded_file($_FILES['video-upload']['tmp_name'], $directoryVideo.$videoName);
            
            $result['video'] = $videoName;
            $result['external'] = false;

        // Removendo video caso setado o remove-video
        } elseif($removeVideo) {
            unlink($directoryVideo . $oldVideo);
            $result['video'] = '';
            $result['external'] = false;

        } elseif($oldVideo) {
            $result['video'] = $oldVideo;
            $result['external'] = $checkExternal;
            
        } else {
            $result['video'] = '';
            $result['external'] = false;
        }


        // Preparando array para enviar ao Model
        $result['banner'] = $banner;
        $result['name'] = $name;
        $result['category'] = $category;
        $result['description'] = $description;
        $result['id'] = $id;

        // Enviando ao Model
        $End = new \Sts\Models\Exercise\Update();
        $End->updateExercise($result);

        $_SESSION['msg'] = 'Exercício alterado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $return");

        return true;
    }
    

    // -------------------- FUNCAO PARA ALTERAR SITUACAO DO EXERCICIO --------------------
    public function updateSituation() {
        $id = $_POST['id'];


        // Buscando situacao do exercicio
        $Exercise = new \Sts\Models\Exercise\Read;
        $exercise = $Exercise->exerciseId($id);
        $situation = $exercise['situation'];

        // Preparando array para enviar ao Model
        $result['id'] = $id;
        $result['situation'] = $situation ? false : true;
        
        // Definindo mensagem de retorno com base na situacao
        $name = $exercise['name'];
        $msg = $situation ? "<b>$name</b> desativado com sucesso!" : "<b>$name</b> ativado com sucesso!";

        // Enviando ao Model
        $End = new \Sts\Models\Exercise\Update();
        $End->updateSituation($result);

        $_SESSION['msg'] = $msg;
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }


    // -------------------- FUNCAO PARA ALTERAR CATEGORIA --------------------
    public function updateCategory() {
        $id = $_POST['id'];
        $name = $_POST['name'];

        if(!isset($id) || !$id) {
            $_SESSION['msg'] = 'Não foi possível alterar categoria!';
            $_SESSION['msg-type'] = 'error';
            header("Location: #");
            return true;
        }

        // Checando se $name foi preenchido
        if(!$name) {
            $_SESSION['msg'] = 'Digite o nome da categoria!';
            $_SESSION['msg-type'] = 'error';
            header("Location: #");
            return true;
        }


        // Preparando array para enviar ao Model
        $result['id'] = $id;
        $result['name'] = ucwords($name);

        // Enviando ao Model
        $End = new \Sts\Models\Exercise\Update();
        $End->updateCategory($result);

        $_SESSION['msg'] = 'Categoria alterada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }
    
} 