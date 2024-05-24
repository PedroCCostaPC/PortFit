<?php
namespace Sts\Controllers\Aluno;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/StudentCheck.php');

/**
 * Controller da pagina de suplementacao do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Suplementacao {
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
        $Supplement = new \Sts\Models\Supplement\Read();
        
        $today = date('w');

        // Buscando alimentacao
        $supplement = $Supplement->allSupplement($myId, $today);

        // Pegando hora de acesso
        $timeCurrent = date('H:i:s');

        // Formatando horario das alimentacoes
        for($i = 0; $i < count($supplement); $i++) {
            $supplementTime = explode(':', $supplement[$i]['time']);

            $hourSupplement = $supplementTime[0];
            $minuteSupplement = $supplementTime[1];
            $secondSupplement = $supplementTime[2];


            // Colocando class de cores para reficao que ja passou, ou que esta atual
            if($supplement[$i]['time'] < $timeCurrent) {
                $difference = date('H:i:s', strtotime($timeCurrent) - $secondSupplement - ($minuteSupplement * 60) - ($hourSupplement * 3600));
                
                $hour = substr($difference, 0, 2);
                $minute = substr($difference, 3, 2);

                if($hour == 0 && $minute <= 30) {
                    $supplement[$i]['class'] = "current";
                } else {
                    $supplement[$i]['class'] = "past";
                }

            } else {
                $supplement[$i]['class'] = null;
            }

            $supplement[$i]['time'] = "$hourSupplement:$minuteSupplement";
        }

        // Checando se existe suplementaco montada para aluno
        $existSupplement = $Supplement->existSupplement($myId);
        $this->data['exist'] = $existSupplement ? true : false;


        $this->data['supplement'] = $supplement;

        $this->data['block-nav'] = true;
        $this->data['title-student'] = true;

        $loadView = new \Core\ConfigView("sts/views/student/supplement", $this->data);
        $loadView->loadView();
    }

}
