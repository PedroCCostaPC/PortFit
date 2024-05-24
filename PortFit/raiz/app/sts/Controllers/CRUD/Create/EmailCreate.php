<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 6) . '/core/ConfigEmail.php');
require_once(dirname(__FILE__, 4) . '/Views/email/ContactEmail.php');


/**
 * Class NewContact -> Responsável por criar Email de contato
 */
class NewContact {
    /**
     * @var string $url -> variavel para link inicial do projeto
     */
    private $url = URL;
    
    /**
     * Funcao para criar Email de contato
     */
    public function createEmail($id) {
        $Academy = new \Sts\Models\Academy\Read();
        $return = "$this->url/contato";

        // Buscando contato da academia
        $contact = $Academy->contactMain($id);

        // POST
        $name = ucwords($_POST['name']);
        $email = $_POST['email'];
        $student = isset($_POST['student']) ? $_POST['student'] : false;
        $ddd = $_POST['ddd'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];


        // Checando se campos obrigatorios foram preenchidos
        if(!$name || !$email || !$message) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $return");
            return true;
        }


        // Validando E-Mail
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg'] = 'E-Mail inválido!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $return");
            return true;
        }

        // Validando Telefone
        if($ddd && $phone) {
            $ddd = intval($ddd);
            $phone = intval($phone);

            // DDD
            if(strlen($ddd) !== 2) {
                $_SESSION['msg'] = 'DDD Inválido!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $return");
                return true;
            }

            // Telefone
            if(strlen($phone) < 8 || strlen($phone) > 9) {
                $_SESSION['msg'] = 'Telefone Inválido!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $return");
                return true;
            }

            $result['ddd'] = $ddd;
            $result['phone'] = $phone;
        } else {
            $result['ddd'] = null;
            $result['phone'] = null;
            $envEmail['ddd'] = null;
            $envEmail['phone'] = null;
        }


        // Pegando data e hora de envio do email
        $date = date('Y-m-d');
        $time = date('H:i:s');


        // Preparando array para enviar ao Model
        $result['name'] = $name;
        $result['email'] = $email;
        $result['student'] = $student;
        $result['message'] = $message;
        $result['date'] = $date;
        $result['time'] = $time;
        $result['view'] = false;


        // Preparando array para envial para email
        $envEmail['name'] = $name;
        $envEmail['email'] = $email;
        $envEmail['student'] = $student ? 'Sim' : 'Não';
        $envEmail['message'] = $message;

        // Formatando telefone
        if($ddd && $phone) {
            $phone = substr($phone, 0, 4) . '-' . substr($phone, 4);
            $phone = "($ddd) $phone";
            $envEmail['phone'] = $phone;
        } else {
            $envEmail['phone'] = 'Não informado';
        }

        // Formatando data
        $dateArray = explode('-', $date);
        $year = $dateArray[0];
        $month = $dateArray[1];
        $day = $dateArray[2];
        $envEmail['date'] = "$day/$month/$year";

        // Formatando Hora
        $timeArray = explode(':', $time);
        $hour = $timeArray[0];
        $minute = $timeArray[1];
        $envEmail['time'] = "$hour:$minute";

        $academyEmail = $contact['email'] ? $contact['email'] : EMAILADM;


         // Enviando ao Model
         $End = new \Sts\Models\Email\Create();
         $End->createContact($result);


        // Enviando contato para email da academia
        $title = "Contato - $email";

        /**
         * @var $Text -> Recebe a funcao create() da Classe ContactEmail()
         * Responsavel pelo conteudo do email
         * Diretorio da Classe: app/sts/Views/email/ContactEmail.php
         */
        $Text = new ContactEmail();
        $text = $Text->create($envEmail);

        /**
         * @function sendEmail -> Responsavel pelo envio de email
         * Recebe 5 parametros
         * 1 - Email do destinatario ($email)
         * 2 - Nome do destinatario ($result['fullName'])
         * 3 - Titulo do email ($title)
         * 4 - e o conteudo ($text)
         * 5 - Boolean - true para o nome do usuario no email, false para nome da academia no email
         * 
         * Diretorio da funcao: core/ConfigEmail.php
         */
        sendEmail($academyEmail, $name, $title, $text, true);


        // Finalizando
        $_SESSION['msg'] = "Contato enviado com sucesso!";
        $_SESSION['msg-type'] = 'success';
        header("Location: $return");

        return true;

    }
}
    
    