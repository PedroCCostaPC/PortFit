<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 
require_once(dirname(__FILE__, 2) . '/ImageCreate.php'); 
require_once(dirname(__FILE__, 5) . '/functions/PhoneValidateFunction.php'); 

/**
 * Class CreateAcademy -> Responsável por criar informacoes da academia
 */
class CreateAcademy {
    /**
     * @var string $url -> variavel para link inicial do projeto
     */
    private $url = URL;

    /**
     * Funcao para criar unidade
     * Recebe $main -> Boolean
     * True: para endereco da academia principal
     * False: para endereco de unidades
     */
    public function newUnit($main) {
        $headquarters = $main; 
        $address = $_POST['address'];
        $road = $_POST['road'];
        $number = $_POST['number'];
        $cep = $_POST['cep'];
        $state = $_POST['state'];
        $uf = $_POST['uf'];
        $map = $_POST['map'];


        // Validando CEP
        if($cep) {
            if(strlen($cep) < 8 || strlen($cep) > 9) {
                $_SESSION['msg'] = 'CEP inválido!';
                $_SESSION['msg-type'] = 'error';
                header("Location: $this->url/dashboard/academia");

                return true;
            }
        }

        // Colocando '-' no meio do cep caso tenha 8 digitos
        if(strlen($cep) === 8) {
            $back = substr($cep, -3);
            $front = substr($cep, 0, 5);

            $cep = $front . '-' . $back;
        }


        // Criando Imagem
        if($_FILES['banner']['name']) {
            $NewImage = new ImageCreate();
            $directory = 'assets/img/academy/';
            $banner = $NewImage->newImage($_FILES, $directory, 'banner');

            if(!$banner) {
                header("Location: $this->url/dashboard/academia");
                return true;
            }

        } else {
            $banner = null;
        }


        // Montando Array para eniar ao Model
        $result['headquarters'] = $headquarters;
        $result['address'] = $address;
        $result['road'] = $road;
        $result['number'] = $number;
        $result['cep'] = $cep;
        $result['state'] = $state;
        $result['uf'] = strtoupper($uf);
        $result['map'] = $map;
        $result['banner'] = $banner;

    
        // Enviando ao Model
        $End = new \Sts\Models\Academy\Create();
        $End->createUnit($result);

        $_SESSION['msg'] = 'Endereço salvo com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/academia");

        return true;
    }


    // -------------------- FUNCAO PARA CRIAR CONTATO --------------------
    /**
     * Funcao para criar contato
     */
    public function newContact($academyId) {
        $ddd = $_POST['ddd'];
        $phone = $_POST['phone'];
        $dddSapp = $_POST['dddSapp'];
        $whatsapp = $_POST['whatsapp'];
        $email = $_POST['email'];


        // Validando DDD e telefone
        if(checkPhone($ddd, $phone)) {
            header("Location: $this->url/dashboard/academia");
            return true;
        }

        // Validando DDD e WhatsApp
        if(checkPhone($dddSapp, $whatsapp)) {
            header("Location: $this->url/dashboard/academia");
            return true;
        }

        // Validando email
        if($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg'] = 'E-Mail inválido!';
            $_SESSION['msg-type'] = 'error';

            header("Location: $this->url/dashboard/academia");
            return true;
        }


        // Montando Array para enviar ao Model
        $result['ddd'] = $ddd ? $ddd : null;
        $result['phone'] = $phone ? $phone : null;
        $result['dddSapp'] = $dddSapp ? $dddSapp : null;
        $result['whatsapp'] = $whatsapp ? $whatsapp : null;
        $result['email'] = $email ? $email : null;
        $result['unit_id'] = $academyId;


        // Enviando ao Model
        $End = new \Sts\Models\Academy\Create();
        $End->createContact($result);

        $_SESSION['msg'] = 'Contato salvo com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/academia");

        return true;
    }


    // -------------------- FUNCAO PARA CRIAR FOTOS --------------------
    /**
     * Funcao para criar fotos
     */
    public function newPhotos($academyId) {
        // Verificando se alguma foto foi selecionada
        if(!$_FILES['photos']['name'][0]) {
            $_SESSION['msg'] = 'Selecione pelo menos uma foto!';
            $_SESSION['msg-type'] = 'error';

            header("Location: $this->url/dashboard/academia");
            return true;
        
        } else {
            // Validando extensão de todas imagens antes de chamar a funcao de criar imagem
            foreach($_FILES['photos']['name'] as $photo) {
                $extension = strtolower(substr($photo, -4));
                if($extension !== '.jpg' && $extension !== '.png') {
                    $_SESSION['msg'] = 'Imagens deve ser <b>jpg</b> ou <b>png</b>!';
                    $_SESSION['msg-type'] = 'error';

                    header("Location: $this->url/dashboard/academia");
                    return true;
                }
            }

            
            // Criando imagens
            for($i = 0; $i < count($_FILES['photos']['name']); $i++) {
                // Definindo Extensao e diretorio
                $extension = strtolower(substr($_FILES['photos']['name'][$i], -4));
                $directory = 'assets/img/academy/';

                // Definindo nome
                $date = date('Y_m_d_H_m_s');
                $name = 'photo' . $i . '_' . $date . $extension;

                move_uploaded_file($_FILES['photos']['tmp_name'][$i], $directory.$name);

                // Montando array com nome das fotos
                $result[$i] = $name;
                
            }

            // Enviando ao Model
            $End = new \Sts\Models\Academy\Create();

            foreach($result as $finish) {
                $End->createPhoto($finish, $academyId);
            }

            $_SESSION['msg'] = 'Fotos salvas com sucesso!';
            $_SESSION['msg-type'] = 'success';
            header("Location: $this->url/dashboard/academia");

            return true;
        }
    }


    // -------------------- FUNCAO PARA CRIAR REDE SOCIAL --------------------
    /**
     * Funcao para criar Rede social
     */
    public function newSocial($academyId) {
        $name = ucwords($_POST['name']);
        $link = $_POST['link'];


        // Checando se dados obrigatorios foram preenchidos
        if(!$name || !$link || !$_FILES['icon']['name']) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios';
            $_SESSION['msg-type'] = 'error';

            header("Location: $this->url/dashboard/academia");
            return true;
        }


        // Criando imagem
        // Definindo Extensao e diretorio
        $extension = strtolower(substr($_FILES['icon']['name'], -4));
        $directory = 'assets/img/social/';

        // Validando se é png
        if($extension !== '.png') {
            $_SESSION['msg'] = 'Imagem deve ser <b>png</b>';
            $_SESSION['msg-type'] = 'error';

            header("Location: $this->url/dashboard/academia");
            return true;
        }


        // Definindo nome
        $date = date('Y_m_d_H_m_s');
        $imgName = 'social_' . $date . $extension;

        move_uploaded_file($_FILES['icon']['tmp_name'], $directory.$imgName);



        // Preparando array para envio ao Model
        $result['name'] = $name;
        $result['icon'] = $imgName;
        $result['link'] = $link;
        $result['unit_id'] =$academyId;


        // Enviando ao Model
        $End = new \Sts\Models\Social\Create();
        $End->createSocial($result);

        $_SESSION['msg'] = 'Rede Social salva com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/academia");

        return true;
    }
}