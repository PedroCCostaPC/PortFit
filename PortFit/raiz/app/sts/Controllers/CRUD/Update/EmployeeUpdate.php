<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 
require_once(dirname(__FILE__, 2) . '/ImageCreate.php'); 


/**
 * Class UpdateEmployee -> Responsável por alterar Funcionarios
 */
class UpdateEmployee {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;


    /**
     * Funcao para alterar Funcionario
     */
    public function updateEmployee($id) {
        $Employee = new \Sts\Models\Employee\Read();
        $employee = $Employee->employeeId($id);

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
        $removePhoto = isset($_POST['remove-photo']) ? boolval($_POST['remove-photo']) : false;
        if(isset($_POST['position'])) $position = intval($_POST['position']);

        // Checando se campos obrigatorios foram preechidos
        if(!$firstName || !$lastName || !$birthDay || !$birthMonth || !$birthYear || !isset($sex) || !$rg ||!$email) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/alterar?employee=$id");
            return true;
        }

        // Validando data de nascimento
        if(!checkdate($birthMonth, $birthDay, $birthYear)) {
            $_SESSION['msg'] = 'Data de nascimento inválida!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/alterar?employee=$id");
            return true;
        }

        $birth = DateTime::createFromFormat('d/m/y', "$birthDay/$birthMonth/$birthYear");
        $birth = new DateTime("$birthYear-$birthMonth-$birthDay");
        $birth = $birth->format('Y-m-d');

        if($birth > date('Y-m-d')) {
            $_SESSION['msg'] = 'Data de nascimento inválida!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/alterar?employee=$id");
            return true;
        }

        // Validando RG
        if($employee['rg'] !== $rg) {
            $checkRG = $Employee->employeeRG($rg);
    
            if($checkRG) {
                $_SESSION['msg'] = 'RG já cadastrado!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/dashboard/funcionarios/alterar?employee=$id");
                return true;
            }
        }

        // Validando E-Mail
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg'] = 'E-Mail inválido!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/alterar?employee=$id");
            return true;
        }

        $CheckStudent = new \Sts\Models\Student\Read();
        if($employee['email'] !== $email) {
            $checkEmail = $CheckStudent->studentEmail($email);
            if(!$checkEmail) $checkEmail = $Employee->employeeEmail($email);
    
    
            if($checkEmail) {
                $_SESSION['msg'] = 'E-Mail já cadastrado!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/dashboard/funcionarios/alterar?employee=$id");
                return true;
            }
        }
        

        // Validando Telefone
        if($ddd && $phone) {
            $ddd = intval($ddd);
            $phone = intval($phone);

            // DDD
            if(strlen($ddd) !== 2) {
                $_SESSION['msg'] = 'DDD Inválido!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/dashboard/funcionarios/alterar?employee=$id");
                return true;
            }

            // Telefone
            if(strlen($phone) < 8 || strlen($phone) > 9) {
                $_SESSION['msg'] = 'Telefone Inválido!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/dashboard/funcionarios/alterar?employee=$id");
                return true;
            }

            $result['ddd'] = $ddd;
            $result['phone'] = $phone;
        }


        // Validando cargo
        if(!isset($position)) {
            $_SESSION['msg'] = 'Selecione um cargo!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/alterar?employee=$id");
            return true;
        }

        // Somente Boss pode adicionar outro Boss
        // Buscando ID do cargo
        $positionId = $Employee->employeeId($_SESSION['employee']['id']);
        $positionId = $positionId['position_id'];

        // Buscando cargos (cargo boss só aparece para o boss)
        if($positionId <> BOSS && $position === BOSS) {
            $_SESSION['msg'] = 'Não foi possível cadastrar funcionário!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/funcionarios/adicionar");
            return true;
        }


        // Remover foto caso remove-delete foi setado
        if($removePhoto) {
            $directoryPhoto = 'assets/img/employess/';

            if($employee['photo']) {
                unlink($directoryPhoto . $employee['photo']);
                $result['photo'] = null;
            }

        } else {
            $result['photo'] = $employee['photo'];
        }

        // Preparando array para enviar ao Model
        $fullName = $firstName . ' ' . $lastName;

        $result['firstName'] = $firstName;
        $result['lastName'] = $lastName;
        $result['fullName'] = $fullName;
        $result['birth'] = $birth;
        $result['sex'] = $sex;
        $result['rg'] = $rg;
        $result['email'] = $email;
        $result['id'] = $id;
        $result['position_id'] = $position;

        // Enviando ao Model
        $End = new \Sts\Models\Employee\Update();
        $End->updateEmployee($result);

        $_SESSION['msg'] = 'Funcionário alterado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/funcionarios/alterar?employee=$id");

        return true;
    }
    

    // -------------------- FUNCAO PARA ALTERAR SITUACAO DO FUNCIONARIO --------------------
    public function updateSituation() {
        $id = $_POST['id'];

        // Buscando situacao do Funcionario
        $Employee = new \Sts\Models\Employee\Read;
        $employee = $Employee->employeeId($id);
        $situation = $employee['situation'];

        // Preparando array para enviar ao Model
        $result['id'] = $id;
        $result['situation'] = $situation ? false : true;
        
        // Definindo mensagem de retorno com base na situacao
        $name = $employee['fullName'];
        $msg = $situation ? "<b>$name</b> desativado com sucesso!" : "<b>$name</b> ativado com sucesso!";

        // Enviando ao Model
        $End = new \Sts\Models\Employee\Update();
        $End->updateSituation($result);

        $_SESSION['msg'] = $msg;
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }


    // -------------------- FUNCAO PARA ALTERAR MINHA CONTA --------------------
    public function updateMyAccount() {
        $id = $_SESSION['employee']['id'];
        $directory = 'assets/img/employees/';
        
        $Employee = new \Sts\Models\Employee\Read();
        $employee = $Employee->employeeId($id);

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
        $removePhoto = isset($_POST['remove-photo']) ? boolval($_POST['remove-photo']) : false;
        if(isset($_POST['position'])) $position = intval($_POST['position']);


        // Checando se campos obrigatorios foram preechidos
        if(!$firstName || !$lastName || !$birthDay || !$birthMonth || !$birthYear || !isset($sex) || !$rg ||!$email) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/minhaConta");
            return true;
        }

        // Validando data de nascimento
        if(!checkdate($birthMonth, $birthDay, $birthYear)) {
            $_SESSION['msg'] = 'Data de nascimento inválida!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/minhaConta");
            return true;
        }

        $birth = DateTime::createFromFormat('d/m/y', "$birthDay/$birthMonth/$birthYear");
        $birth = new DateTime("$birthYear-$birthMonth-$birthDay");
        $birth = $birth->format('Y-m-d');

        if($birth > date('Y-m-d')) {
            $_SESSION['msg'] = 'Data de nascimento inválida!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/minhaConta");
            return true;
        }

        // Validando RG
        if($employee['rg'] !== $rg) {
            $checkRG = $Employee->employeeRG($rg);
    
            if($checkRG) {
                $_SESSION['msg'] = 'RG já cadastrado!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/dashboard/minhaConta");
                return true;
            }
        }

        // Validando E-Mail
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg'] = 'E-Mail inválido!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/minhaConta");
            return true;
        }

        $CheckStudent = new \Sts\Models\Student\Read();
        if($employee['email'] !== $email) {
            $checkEmail = $CheckStudent->studentEmail($email);
            if(!$checkEmail) $checkEmail = $Employee->employeeEmail($email);
    
    
            if($checkEmail) {
                $_SESSION['msg'] = 'E-Mail já cadastrado!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/dashboard/minhaConta");
                return true;
            }
        }


        // Validando Telefone
        if($ddd && $phone) {
            $ddd = intval($ddd);
            $phone = intval($phone);

            // DDD
            if(strlen($ddd) !== 2) {
                $_SESSION['msg'] = 'DDD Inválido!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/dashboard/minhaConta");
                return true;
            }

            // Telefone
            if(strlen($phone) < 8 || strlen($phone) > 9) {
                $_SESSION['msg'] = 'Telefone Inválido!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/dashboard/minhaConta");
                return true;
            }

            $result['ddd'] = $ddd;
            $result['phone'] = $phone;
        }


        // Remover foto caso remove-delete foi setado
        if($removePhoto) {
            if($employee['photo']) {
                unlink($directory . $employee['photo']);
                $result['photo'] = null;
            }

        } else {
            $result['photo'] = $employee['photo'];
        }

        // Criando foto caso mande
        if($_FILES['photo']['name']) {
            $photo = $employee['photo'];

            $NewImage = new ImageCreate();
            $result['photo'] = $NewImage->newImage($_FILES, $directory, 'photo', $photo);
        }


        // Preparando array para enviar ao Model
        $fullName = $firstName . ' ' . $lastName;

        $result['firstName'] = $firstName;
        $result['lastName'] = $lastName;
        $result['fullName'] = $fullName;
        $result['birth'] = $birth;
        $result['sex'] = $sex;
        $result['rg'] = $rg;
        $result['email'] = $email;
        $result['id'] = $id;


        // Alterando os dados na sessao
        $_SESSION['employee']['first_name'] = $result['firstName'];
        $_SESSION['employee']['last_name'] = $result['lastName'];
        $_SESSION['employee']['email'] = $result['email'];
        $_SESSION['employee']['photo'] = $result['photo'];


        // Enviando ao Model
        $End = new \Sts\Models\Employee\Update();
        $End->updateMyAccount($result);

        $_SESSION['msg'] = 'Conta alterada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/minhaConta");

        return true;        
    }



    // -------------------- FUNCAO PARA ALTERAR MINHA SENHA --------------------
    public function updateMyPassword() {
        $id = $_SESSION['employee']['id'];

        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        // Validando campos obrigatorios
        if(!$password || !$confirmPassword) {
            $_SESSION['msg'] = 'Digite uma senha!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/minhaConta");
            return true;
        }

        // Checando se password e confirmPassword sao iguais
        if($password !== $confirmPassword) {
            $_SESSION['msg'] = 'Confirme sua senha corretamente!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/minhaConta");
            return true;
        }


        $cryptoPass = sha1($password);
        
        // Enviando ao Model
        $End = new \Sts\Models\Employee\Update();
        $End->updateMyPassword($id, $cryptoPass);
        $_SESSION['msg'] = 'Senha alterada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/minhaConta");

        return true;
    }
} 