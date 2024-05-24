<?php
namespace Sts\Controllers\Dashboard;

use DeleteEmail;
use UpdateEmail;

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 4) . '/helpers/AdminCheck.php');
require_once(dirname(__FILE__, 4) . '/functions/Pagination.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Update/EmailUpdate.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Delete/EmailDelete.php');


/**
 * Controller da página dashboard -> email
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Email {
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
        $amount = 20;

        // EMAIL
        $Email = new \Sts\Models\Email\Read();


        // Caso tenha algum filtro
        if(isset($_GET['filter'])) {
            // Buscando quantidade de email para definir quantidade de paginas
            $filter = $_GET['filter'];


            if($filter === 'unread') {
                $totalEmail = $Email->countUnread(false);
            } elseif($filter === 'read') {
                $totalEmail = $Email->countUnread(true);
            } else {
                $totalEmail = $Email->count();
            }
            
            $totalEmail = $totalEmail[0];


            $pagination = pagination($totalEmail, $amount, "$this->url/dashboard/email?filter=$filter");
            $start = $pagination['start'];

            $email = $this->filter($amount, $start, $filter);
            $this->data['link'] = "$this->url/dashboard/email?filter=$filter";

        } else {
            // Buscando quantidade de email para definir quantidade de paginas
            $totalEmail = $Email->count();
            $totalEmail = $totalEmail[0];

            $pagination = pagination($totalEmail, $amount, "$this->url/dashboard/email");
            $start = $pagination['start'];

            $email = $Email->allEmail($amount, $start);
            $this->data['link'] = "$this->url/dashboard/email";
        }

        // Pegando quantidade total de email
        $countFullEmail = $Email->count();
        $countFullEmail = $countFullEmail[0];

        // Pegando quantidades de emails nao lidos
        $unread = $Email->countUnread(false);
        $unread = $unread['view'];

        // Pegando quantidade de email lidos
        $read = $Email->countUnread(true);
        $read = $read['view'];

        // Formatando data do email
        for($i = 0; $i < count($email); $i++) {
            $date = explode('-', $email[$i]['date']);

            $day = $date[2];
            $month = $date[1];
            $year = $date[0];

            $email[$i]['date'] = "$day/$month/$year";
        }

        // Definindo texto do botao filtro
        if(!isset($_GET['filter'])) {
            $textFilter = "Todos ($countFullEmail)";
        } elseif(isset($_GET['filter']) && $_GET['filter'] === 'unread') {
            $textFilter = "Não lidos ($unread)";
        } elseif(isset($_GET['filter']) && $_GET['filter'] === 'read') {
            $textFilter = "Lidos ($read)";
        }

        // Colocando class CSS para emails ja vistos
        for($i = 0; $i < count($email); $i++) {
            $email[$i]['class-view'] = $email[$i]['view'] ? 'email-read' : null;
        }


        // Finalizando
        $this->data['count-full-email'] = $countFullEmail;
        $this->data['email-unread'] = $unread;
        $this->data['email-read'] = $read;
        $this->data['text-filter'] = $textFilter;
        $this->data['email'] = $email;
        $this->data['pagination'] = $pagination;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;

        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST
        // Alterando View
        if(isset($_POST['view-email'])) {
            $Update = new UpdateEmail();
            // Retorna para pagina '/dashboard/email'
            $return = $Update->updateView();
            if($return) {
                return $this->data;
            }
        }

        // Excluindo Email
        if(isset($_POST['delete-email'])) {
            $Delete = new DeleteEmail;
            $return = $Delete->deleteEmail();
            if($return) {
                return $this->data;
            }
        }

        $loadView = new \Core\ConfigView("sts/views/dashboard/emailAll", $this->data);
        $loadView->loadView();
    }


    // FUNCAO PARA FILTRAR BUSCA
    private function filter($amount, $start, $filter) {
        $Result = new \Sts\Models\Email\Read();

        if($filter === 'unread') {
            $result = $Result->unread($amount, $start, false);

        } elseif($filter === 'read') {
            $result = $Result->unread($amount, $start, true);

        }

        return $result;
    }
}
