<?php
namespace Sts\Controllers\Aluno;
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/StudentCheck.php');

/**
 * Controller da página de treino do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Treino {
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

        // Validando $_GET['day'];
        if(!isset($_GET['day'])) {
            header("Location: $this->url/aluno");
        }
        if($_GET['day'] < 0 || $_GET['day'] > 6) {
            header("Location: $this->url/aluno");
        }

        // Checando se existe $_GET['category']
        if(!isset($_GET['category'])) {
            header("Location: $this->url/aluno");
        }

        // Buscando treinos do dia e da categoria
        $training = $Training->allCompleteTrainingBase($myId, $_GET['category'], $_GET['day']);

        // Retorna para pagina inicial do aluno caso nao ache treino
        if(!$training) {
            header("Location: $this->url/aluno");
        }

        // Pegando outras categorias do dia
        $category = $Training->categoryDay($myId, $_GET['day']);

        // Formatando array
        for($i = 0; $i < count($category); $i++) {
            $categoryId[$i] = $category[$i]['category_id'];
            $categoryName[$i] = $category[$i]['category'];
        }

        $categoryId = array_unique($categoryId);
        $categoryId = array_values($categoryId);
        
        $categoryName = array_unique($categoryName);
        $categoryName = array_values($categoryName);

        $category = [];

        for($i = 0; $i < count($categoryId); $i++) {
            $category[$i]['id'] = $categoryId[$i];
            $category[$i]['name'] = $categoryName[$i];

            // Colocando class da categoria acessada
            if($categoryId[$i] == $_GET['category']) {
                $category[$i]['class'] = 'current-page';
            } else {
                $category[$i]['class'] = null;
            }
        }

        // Formatando dia da semana
        $week = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];

        $day = $week[$_GET['day']];

        
        $this->data['day'] = $day;
        $this->data['category'] = $category;
        $this->data['training'] = $training;

        $this->data['block-nav'] = true;
        $this->data['title-student'] = true;

        $loadView = new \Core\ConfigView("sts/views/student/training", $this->data);
        $loadView->loadView();
    }

}
