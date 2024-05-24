<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 
require_once(dirname(__FILE__, 2) . '/ImageCreate.php'); 


/**
 * Class UpdateModality -> Responsável por alterar Modalidades
 */
class UpdateModality {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    /**
     * Funcao para alterar modalidade
     */
    public function updateModality($id) {
        $name = ucwords($_POST['name']);
        $summary = $_POST['summary'];
        $phrase = $_POST['phrase'];
        $about = $_POST['about'];
        $whyte = $_POST['whyte'];

        $directory = 'assets/img/modalities/';
        $return = "$this->url/dashboard/modalidades/alterar?key=$id&day=1";
        
        // Checando se campos foram preenchidos
        if(!$name || !$summary || !$phrase || !$about || !$whyte) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location: $return");
            return true;
        }

        // Checando extencao do banner e imagem
        if($_FILES['banner']['name']) {
            $extension = strtolower(substr($_FILES['banner']['name'], -4));
            if($extension !== '.jpg' && $extension !== '.png') {
                $_SESSION['msg'] = 'Banner deve ser <b>jpg</b> ou <b>png</b>';
                $_SESSION['msg-type'] = 'error';
                header("Location: $return");
                return true;
            }
        }
        if($_FILES['image']['name']) {
            $extension = strtolower(substr($_FILES['image']['name'], -4));
            if($extension !== '.jpg' && $extension !== '.png') {
                $_SESSION['msg'] = 'Imagem deve ser <b>jpg</b> ou <b>png</b>';
                $_SESSION['msg-type'] = 'error';
                header("Location: $return");
                return true;
            }
        }


        // Buscando nome antigo do banner e imagem da modalidade
        $Modality = new \Sts\Models\Modality\Read();
        $modality = $Modality->modalityId($id);
        $banner = $modality['banner'];
        $image = $modality['image'];

        // Criando banner e imagem caso mande
        if($_FILES['banner']['name']) {
            $NewImage = new ImageCreate();
            $banner = $NewImage->newImage($_FILES, $directory, 'banner', $banner);
        }

        if($_FILES['image']['name']) {
            $NewImage = new ImageCreate();
            $image = $NewImage->newImage($_FILES, $directory, 'image', $image);
        }


        // preparando array para enviar ao Model
        $result['id'] = $id;
        $result['name'] = $name;
        $result['summary'] = $summary;
        $result['phrase'] = $phrase;
        $result['about'] = $about;
        $result['whyte'] = $whyte;
        $result['banner'] = $banner;
        $result['image'] = $image;


        // Enviando ao Model
        $End = new \Sts\Models\Modality\Update();
        $End->updateModality($result);

        $_SESSION['msg'] = "$name alterado com sucesso!";
        $_SESSION['msg-type'] = 'success';
        header("Location: $return");

        return true;
    }
    

    // -------------------- FUNCAO PARA ALTERAR SITUACAO DA MODALIDADE --------------------
    public function updateSituation() {
        $id = $_POST['id'];

        // Buscando situacao da modalidade
        $Modality = new \Sts\Models\Modality\Read;
        $modality = $Modality->modalityId($id);
        $situation = $modality['situation'];

        // Preparando array para enviar ao Model
        $result['id'] = $id;
        $result['situation'] = $situation ? false : true;
        
        // Definindo mensagem de retorno com base na situacao
        $name = $modality['name'];
        $msg = $situation ? "$name desativado com sucesso!" : "$name ativado com sucesso!";

        // Enviando ao Model
        $End = new \Sts\Models\Modality\Update();
        $End->updateSituation($result);

        $_SESSION['msg'] = $msg;
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/modalidades");

        return true;
    }

    // -------------------- FUNCAO PARA ALTERAR HORARIOS DA MODALIDADE --------------------
    public function updateTime($day, $modality) {
        /**
         * Separando horarios do post que possui ID dos que no possuem
         * POSSUI ID -> horarios que ja estavam registrado no banco
         * NAO POSSUI ID - > horarios novos que foram inseridos no form
         */
        if(isset($_POST['open-hour'])) {
            for($i = 0; $i < count($_POST['open-hour']); $i++) {
                // Horarios com ID
                if(isset($_POST['id'][$i])) {
                    $oldTime['id'][$i] = $_POST['id'][$i];
                    $oldTime['open-hour'][$i] = intval($_POST['open-hour'][$i]);
                    $oldTime['open-minute'][$i] = $_POST['open-minute'][$i];
                    $oldTime['close-hour'][$i] = $_POST['close-hour'][$i];
                    $oldTime['close-minute'][$i] = $_POST['close-minute'][$i];
    
                    $timeComparison[$i] = $_POST['id'][$i];
    
                // Horarios sem ID
                } else {
                    $newTime['open-hour'][$i] = $_POST['open-hour'][$i];
                    $newTime['open-minute'][$i] = $_POST['open-minute'][$i];
                    $newTime['close-hour'][$i] = $_POST['close-hour'][$i];
                    $newTime['close-minute'][$i] = $_POST['close-minute'][$i];
                }
            }
        }


        // Buscando horarios no banco para comparacao
        // O que for diferente sera removido do banco
        $TimeDB = new \Sts\Models\Modality\Read();
        $TimeDB = $TimeDB->time($modality, $day);

        for($i = 0; $i < count($TimeDB);  $i++) {
            $TimeDB[$i] = $TimeDB[$i]['id'];
        }

        if(isset($timeComparison)) $trashTime = array_diff($TimeDB, $timeComparison);


        // Excluir horarios antigos do DB
        if(!isset($trashTime)) {
            // EXCLUIR TODOS ANTIGOS
            foreach($TimeDB as $id) {
                $Delete = new \Sts\Models\Modality\Delete();
                $Delete->deleteTime($id);
            }

        } elseif($trashTime) {
            // Excluir somente os que nao retornaram
            foreach($trashTime as $id) {
                $Delete = new \Sts\Models\Modality\Delete();
                $Delete->deleteTime($id);
            }
        }


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

        // Alterar os horarios antigos que retornaram
        if(isset($timeComparison)) {
            for($i = 0; $i < count($oldTime['open-hour']); $i++) {
                $updateTime[$i] = assemble($oldTime['open-hour'][$i], $oldTime['open-minute'][$i], $oldTime['close-hour'][$i], $oldTime['close-minute'][$i]);
                $updateTime[$i]['id'] = $oldTime['id'][$i];
            }

            foreach($updateTime as $time) {
                $Update = new \Sts\Models\Modality\Update();
                $Update->updateTime($time);
            }
        }



        // Novo horario caso houver
        if(isset($newTime)) {
            // Preparando horarios  
            $newTime['open-hour'] = array_values($newTime['open-hour']);
            $newTime['open-minute'] = array_values($newTime['open-minute']);
            $newTime['close-hour'] = array_values($newTime['close-hour']);
            $newTime['close-minute'] = array_values($newTime['close-minute']);

            for($i = 0; $i < count($newTime['open-hour']); $i++) {
                $time[$i] = assemble($newTime['open-hour'][$i], $newTime['open-minute'][$i], $newTime['close-hour'][$i], $newTime['close-minute'][$i]);
            }

            // preparando array para enviar ao Model
            for($i = 0; $i < count($newTime['open-hour']); $i++) {
                if($time[$i]['open']) {
                    $result[$i] = $time[$i];
                }
            }

            // Enviado ao Model caso tenho novo horario para criar
            if(isset($result)) {
                $End = new \Sts\Models\Modality\Create();
                foreach($result as $create) {
                    $End->createTime($create, $day, $modality);
                }
            }
        }


        $_SESSION['msg'] = 'Horário alterado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/modalidades/alterar?key=$modality&day=$day");

        return true;
    }
    
} 