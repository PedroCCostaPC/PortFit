<?php
namespace Sts\Controllers\Dashboard\Email;

require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 5) . '/helpers/AdminCheck.php');


/**
 * Controller da página dashboard -> visualizar email
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Visualizar {
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
        // Retornando a pagina de email caso nao tenha $_GET['key']
        if(!isset($_GET['key'])) {
            header("Location: $this->url/dashboard/email");
            return;
        }

        $Email = new \Sts\Models\Email\Read();


        // Email
        $email = $Email->emailId($_GET['key']);

        // Retornando a pagina de email caso nao ache email
        if(!$email) {
            header("Location: $this->url/dashboard/email");
            return;
        }

        // Formatando data
        $date = explode('-', $email['date']);
        $day = $date[2];
        $month = $date[1];
        $year = $date[0];

        $email['date'] = "$day/$month/$year";

        // Formatando Hora
        $time = explode(':', $email['time']);
        $hour = $time[0];
        $minute = $time[1];

        $email['time'] = "$hour:$minute";

        // Formatando telefone
        $email['phone'] = substr_replace($email['phone'], '-', -4, 0);

        // Formatando aluno
        $email['student'] = $email['student'] ? 'Sim' : 'Não';


        // Alterando view para true no db ao acesar email
        $view['id'] = $email['id'];
        $view['view'] = true;

        $EmailUpdate = new \Sts\Models\Email\Update();
        $EmailUpdate->updateView($view);


        $this->data = $email;

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;


        $loadView = new \Core\ConfigView("sts/views/dashboard/emailView", $this->data);
        $loadView->loadView();
    }
}
