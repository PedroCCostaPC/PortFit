<?php
namespace Sts\Controllers\Aluno;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/StudentCheck.php');

/**
 * Controller da pagina de alimentacao do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Alimentacao {
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
        $myId = $_SESSION['student']['id'];
        $Food = new \Sts\Models\Food\Read();
        
        $today = date('w');

        // Buscando alimentacao
        $food = $Food->allFood($myId, $today);

        // Pegando hora de acesso
        $timeCurrent = date('H:i:s');

        // Formatando horario das alimentacoes
        for($i = 0; $i < count($food); $i++) {
            $foodTime = explode(':', $food[$i]['time']);

            $hourFood = $foodTime[0];
            $minuteFood = $foodTime[1];
            $secondFood = $foodTime[2];

            // Colocando class de cores para reficao que ja passou, ou que esta atual
            if($food[$i]['time'] < $timeCurrent) {
                $difference = date('H:i:s', strtotime($timeCurrent) - $secondFood - ($minuteFood * 60) - ($hourFood * 3600));
                
                $hour = substr($difference, 0, 2);
                $minute = substr($difference, 3, 2);

                if($hour == 0 && $minute <= 30) {
                    $food[$i]['class'] = "current";
                } else {
                    $food[$i]['class'] = "past";
                }

            } else {
                $food[$i]['class'] = null;
            }

            $food[$i]['time'] = "$hourFood:$minuteFood";
        }

        // Checando se existe alimentacao montada para aluno
        $existFood = $Food->existFood($myId);
        $this->data['exist'] = $existFood ? true : false;

        $this->data['food'] = $food;

        $this->data['block-nav'] = true;
        $this->data['title-student'] = true;

        $loadView = new \Core\ConfigView("sts/views/student/food", $this->data);
        $loadView->loadView();
    }

}
