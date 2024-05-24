<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 
require_once(dirname(__FILE__, 2) . '/ImageCreate.php'); 


/**
 * Class UpdateStudent -> Responsável por alterar Alunos
 */
class UpdateStudent {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;


    /**
     * Funcao para alterar Aluno
     */
    public function updateStudent($id) {
        $Student = new \Sts\Models\Student\Read();
        $student = $Student->studentId($id);

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

        // Checando se campos obrigatorios foram preechidos
        if(!$firstName || !$lastName || !$birthDay || !$birthMonth || !$birthYear || !isset($sex) || !$rg ||!$email) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/alunos/alterar?student=$id");
            return true;
        }

        // Validando data de nascimento
        if(!checkdate($birthMonth, $birthDay, $birthYear)) {
            $_SESSION['msg'] = 'Data de nascimento inválida!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/alunos/alterar?student=$id");
            return true;
        }

        $birth = DateTime::createFromFormat('d/m/y', "$birthDay/$birthMonth/$birthYear");
        $birth = new DateTime("$birthYear-$birthMonth-$birthDay");
        $birth = $birth->format('Y-m-d');

        if($birth > date('Y-m-d')) {
            $_SESSION['msg'] = 'Data de nascimento inválida!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/alunos/alterar?student=$id");
            return true;
        }

        // Validando RG
        $CheckStudent = new \Sts\Models\Student\Read();
        if($student['rg'] !== $rg) {
            $checkRG = $CheckStudent->studentRG($rg);

            if($checkRG) {
                $_SESSION['msg'] = 'RG já cadastrado!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/dashboard/alunos/alterar?student=$id");
                return true;
            }
        }

        // Validando E-Mail
        $CheckEmployee = new \Sts\Models\Employee\Read();

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg'] = 'E-Mail inválido!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/dashboard/alunos/alterar?student=$id");
            return true;
        }

        if($student['email'] !== $email) {
            $checkEmail = $CheckStudent->studentEmail($email);
            if(!$checkEmail) $checkEmail = $CheckEmployee->employeeEmail($email);
    
            if($checkEmail) {
                $_SESSION['msg'] = 'E-Mail já cadastrado!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/dashboard/alunos/alterar?student=$id");
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
                header("Location:  $this->url/dashboard/alunos/alterar?student=$id");
                return true;
            }

            // Telefone
            if(strlen($phone) < 8 || strlen($phone) > 9) {
                $_SESSION['msg'] = 'Telefone Inválido!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/dashboard/alunos/alterar?student=$id");
                return true;
            }

            $result['ddd'] = $ddd;
            $result['phone'] = $phone;
        }

        // Remover foto caso remove-delete foi setado
        if($removePhoto) {
            $directoryPhoto = 'assets/img/students/';

            if($student['photo']) {
                unlink($directoryPhoto . $student['photo']);
                $result['photo'] = null;
            }

        } else {
            $result['photo'] = $student['photo'];
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

        // Enviando ao Model
        $End = new \Sts\Models\Student\Update();
        $End->updateStudent($result);

        $_SESSION['msg'] = 'Aluno alterado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/alunos/alterar?student=$id");

        return true;  
    }
    

    // -------------------- FUNCAO PARA ALTERAR SITUACAO DO ALUNO --------------------
    public function updateSituation() {
        $id = $_POST['id'];


        // Buscando situacao do aluno
        $Student = new \Sts\Models\Student\Read;
        $student = $Student->studentId($id);
        $situation = $student['situation'];

        // Preparando array para enviar ao Model
        $result['id'] = $id;
        $result['situation'] = $situation ? false : true;
        
        // Definindo mensagem de retorno com base na situacao
        $name = $student['fullName'];
        $msg = $situation ? "<b>$name</b> desativado com sucesso!" : "<b>$name</b> ativado com sucesso!";

        // Enviando ao Model
        $End = new \Sts\Models\Student\Update();
        $End->updateSituation($result);

        $_SESSION['msg'] = $msg;
        $_SESSION['msg-type'] = 'success';
        header("Location: #");

        return true;
    }



    // -------------------- FUNCAO PARA ALTERAR MINHA CONTA --------------------
    public function updateMyAccount() {
        $id = $_SESSION['student']['id'];
        $directory = 'assets/img/students/';
        
        $Student = new \Sts\Models\Student\Read();
        $Employee = new \Sts\Models\Employee\Read();
        $student = $Student->studentId($id);

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
            header("Location:  $this->url/aluno/minhaConta");
            return true;
        }

        // Validando data de nascimento
        if(!checkdate($birthMonth, $birthDay, $birthYear)) {
            $_SESSION['msg'] = 'Data de nascimento inválida!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/aluno/minhaConta");
            return true;
        }

        $birth = DateTime::createFromFormat('d/m/y', "$birthDay/$birthMonth/$birthYear");
        $birth = new DateTime("$birthYear-$birthMonth-$birthDay");
        $birth = $birth->format('Y-m-d');

        if($birth > date('Y-m-d')) {
            $_SESSION['msg'] = 'Data de nascimento inválida!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/aluno/minhaConta");
            return true;
        }

        // Validando RG
        if($student['rg'] !== $rg) {
            $checkRG = $Student->studentRG($rg);
    
            if($checkRG) {
                $_SESSION['msg'] = 'RG já cadastrado!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/aluno/minhaConta");
                return true;
            }
        }

        // Validando E-Mail
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['msg'] = 'E-Mail inválido!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/aluno/minhaConta");
            return true;
        }

        if($student['email'] !== $email) {
            $checkEmail = $Student->studentEmail($email);
            if(!$checkEmail) $checkEmail = $Employee->employeeEmail($email);
    
    
            if($checkEmail) {
                $_SESSION['msg'] = 'E-Mail já cadastrado!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/aluno/minhaConta");
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
                header("Location:  $this->url/aluno/minhaConta");
                return true;
            }

            // Telefone
            if(strlen($phone) < 8 || strlen($phone) > 9) {
                $_SESSION['msg'] = 'Telefone Inválido!';
                $_SESSION['msg-type'] = 'error';
                header("Location:  $this->url/aluno/minhaConta");
                return true;
            }

            $result['ddd'] = $ddd;
            $result['phone'] = $phone;
        }


        // Remover foto caso remove-delete foi setado
        if($removePhoto) {
            if($student['photo']) {
                unlink($directory . $student['photo']);
                $result['photo'] = null;
            }

        } else {
            $result['photo'] = $student['photo'];
        }

        // Criando foto caso mande
        if($_FILES['photo']['name']) {
            $photo = $student['photo'];

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
        $_SESSION['student']['first_name'] = $result['firstName'];
        $_SESSION['student']['last_name'] = $result['lastName'];
        $_SESSION['student']['email'] = $result['email'];
        $_SESSION['student']['photo'] = $result['photo'];


        // Enviando ao Model
        $End = new \Sts\Models\Student\Update();
        $End->updateMyAccount($result);

        $_SESSION['msg'] = 'Conta alterada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/aluno/minhaConta");

        return true;        
    }


    // -------------------- FUNCAO PARA ALTERAR MINHA SENHA --------------------
    public function updateMyPassword() {
        $id = $_SESSION['student']['id'];

        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        // Validando campos obrigatorios
        if(!$password || !$confirmPassword) {
            $_SESSION['msg'] = 'Digite uma senha!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/aluno/minhaConta");
            return true;
        }

        // Checando se password e confirmPassword sao iguais
        if($password !== $confirmPassword) {
            $_SESSION['msg'] = 'Confirme sua senha corretamente!';
            $_SESSION['msg-type'] = 'error';
            header("Location:  $this->url/aluno/minhaConta");
            return true;
        }


        $cryptoPass = sha1($password);
        
        // Enviando ao Model
        $End = new \Sts\Models\Student\Update();
        $End->updateMyPassword($id, $cryptoPass);
        $_SESSION['msg'] = 'Senha alterada com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/aluno/minhaConta");

        return true;
    }


} 