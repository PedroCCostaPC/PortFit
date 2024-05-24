<?php
require_once(dirname(__FILE__, 3) . '/core/BlockFile.php'); 

// ---------------------------------------------------------------------------------------
/**
 * FUNCAO PARA PAGINACAO
 *
 * @param [Int] $totalScore -> Recebe a quantidade total de counteudo buscado pelo DB
 * @param [Int] $amount -> Recebe a quantidade de counteudo mostrado por pagina
 * @param [String] $link -> Recebe o link para pagina de retorno
 * @return void
 */
function pagination($totalScore, $amount, $link) {
    /**
     * Definindo quantidade de paginas
     * Caso quantidade de exercicios seja maior que $amount
     */
    if($totalScore > $amount) {
        $totalPage = $totalScore / $amount;
        $totalPage = ceil($totalPage);
        
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $page = intval($page);
        

        // Definindo array de paginacao para frente
        for($i = $page; $i < $totalPage + 1; $i++) {
            if($i === $page) {
                $result['current'] = $i;
            } else {
                $result['next'][$i] = $i;
            }

            if($page + 2 === $i) break;
        }

        $result['last'] = $totalPage;
        

        // Definindo 'start' para primeira pagina
        if(!isset($_GET['page'])) {
            $result['start'] = 0;

        // Definindo array de paginacao com 'start' para caso estiver em alguma paginacao
        } else {
            if($page < 2) header("Location: $link");
            if($page > $totalPage) header("Location: {$link}?page={$totalPage}");

            // Definindo o 'start' para buscar no DB
            $result['start'] = ($page - 1) * $amount;


            // Definindo array de paginacao para tras
            for($i = $page - 1; $i > 0; $i--) {
                $result['prev'][$i] = $i;

                if($page - 2 === $i) break;
            }

            ksort($result['prev']);
        }


    // Caso nao tenha paginacao, retorna 'start' = 0
    } else {
        $result['start'] = 0;
    }

    return $result;
}

// FUNCAO PARA CHECAR SE EXISTE GETE
function checkGet() {
    $get = '?';

    if(count($_GET) === 2 && !isset($_GET['page'])) {
        $get = '&';
    } elseif(count($_GET) > 2) {
        $get = '&';

    } 
    
    return $get;
}
