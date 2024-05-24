<?php
namespace Sts\Controllers;
require_once(dirname(__FILE__, 4) . '/core/BlockFile.php');

/**
 * Controller da página Modalidade
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

class Modalidade {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    /**
    * @var array|string|null $data Receb os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     *Instanciar a classe responsável em carregar a View
     * @return void
     */

    public function index() {
        $Modality = new \Sts\Models\Modality\Read();

        // Checando se existe $_GET['key']
        if(!isset($_GET['key'])) {
            header("Location: $this->url/modalidades");
        }

        // Buscando Modalidade
        $modality = $Modality->modalityIdActive($_GET['key']);

        // Checando se encontrou alguma modalidade
        if(!$modality) {
            header("Location: $this->url/modalidades");
        }


        // Buscando Dias da modalidade
        $day = $Modality->dayModality($_GET['key']);
        // Formatando array
        for($i = 0; $i < count($day); $i++) {
            $day[$i] = $day[$i]['day'];
        }
        $day = array_unique($day);
        $day = array_values($day);

        // Formatando dia da semana
        $week = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];

        // Pegando Horarios da modalidade
        for($i = 0; $i < count($day); $i++) {
            $time[$i]['day'] = $week[$day[$i]];
            $time[$i]['time'] = $Modality->time($_GET['key'], $day[$i]);
        }

        // Formatando Horarios
        if(isset($time)) {
            for($i = 0; $i < count($time); $i++) {
    
                for($j = 0; $j < count($time[$i]['time']); $j++) {
                    $open = $time[$i]['time'][$j]['open'];
                    $close = $time[$i]['time'][$j]['close'];
    
                    $time[$i]['time'][$j]['open'] = $this->formatTime($open);
                    $time[$i]['time'][$j]['close'] = $this->formatTime($close);
                }
            }
        }
        

        $this->data['modality'] = $modality;
        $this->data['time'] = isset($time) ? $time : null;

        $loadView = new \Core\ConfigView("sts/views/public/modality", $this->data);
        $loadView->loadView();
    }

    // Funcao para formatar horario
    private function formatTime($time) {
        $timeArray = explode(':', $time);

        $hour = $timeArray[0];
        $minute = $timeArray[1];

        $result = "$hour:$minute";

        return $result;
    }
}