<?php
namespace Sts\Controllers\Aluno\Alimentacao;
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/StudentCheck.php');

/**
 * Controller da pagina de alimentacao da semana do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Semana {
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

        // Formatando dia
        $sunday['day'] = 'Domingo';
        $monday['day'] = 'Segunda-Feira';
        $tuesday['day'] = 'Terça-Feira';
        $wednesday['day'] = 'Quarta-Feira';
        $thursday['day'] = 'Quinta-Feira';
        $friday['day'] = 'Sexta-Feira';
        $saturday['day'] = 'Sábado';

        // Buscando refeicoes
        $sunday['food'] = $Food->allFood($myId, 0);
        $monday['food'] = $Food->allFood($myId, 1);
        $tuesday['food'] = $Food->allFood($myId, 2);
        $wednesday['food'] = $Food->allFood($myId, 3);
        $thursday['food'] = $Food->allFood($myId, 4);
        $friday['food'] = $Food->allFood($myId, 5);
        $saturday['food'] = $Food->allFood($myId, 6);

        // Formatando hora
        $sunday['food'] = $this->formatTime($sunday['food']);
        $monday['food'] = $this->formatTime($monday['food']);
        $tuesday['food'] = $this->formatTime($tuesday['food']);
        $wednesday['food'] = $this->formatTime($wednesday['food']);
        $thursday['food'] = $this->formatTime($thursday['food']);
        $friday['food'] = $this->formatTime($friday['food']);
        $saturday['food'] = $this->formatTime($saturday['food']);

        // Retorna a pagina de alimentacao caso nao haja alimentacoes montada
        if(!$sunday['food'] && !$monday['food'] && !$tuesday['food'] && !$wednesday['food'] && !$thursday['food']  & !$friday['food'] && !$saturday['food']) {
            header("Location: $this->url/aluno/alimentacao");
        }

        // Checando se os dias tem alimentacao
        $sunday['class'] = !$sunday['food'] ? 'not-exist' : null;
        $monday['class'] = !$monday['food'] ? 'not-exist' : null;
        $tuesday['class'] = !$tuesday['food'] ? 'not-exist' : null;
        $wednesday['class'] = !$wednesday['food'] ? 'not-exist' : null;
        $thursday['class'] = !$thursday['food'] ? 'not-exist' : null;
        $friday['class'] = !$friday['food'] ? 'not-exist' : null;
        $saturday['class'] = !$saturday['food'] ? 'not-exist' : null;


        // Finalizando
        $this->data['food']['sunday'] = $sunday;
        $this->data['food']['monday'] = $monday;
        $this->data['food']['tuesday'] = $tuesday;
        $this->data['food']['wednesday'] = $wednesday;
        $this->data['food']['thursday'] = $thursday;
        $this->data['food']['friday'] = $friday;
        $this->data['food']['saturday'] = $saturday;

        $this->data['block-nav'] = true;
        $this->data['title-student'] = true;

        $loadView = new \Core\ConfigView("sts/views/student/foodWeek", $this->data);
        $loadView->loadView();
    }


    // Funcao para formatar horario das refeicoes
    private function formatTime($food) {
        for($i = 0; $i < count($food); $i++) {
            $time = explode(':', $food[$i]['time']);

            $hour = $time[0];
            $minute = $time[1];

            $food[$i]['time'] = "$hour:$minute";
        }

        return $food;
    }
}
