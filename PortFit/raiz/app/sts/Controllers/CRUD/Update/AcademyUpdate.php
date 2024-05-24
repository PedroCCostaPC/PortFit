<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 
require_once(dirname(__FILE__, 2) . '/ImageCreate.php'); 

/**
 * Class UpdateAcademy -> Responsável por alterar informacoes da academia
 */
class UpdateAcademy {
    /**
     * @var string $url -> variavel para link inicial do projeto
     */
    private $url = URL;


    /**
     * Funcao para alterar unidade
     */
    public function updateUnit($id) {
        $address = $_POST['address'];
        $road = $_POST['road'];
        $number = $_POST['number'];
        $cep = $_POST['cep'];
        $state = $_POST['state'];
        $uf = $_POST['uf'];
        $map = $_POST['map'];

        // Buscando nome do banner
        $AcademyClass = new \Sts\Models\Academy\Read();
        $imgPrevious = $AcademyClass->academyId($id);
        $oldName = $imgPrevious['banner'];


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
            $banner = $NewImage->newImage($_FILES, $directory, 'banner', "$this->url/dashboard/academia", $oldName);

            if(!$banner) {
                header("Location: $this->url/dashboard/academia");
                return true;
            }
        }

        

        // Montando Array para eniar ao Model
        $result['id'] = $id;
        $result['address'] = $address;
        $result['road'] = $road;
        $result['number'] = $number;
        $result['cep'] = $cep;
        $result['state'] = $state;
        $result['uf'] = strtoupper($uf);
        $result['map'] = $map;
        $result['banner'] = isset($banner) ? $banner : $oldName;


    
        // Enviando ao Model
        $End = new \Sts\Models\Academy\Update();
        $End->updateAcademy($result);

        $_SESSION['msg'] = 'Endereço alterado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/academia");

        return true;
    }


    // -------------------- FUNCAO PARA ALTERAR CONTATO --------------------
    /**
     * Funcao para alterar contato
     */
    public function updateContact() {
        $id = $_POST['contact-id'];
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
        $result['id'] = $id;
        $result['ddd'] = $ddd ? $ddd : null;
        $result['phone'] = $phone ? $phone : null;
        $result['dddSapp'] = $dddSapp ? $dddSapp : null;
        $result['whatsapp'] = $whatsapp ? $whatsapp : null;
        $result['email'] = $email ? $email : null;

        // Enviando ao Model
        $End = new \Sts\Models\Academy\Update();
        $End->updateContact($result);

        $_SESSION['msg'] = 'Contato alterado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/academia");

        return true;
    }


    // -------------------- FUNCAO PARA ALTERAR HORARIOS --------------------
    /**
     * Funcao para alterar horarios
     */
    public function updateTime($id) {

        $openHourWeek = $_POST['openHourWeek'];
        $openMinuteWeek = $_POST['openMinuteWeek'];
        $closeHourWeek = $_POST['closeHourWeek'];
        $closeMinuteWeek = $_POST['closeMinuteWeek'];

        $openHourHoliday = $_POST['openHourHoliday'];
        $openMinuteHoliday = $_POST['openMinuteHoliday'];
        $closeHourHoliday = $_POST['closeHourHoliday'];
        $closeMinuteHoliday = $_POST['closeMinuteHoliday'];

        $openHourSaturday = $_POST['openHourSaturday'];
        $openMinuteSaturday = $_POST['openMinuteSaturday'];
        $closeHourSaturday = $_POST['closeHourSaturday'];
        $closeMinuteSaturday = $_POST['closeMinuteSaturday'];

        $openHourSunday = $_POST['openHourSunday'];
        $openMinuteSunday = $_POST['openMinuteSunday'];
        $closeHourSunday = $_POST['closeHourSunday'];
        $closeMinuteSunday = $_POST['closeMinuteSunday'];


        // Funcao para montar os horarios
        function assemble($openHour, $openMinute, $closeHour, $closeMinute) {
            // Monta horario somente se openHour foi preenchido
            if($openHour || $openHour == 0) {
                $openHour = intval($openHour);
                $openMinute = intval($openMinute);
                $closeHour = intval($closeHour);
                $closeMinute = intval($closeMinute);

                $result['open'] = date("$openHour:$openMinute");
                $result['close'] = date("$closeHour:$closeMinute");

            } else {
                $result['open'] = null;
                $result['close'] = null;
            }
            
            return $result;
        }

        $week = assemble($openHourWeek, $openMinuteWeek, $closeHourWeek, $closeMinuteWeek);
        $holiday = assemble($openHourHoliday, $openMinuteHoliday, $closeHourHoliday, $closeMinuteHoliday);
        $saturday = assemble($openHourSaturday, $openMinuteSaturday, $closeHourSaturday, $closeMinuteSaturday);
        $sunday = assemble($openHourSunday, $openMinuteSunday, $closeHourSunday, $closeMinuteSunday);


        // Montando Array para enviar ao Model
        $result['id'] = $id;
        $result['openWeek'] = $week['open'];
        $result['closeWeek'] = $week['close'];
        $result['openHoliday'] = $holiday['open'];
        $result['closeHoliday'] = $holiday['close'];
        $result['openSaturday'] = $saturday['open'];
        $result['closeSaturday'] = $saturday['close'];
        $result['openSunday'] = $sunday['open'];
        $result['closeSunday'] = $sunday['close'];

        // Enviando ao Model
        $End = new \Sts\Models\Academy\Update();
        $End->updateTime($result);

        $_SESSION['msg'] = 'Horário alterado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/academia");

        return true;
    }


    // -------------------- FUNCAO PARA ALTERAR REDE SOCIAL --------------------
    /**
     * Funcao para alterar rede social
     */
    public function updateSocial() {
        $id = $_POST['id'];
        $name = ucwords($_POST['name']);
        $link = $_POST['link'];

        // Checando se dados obrigatorios foram preenchidos
        if(!$name || !$link) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios';
            $_SESSION['msg-type'] = 'error';

            header("Location: $this->url/dashboard/academia");
            return true;
        }

        // Buscando nome antigo do icone da rede social
        $Social = new \Sts\Models\Social\Read();
        $oldName = $Social->socialId($id);
        $oldName = $oldName['icon'];


        // Criando nova imagem
        if($_FILES['icon']['name']) {
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
    
            // Deletando foto antiga
            unlink($directory . $oldName);
    
            // Definindo nome
            $date = date('Y_m_d_H_m_s');
            $imgName = 'social_' . $date . $extension;
    
            move_uploaded_file($_FILES['icon']['tmp_name'], $directory.$imgName);

        } else {
            $imgName = $oldName;
        }


        // Preparando array para envio ao Model
        $result['id'] = $id;
        $result['name'] = $name;
        $result['icon'] = $imgName;
        $result['link'] = $link;

        // Enviando ao Model
        $End = new \Sts\Models\Social\Update();
        $End->updateSocial($result);

        $_SESSION['msg'] = 'Rede Social alterada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/academia");

        return true;

    }

}