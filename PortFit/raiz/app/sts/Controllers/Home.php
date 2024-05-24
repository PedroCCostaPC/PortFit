<?php
namespace Sts\Controllers;
require_once(dirname(__FILE__, 4) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 3) . '/functions/PricesFunctions.php');
require_once(dirname(__FILE__, 3) . '/functions/ModalitiesFunctions.php');
require_once(dirname(__FILE__, 3) . '/functions/BlogFunctions.php');

/**
 * Controller da página Home
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

class Home {
    /**
    * @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     *Instanciar a classe responsável em carregar a View
     * @return void
     */

    public function index() {
        // Modalidades
        $Modality = new \Sts\Models\Modality\Read();
        $modalities = $Modality->active();

        $this->data['slide'] = $this->modality($modalities, 3);
        $this->data['modalities'] = $this->modality($modalities, 6);


        // Precos
        $Price = new \Sts\Models\Price\Read();
        $prices = $Price->active();
        for($i = 0; $i < count($prices); $i++) {
            /**
             * @function priceFormat -> Formata os precos da academia para VIEW
             * priceFormat recebe a class do Price e array com os dados do preco
             * diretório da funcao -> app/functions/PricesFunciotns.php
             */
            $this->data['prices'][$i] = priceFormat($Price, $prices[$i]);
        }

        // Buscando preco destacado
        $priceEmphasis = $Price->priceEmphasis();
        if($priceEmphasis) {
            $this->data['priceEmphasis'] = priceFormat($Price, $priceEmphasis);
        }
        
        // Define quantos preço ira mostrar por vez no carousel
        // Se tiver preco destacado, mostra 3
        // Se nao tiver preco destacado, mostra 4
        $this->data['amount-price'] = $priceEmphasis ? 3 : 4;
        $this->data['carousel-class'] = $priceEmphasis ? null : 'carousel-price-full';

        // Blog
        $Blog = new \Sts\Models\Blog\Read();
        $blog = $Blog->blog(3, 0);
        for($i = 0; $i < count($blog); $i++) {
            $this->data['blog'][$i] = formatBlog($blog[$i], true);
        }

        
        $loadView = new \Core\ConfigView("sts/views/public/home", $this->data);
        $loadView->loadView();
    }

    // -------------------- FUNCOES PARA FORMATAR DADOS A SEREM ENVIADOS PARA VIEWS --------------------

    // FUNCAO PARA TRATAR MODALIDADES PARA VIEW
    private function modality($modality, $amount) {
        if($modality) {
            // Slide
            shuffle($modality);
            for($i = 0; $i < $amount; $i++) {
                if(isset($modality[$i])) {
                    /**
                     * @function modalityFormat -> Formata os dados das modalidades para a VIEW
                     * modalityFormat recebe array com as informacoes da modalidade e Boolean
                     * True -> formata modalidade com todas as informacoes
                     * False -> formata modalidade com apenas id, nome, frase, banner e resumo
                     * diretório da funcao -> app/functions/ModalitiesFunciotns.php
                     */
                    $result[$i] = modalityFormat($modality[$i], false);
                }
            }
    
            return $result;
        }
    }
    
}
