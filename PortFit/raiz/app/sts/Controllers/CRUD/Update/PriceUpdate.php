<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php'); 
require_once(dirname(__FILE__, 2) . '/ImageCreate.php'); 

/**
 * Class UpdatePrice -> Responsável por alterar Precos
 */
class UpdatePrice {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    /**
     * Funcao para alterar preco
     */
    public function updatePrice($idPrice) {
        // checando se existe input month
        if(!isset($_POST['month'])) {
            $_SESSION['msg'] = 'Informe se é mês ou ano!';
            $_SESSION['msg-type'] = 'error';
            header("Location: $this->url/dashboard/precos/alterar?key=$idPrice");
            return true;
        }

        // Retorna erro caso nao haja scheme
        if(!isset($_POST['scheme'])) {
            $_SESSION['msg'] = 'Informe ao menos um item!';
            $_SESSION['msg-type'] = 'error';
            header("Location: $this->url/dashboard/precos/alterar?key=$idPrice");
            return true;
        }

        $name = ucfirst($_POST['name']);
        $time = $_POST['time'];
        $price = $_POST['price'];
        $month = intval($_POST['month']);
        $scheme = array_filter($_POST['scheme']);

        // Retorna erro caso campos nao preenchidos
        if(!$name || !$time || !$price || !$scheme) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location: $this->url/dashboard/precos/alterar?key=$idPrice");
            return true;
        }

        $scheme = array_values($scheme);
        for($i = 0; $i < count($scheme); $i++) {
            $scheme[$i] = ucfirst($scheme[$i]);
        }


        /**
         * Separando scheme do post que possui ID dos que no possuem
         * POSSUI ID -> scheme que ja estavam registrado no banco
         * NAO POSSUI ID - > scheme novos que foram inseridos no form
         */
        for($i = 0; $i < count($_POST['scheme']); $i++) {
            // scheme com ID
            if(isset($_POST['id'][$i])) {
                $oldScheme['id'][$i] = $_POST['id'][$i];
                $oldScheme['scheme'][$i] = $_POST['scheme'][$i];

                $schemeComparison[$i] = $_POST['id'][$i];

            // scheme sem ID
            } else {
                $newScheme['scheme'][$i] = $_POST['scheme'][$i];
            }
        }

        // Buscando schemes no banco para comparacao
        // O que for diferente sera removido do banco
        $SchemeDB = new \Sts\Models\Price\Read();
        $SchemeDB = $SchemeDB->schemePrice($idPrice);

        for($i = 0; $i < count($SchemeDB);  $i++) {
            $SchemeDB[$i] = $SchemeDB[$i]['id'];
        }

        if(isset($schemeComparison)) $trashScheme = array_diff($SchemeDB, $schemeComparison);

        // Excluir shcemes antigos do DB
        if(!isset($trashScheme)) {
            // EXCLUIR TODOS ANTIGOS
            $EndDeleteAll = new \Sts\Models\Price\Delete();
            foreach($SchemeDB as $id) {
                $EndDeleteAll->deleteScheme($id);
            }

        } elseif($trashScheme) {
            // Excluir somente os que nao retornaram
            $EndDelete = new \Sts\Models\Price\Delete();
            foreach($trashScheme as $id) {
                $EndDelete->deleteScheme($id);
            }
        }

        // Alterar os schemes antigos que retornaram
        if(isset($schemeComparison)) {
            for($i = 0; $i < count($oldScheme['id']); $i++) {
                $update[$i]['id'] = $oldScheme['id'][$i];
                $update[$i]['scheme'] = ucfirst($oldScheme['scheme'][$i]);
            }

            // Enviado ao Model para alterar
            foreach($update as $up) {
                $EndUpdate = new \Sts\Models\Price\Update();
                $EndUpdate->updateScheme($up);
            } 
        }

        // Novo scheme caso houver
        if(isset($newScheme)) {
            $newScheme['scheme'] = array_values($newScheme['scheme']);
            
            for($i = 0; $i < count($newScheme['scheme']); $i++) {
                if($newScheme['scheme'][$i]) $resultNew[$i] = ucfirst($newScheme['scheme'][$i]);
            }

            if(isset($resultNew)) {
                $resultNew = array_values($resultNew);

                // Enviado ao Model caso tenho novo horario para criar
                $Endnew = new \Sts\Models\Price\Create;
                foreach($resultNew as $new) {
                    $Endnew->createScheme($new, $idPrice);
                }
            }
        }
        
        // Preparando array para enviar ao Model
        $resultPrice['id'] = $idPrice;
        $resultPrice['name'] = $name;
        $resultPrice['time'] = $time;
        $resultPrice['price'] = $price;
        $resultPrice['month'] = $month;


        // Enviado ao Model para alterar
        $EndPrice = new \Sts\Models\Price\Update();
        $EndPrice->updatePrice($resultPrice);



        $_SESSION['msg'] = 'Horário alterado com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/precos/alterar?key=$idPrice");

        return true;
    }


    // -------------------- FUNCAO PARA ALTERAR SITUACAO DO PRECO --------------------
    public function updateSituation() {
        $id = $_POST['id'];

        // Buscando situacao do preco
        $Price = new \Sts\Models\Price\Read;
        $price = $Price->priceId($id);
        $situation = $price['situation'];


        // Preparando array para enviar ao Model
        $result['id'] = $id;
        $result['situation'] = $situation ? false : true;

        // Definindo mensagem de retorno com base na situacao
        $msg = $situation ? "Preço desativado com sucesso!" : "Preço ativado com sucesso!";


        // Enviando ao Model
        $End = new \Sts\Models\Price\Update();
        $End->updateSituation($result);

        $_SESSION['msg'] = $msg;
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/precos");

        return true;
    }


    // -------------------- FUNCAO PARA ALTERAR DESTAQUE DO PRECO --------------------
    public function updateEmphasis() {
        $id = $_POST['id'];

        // Buscando situacao do preco
        $Price = new \Sts\Models\Price\Read;
        $price = $Price->priceId($id);
        $emphasis = $price['emphasis'];


        // Preparando array para enviar ao Model
        $result['id'] = $id;
        $result['emphasis'] = $emphasis ? false : true;

        // Definindo mensagem de retorno com base na situacao
        $msg = $emphasis ? "Preço normalizado com sucesso!" : "Preço destacado com sucesso!";


        // Enviando ao Model
        $End = new \Sts\Models\Price\Update();
        if(!$emphasis) $End->updateAllEmphasis($result);
        $End->updateEmphasis($result);

        $_SESSION['msg'] = $msg;
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/precos");

        return true;
    }
}

