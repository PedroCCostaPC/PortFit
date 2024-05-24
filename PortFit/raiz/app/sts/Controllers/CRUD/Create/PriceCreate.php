<?php
require_once(dirname(__FILE__, 6) . '/core/BlockFile.php');

/**
 * Class CreatePrice -> Responsável por criar Precos
 */
class CreatePrice {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    /**
     * Funcao para criar precos
     */
    public function newPrice() {
        // checando se existe input month
        if(!isset($_POST['month'])) {
            $_SESSION['msg'] = 'Informe se é mês ou ano!';
            $_SESSION['msg-type'] = 'error';
            header("Location: $this->url/dashboard/precos/adicionar");
            return true;
        }

        // Retorna erro caso nao haja scheme
        if(!isset($_POST['scheme'])) {
            $_SESSION['msg'] = 'Informe ao menos um item!';
            $_SESSION['msg-type'] = 'error';
            header("Location: $this->url/dashboard/precos/adicionar");
            return true;
        }

        $name = $_POST['name'];
        $time = $_POST['time'];
        $price = $_POST['price'];
        $month = intval($_POST['month']);
        $scheme = array_filter($_POST['scheme']);

        // Retorna erro caso campos nao preenchidos
        if(!$name || !$time || !$price || !$scheme) {
            $_SESSION['msg'] = 'Preencha todos os campos obrigatórios!';
            $_SESSION['msg-type'] = 'error';
            header("Location: $this->url/dashboard/precos/adicionar");
            return true;
        }

        // Preparando array de preco para enviar ao Model
        $priceResult['name'] = ucfirst($name);
        $priceResult['time'] = intval($time);
        $priceResult['price'] = floatval($price);
        $priceResult['month'] = (intval($month) === 1) ? true : false;
        $priceResult['emphasis'] = false;
        $priceResult['situation'] = true;

        // Enviando Preco ao Model
        $End = new \Sts\Models\Price\Create();
        $End->createPrice($priceResult);


        // Buscando ultimo preco para criar schemes
        $lastPrice = new \Sts\Models\Price\Read();
        $lastPrice = $lastPrice->lastPrice();
        $lastPrice = $lastPrice['id'];

        // Preparando scheme e enviando ao Model
        $scheme = array_values($scheme);
        foreach($scheme as $sche) {
            $End->createScheme(ucfirst($sche), $lastPrice);
        }


        $_SESSION['msg'] = 'Preço salvo com sucesso!';
        $_SESSION['msg-type'] = 'success';
        header("Location: $this->url/dashboard/precos");

        return true;
    }
}