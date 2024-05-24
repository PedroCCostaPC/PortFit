<?php
namespace Sts\Controllers\Aluno\Treino;
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/StudentCheck.php');

/**
 * Controller da pagina de detalhes do treino do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Detalhes {
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
        $Training = new \Sts\Models\Training\Read();

        // Checando se existe $_GET['training']
        if(!isset($_GET['training'])) {
            header("Location: $this->url/aluno");
        }


        // Buscando treino
        $training = $Training->trainingDetails($_GET['training'], $myId);

        // Checando se treino
        if(!$training) {
            header("Location: $this->url/aluno");
        }

        // Formatando dia da semana
        $week = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];

        $training['day-format'] = $week[$training['day']];


        $this->data = $training;
        
        $this->data['block-nav'] = true;
        $this->data['title-student'] = true;


        $loadView = new \Core\ConfigView("sts/views/student/trainingDetails", $this->data);
        $loadView->loadView();
    }

}
