<?php
namespace Sts\Controllers\Dashboard\Modalidades;

use UpdateModality;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 3) . '/CRUD/Update/ModalityUpdate.php');



/**
 * Controller da página dashboard -> alterar modalidade
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Alterar {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    /**
    * @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     *Instanciar a classe responsável em carregar a View
     * @return void
     */

    public function index() {
        // Retornando a pagina de modalidades caso nao tenha $_GET['key']
        if(!isset($_GET['key'])) {
            header("Location: $this->url/dashboard/modalidades");
            return;
        }

        // Buscando modalidade
        $Modality = new \Sts\Models\Modality\Read();
        $modality = $Modality->modalityId($_GET['key']);

        // Retornando a pagina de modalidades caso nao ache modalidade ou $_GET['day']
        if(!$modality || !isset($_GET['day'])){
            header("Location: $this->url/dashboard/modalidades");
            return;
        }

        // Validando $_GET['day']
        if($_GET['day'] < 0 || $_GET['day'] > 6) {
            header("Location: $this->url/dashboard/modalidades");
            return;
        }

        // Buscando horarios da modalidade e dia
        $allTime = $Modality->time($modality['id'], $_GET['day']);
        for($i = 0; $i < count($allTime); $i++) {
            $time[$i]['id'] = $allTime[$i]['id'];
            $time[$i]['open-hour'] = $this->timeForm($allTime[$i]['open'], 0);
            $time[$i]['open-minute'] = $this->timeForm($allTime[$i]['open'], 1);
            $time[$i]['close-hour'] = $this->timeForm($allTime[$i]['close'], 0);
            $time[$i]['close-minute'] = $this->timeForm($allTime[$i]['close'], 1);
        }

        $this->data = $modality;


        // Pegando quantidade de horarios em um dia da semana
        // Domingo
        $day = $Modality->timeCount($_GET['key'], 0);
        $this->data['count-sunday'] = $day[0] ? $day[0] : null;
        // Segunda feira
        $day = $Modality->timeCount($_GET['key'], 1);
        $this->data['count-monday'] = $day[0] ? $day[0] : null;
        // Terça feira
        $day = $Modality->timeCount($_GET['key'], 2);
        $this->data['count-tuesday'] = $day[0] ? $day[0] : null;
        // Quarta feira
        $day = $Modality->timeCount($_GET['key'], 3);
        $this->data['count-wednesday'] = $day[0] ? $day[0] : null;
        // Quinta feira
        $day = $Modality->timeCount($_GET['key'], 4);
        $this->data['count-thursday'] = $day[0] ? $day[0] : null;
        // Sexta feira
        $day = $Modality->timeCount($_GET['key'], 5);
        $this->data['count-friday'] = $day[0] ? $day[0] : null;
        // Sabado
        $day = $Modality->timeCount($_GET['key'], 6);
        $this->data['count-saturday'] = $day[0] ? $day[0] : null;

        
        // Pegando horarios 
        $this->data['time'] = isset($time) ? $time : [];

        // Formatando dia da semana
        $week = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];

        $this->data['day-format'] = $week[$_GET['day']];


        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;


        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Form para alterar modalidade
        if(isset($_POST['update-modality'])) {
            $Update = new UpdateModality();
            // Retorna para pagina 'alterarModalidade' caso form sucesso
            $return = $Update->updateModality($modality['id']);
            if($return) {
                return $this->data;
            }
        }

        // Form para alterar horario
        if(isset($_POST['update-time'])) {
            $Update = new UpdateModality();
            // Retorna para pagina 'alterarModalidade' caso form sucesso
            $return = $Update->updateTime($_GET['day'], $modality['id']);
            if($return) {
                return $this->data;
            }
        }


        $loadView = new \Core\ConfigView("sts/views/dashboard/updateModality", $this->data);
        $loadView->loadView();
    }


    // --------------------FUNCOES PARA FORMATACOES DE VIEWS
    // Funcao para enviar horario formatado para formulario
    private function timeForm($time, $house) {
        $timeArray = explode(':', $time);
        $result = $timeArray[$house];
        return $result;
    }
}
