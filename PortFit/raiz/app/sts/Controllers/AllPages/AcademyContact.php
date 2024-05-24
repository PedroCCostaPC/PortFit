<?php
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php'); 

// CLASSE PARA PEGAR INFORMACOES DA ACADEMIA QUE PODERA SER VISTO EM TODAS PAGINAS
class AcademyContact {
    function contact() {
        $Academy = new \Sts\Models\Academy\Read();
        $academy = $Academy->academy();

        // Se existe academia cadastrada
        if($academy) {
            $contact = $Academy->contact($academy['id']);
            /**
             * @function academyFormat -> Formata as informacoes da academia para VIEW
             * academyFormat recebe array com os dados da academia e Boolean
             * True -> formata horário para o form no dashboard
             * False -> formata horário para as páginas comuns
             * diretório da funcao -> app/functions/AcademyFunciotns.php
             */
            $academy = academyFormat($academy, false);
    
            // formatando numero do whatsapp para Botoes
            if(isset($contact[0]['dddSapp']) && isset($contact[0]['whatsapp'])) {
                $academy['btnSapp'] = DDI . $contact[0]['dddSapp'] . $contact[0]['whatsapp'];
            }
    
            // Formatando Numero de telefone e whatsApp
            for($i = 0; $i < count($contact); $i++) {
                $academy['contact'][$i]['email'] = $contact[$i]['email'];
    
                /**
                 * @function formatPhone -> Formata Numero de contado da academia para VIEW
                 * formatPhone recebe array com ddd, numero do telefone e Boolean
                 * True -> formata numero para o form no dashboard
                 * False -> formata numero para as páginas comuns
                 * diretório da funcao -> app/functions/AcademyFunciotns.php
                 */
                $academy['contact'][$i]['phone'] = formatPhone($contact[$i]['ddd'], $contact[$i]['phone']);
                $academy['contact'][$i]['whatsapp'] = formatPhone($contact[$i]['dddSapp'], $contact[$i]['whatsapp']);
            }
        }

        return $academy;
    }
}


$Academy = new AcademyContact();
$academy = $Academy->contact();




