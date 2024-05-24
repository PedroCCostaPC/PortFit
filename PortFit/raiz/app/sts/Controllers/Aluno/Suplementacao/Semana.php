<?php
namespace Sts\Controllers\Aluno\Suplementacao;
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/StudentCheck.php');

/**
 * Controller da pagina de suplementacao da semana do aluno
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
        $Supplement = new \Sts\Models\Supplement\Read();

        // Formatando dia
        $sunday['day'] = 'Domingo';
        $monday['day'] = 'Segunda-Feira';
        $tuesday['day'] = 'Terça-Feira';
        $wednesday['day'] = 'Quarta-Feira';
        $thursday['day'] = 'Quinta-Feira';
        $friday['day'] = 'Sexta-Feira';
        $saturday['day'] = 'Sábado';

        // Buscando Suplementacao
        $sunday['supplement'] = $Supplement->allSupplement($myId, 0);
        $monday['supplement'] = $Supplement->allSupplement($myId, 1);
        $tuesday['supplement'] = $Supplement->allSupplement($myId, 2);
        $wednesday['supplement'] = $Supplement->allSupplement($myId, 3);
        $thursday['supplement'] = $Supplement->allSupplement($myId, 4);
        $friday['supplement'] = $Supplement->allSupplement($myId, 5);
        $saturday['supplement'] = $Supplement->allSupplement($myId, 6);

        // Formatando hora
        $sunday['supplement'] = $this->formatTime($sunday['supplement']);
        $monday['supplement'] = $this->formatTime($monday['supplement']);
        $tuesday['supplement'] = $this->formatTime($tuesday['supplement']);
        $wednesday['supplement'] = $this->formatTime($wednesday['supplement']);
        $thursday['supplement'] = $this->formatTime($thursday['supplement']);
        $friday['supplement'] = $this->formatTime($friday['supplement']);
        $saturday['supplement'] = $this->formatTime($saturday['supplement']);

        // Retorna a pagina de alimentacao caso nao haja alimentacoes montada
        if(!$sunday['supplement'] && !$monday['supplement'] && !$tuesday['supplement'] && !$wednesday['supplement'] && !$thursday['supplement']  & !$friday['supplement'] && !$saturday['supplement']) {
            header("Location: $this->url/aluno/suplementacao");
        }

        // Checando se os dias tem alimentacao
        $sunday['class'] = !$sunday['supplement'] ? 'not-exist' : null;
        $monday['class'] = !$monday['supplement'] ? 'not-exist' : null;
        $tuesday['class'] = !$tuesday['supplement'] ? 'not-exist' : null;
        $wednesday['class'] = !$wednesday['supplement'] ? 'not-exist' : null;
        $thursday['class'] = !$thursday['supplement'] ? 'not-exist' : null;
        $friday['class'] = !$friday['supplement'] ? 'not-exist' : null;
        $saturday['class'] = !$saturday['supplement'] ? 'not-exist' : null;

        // Finalizando
        $this->data['supplement']['sunday'] = $sunday;
        $this->data['supplement']['monday'] = $monday;
        $this->data['supplement']['tuesday'] = $tuesday;
        $this->data['supplement']['wednesday'] = $wednesday;
        $this->data['supplement']['thursday'] = $thursday;
        $this->data['supplement']['friday'] = $friday;
        $this->data['supplement']['saturday'] = $saturday;

        $this->data['block-nav'] = true;
        $this->data['title-student'] = true;

        $loadView = new \Core\ConfigView("sts/views/student/supplementWeek", $this->data);
        $loadView->loadView();
    }


    // Funcao para formatar horario das suplementacoes
    private function formatTime($supplement) {
        for($i = 0; $i < count($supplement); $i++) {
            $time = explode(':', $supplement[$i]['time']);

            $hour = $time[0];
            $minute = $time[1];

            $supplement[$i]['time'] = "$hour:$minute";
        }

        return $supplement;
    }
}
