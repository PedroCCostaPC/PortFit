<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 2) . '/ImageCreate.php');


/**
 * Class CreateModality -> Responsável por criar Modalidades
 */
class CreateModality {
    /**
     * $url -> variavel para link inicial do projeto
     *
     * @var string
     */
    private $url = URL;

    /**
     * Funcao para criar modalidade
     */
    public function newModality() {
        $name = ucwords($_POST['name']);
        $summary = $_POST['summary'];
        $phrase = $_POST['phrase'];
        $about = $_POST['about'];
        $whyte = $_POST['whyte'];

        // Checando se campos foram preenchidos
        if(!$name || !$summary || !$phrase || !$about || !$whyte || !$_FILES['banner']['name'] || !$_FILES['image']['name']) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/modalidades/adicionar");
            return true;
        }


        // Checando Extensao das imagens
        $extensionBanner = strtolower(substr($_FILES['banner']['name'], -4));
        $extensionImage = strtolower(substr($_FILES['image']['name'], -4));

        // Validando se é png ou jpg
        if($extensionBanner !== '.jpg' && $extensionBanner !== '.png') {
            $_SESSION['msg'] = 'Banner deve ser <b>jpg</b> ou <b>png</b>';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/modalidades/adicionar");
            return true;
        }
        if($extensionImage !== '.jpg' && $extensionImage !== '.png') {
            $_SESSION['msg'] = 'Imagem deve ser <b>jpg</b> ou <b>png</b>';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/modalidades/adicionar");
            return true;
        }


        // Criando banner e imagem
        $NewImage = new ImageCreate();
        $directory = 'assets/img/modalities/';
        $banner = $NewImage->newImage($_FILES, $directory, 'banner');
        $image = $NewImage->newImage($_FILES, $directory, 'image');


        // preparando array para enviar ao Model
        $result['name'] = $name;
        $result['summary'] = $summary;
        $result['phrase'] = $phrase;
        $result['about'] = $about;
        $result['whyte'] = $whyte;
        $result['banner'] = $banner;
        $result['image'] = $image;
        $result['situation'] = true;


        // Enviando ao Model
        $End = new \Sts\Models\Modality\Create();
        $End->createModality($result);

        $_SESSION['msg'] = 'Modalide salva com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/modalidades");

        return true;
    }
    
}