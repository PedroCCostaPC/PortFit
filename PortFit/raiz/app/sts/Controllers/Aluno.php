<?php
namespace Sts\Controllers;
require_once(dirname(__FILE__, 4) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 3) . '/helpers/StudentCheck.php');

/**
 * Controller da página inicial do aluno
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Aluno {
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

        // Buscando dias da semana que aluno treina
        $week = $Training->activeDay($myId);
        
        if($week) {

            // Formatando array
            for($i = 0; $i < count($week); $i++) {
                $week[$i] = $week[$i]['day'];
            }
            $week = array_unique($week);
            sort($week);
    
            // Buscando categoria que o aluno vai treinar nos dias
            for($i = 0; $i < count($week); $i++) {
                $training[$i]['day'] = $week[$i];
                $training[$i]['category'] = $Training->categoryDay($myId, $week[$i]);
            }
            // Formatando array
            for($i = 0; $i < count($training); $i++) {
                for($j = 0; $j < count($training[$i]['category']); $j++) {
                    
                    $categoryId = $training[$i]['category'][$j]['category_id'];
                    $category = $training[$i]['category'][$j]['category'];
    
                    $training[$i]['category_id'][$j] = $categoryId;
                    $training[$i]['category'][$j] = $category;
    
                }
    
                $training[$i]['category'] = array_unique($training[$i]['category']);
                $training[$i]['category_id'] = array_unique($training[$i]['category_id']);
    
                $training[$i]['category'] = array_values($training[$i]['category']);
                $training[$i]['category_id'] = array_values($training[$i]['category_id']);
            }
    
    
            // Formatando dia da semana
            $week = ['Domingo', 'Segunda-Feira', 'Terça-Feira', 'Quarta-Feira', 'Quinta-Feira', 'Sexta-Feira', 'Sábado'];
    
            $today = date('w');
    
            for($i = 0; $i < count($training); $i++) {
                $training[$i]['week'] = $week[$training[$i]['day']];
    
                // Colocando class do dia atual de acesso para diferenciar as cores dos demais dias
                if($training[$i]['day'] == $today) {
                    $training[$i]['class'] = 'today';
                } else {
                    $training[$i]['class'] = null;
                }
            }
    
            $this->data['training'] = $training;
        }

        $this->data['block-nav'] = true;
        $this->data['title-student'] = true;

        $loadView = new \Core\ConfigView("sts/views/student/start", $this->data);
        $loadView->loadView();
    }

}
