<?php
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

// CLASSE PARA PEGAR REDES SOCIAIS DA ACADEMIA QUE PODERA SER VISTO EM TODAS PAGINAS
class Social {
    function social() {
        $Academy = new \Sts\Models\Academy\Read();
        $academy = $Academy->academy();

        // Se sexiste academia cadastrada
        if($academy) {
            $academy = $academy['id'];
    
            $Social = new \Sts\Models\Social\Read();
            $social = $Social->social($academy);
    
            for($i = 0; $i < count($social); $i++) {
                /**
                 * @function formatSocial -> Formata as redes sociais para VIEW
                 * formatSocial recebe array com os dados da academia e Boolean
                 * True -> formata rede social para o form no dashboard
                 * False -> formata rede social para as páginas comuns
                 * diretório da funcao -> app/functions/SocialFunciotns.php
                 */
                $social[$i] = formatSocial($social[$i], false);
            }


            return $social;
        }
    }
}


$Social = new Social();
$social = $Social->social();