<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 2) . '/ImageCreate.php');
require_once(dirname(__FILE__, 6) . '/core/ConfigEmail.php');
require_once(dirname(__FILE__, 4) . '/Views/email/EmployeeEmail.php');


/**
 * Class CreateEmployee -> Responsável por criar Funcionarios
 */
class CreateEmployee {
    /**
     * @var string $url -> variavel para link inicial do projeto
     */
    private $url = URL;

    /**
     * Funcao para criar Funcionario
     */
    public function newEmployee() {
        $firstName = ucwords($_POST['first-name']);
        $lastName = ucwords($_POST['last-name']);
        $birthDay = $_POST['day'];
        $birthMonth = $_POST['month'];
        $birthYear = $_POST['year'];
        if(isset($_POST['sex'])) $sex = boolval($_POST['sex']);
        $rg = $_POST['rg'];
        $email = $_POST['email'];
        $ddd = $_POST['ddd'];
        $phone = $_POST['phone'];
        if(isset($_POST['position'])) $position = intval($_POST['position']);


        // Checando se campos obrigatorios foram preechidos
        if(!$firstName || !$lastName || !$birthDay || !$birthMonth || !$birthYear || !isset($sex) || !$rg ||!$email) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/adicionar");
            return true;
        }

        // Validando data de nascimento
        if(!checkdate($birthMonth, $birthDay, $birthYear)) {
            $_SESSION['msg'] = 'Data de nascimento inválida!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/adicionar");
            return true;
        }

        $birth = DateTime::createFromFormat('d/m/y', "$birthDay/$birthMonth/$birthYear");
        $birth = new DateTime("$birthYear-$birthMonth-$birthDay");
        $birth = $birth->format('Y-m-d');

        if($birth > date('Y-m-d')) {
            $_SESSION['msg'] = 'Data de nascimento inválida!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/adicionar");
            return true;
        }
        
        // Validando RG
        $CheckEmployee = new \Sts\Models\Employee\Read();
        $checkRG = $CheckEmployee->employeeRG($rg);

        if($checkRG) {
            $_SESSION['msg'] = 'RG já cadastrado!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/adicionar");
            return true;
        }

        // Validando E-Mail
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg'] = 'E-Mail inválido!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/adicionar");
            return true;
        }

        $CheckStudent = new \Sts\Models\Student\Read();
        $checkEmail = $CheckStudent->studentEmail($email);
        if(!$checkEmail) $checkEmail = $CheckEmployee->employeeEmail($email);


        if($checkEmail) {
            $_SESSION['msg'] = 'E-Mail já cadastrado!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/adicionar");
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
                header("Location:  $this->url/dashboard/funcionarios/adicionar");
                return true;
            }

            // Telefone
            if(strlen($phone) < 8 || strlen($phone) > 9) {
                $_SESSION['msg'] = 'Telefone Inválido!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/dashboard/funcionarios/adicionar");
                return true;
            }

            $result['ddd'] = $ddd;
            $result['phone'] = $phone;
        }


        // Validando cargo
        if(!isset($position)) {
            $_SESSION['msg'] = 'Selecione um cargo!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/adicionar");
            return true;
        }

        // Somente Boss pode adicionar outro Boss
        // Buscando ID do cargo
        $positionId = $CheckEmployee->employeeId($_SESSION['employee']['id']);
        $positionId = $positionId['position_id'];

        // Buscando cargos (cargo boss só aparece para o boss)
        if($positionId <> BOSS && $position === BOSS) {
            $_SESSION['msg'] = 'Não foi possível cadastrar funcionário!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/adicionar");
            return true;
        }


        // Gerando Senha
        $strings = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $password = substr(str_shuffle($strings), 0, 7);
        $cryptoPass = sha1($password);


        // Preparando array para enviar ao Model
        $fullName = $firstName . ' ' . $lastName;

        $result['firstName'] = $firstName;
        $result['lastName'] = $lastName;
        $result['fullName'] = $fullName;
        $result['birth'] = $birth;
        $result['sex'] = $sex;
        $result['rg'] = $rg;
        $result['email'] = $email;
        $result['password'] = $cryptoPass;
        $result['situation'] = true;
        $result['position_id'] = $position;

        // Enviando ao Model
        $End = new \Sts\Models\Employee\Create();
        $End->createEmployee($result);


        // Enviando senha para email do aluno
        $title = 'Conta criada';

        /**
         * @var $Text -> Recebe a funcao create() da Classe EmployeeEmail()
         * Responsavel pelo conteudo do email
         * Diretorio da Classe: app/sts/Views/email/EmployeeEmail.php
         */
        $Text = new EmployeeEmail();
        $text = $Text->create($firstName, $password);

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
        sendEmail($email, $fullName, $title, $text);


        // Finalizando
        $_SESSION['msg'] = 'Funcionário cadastrado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/funcionarios");

        return true;

    }
    
}

