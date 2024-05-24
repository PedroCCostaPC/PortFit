<?php
    // Constante que define que o usuário está acessando páginas internas através da página "index.php".
    define('P1E4D7R2O5', true);

    // Carregar o Composer
    require './vendor/autoload.php';

    // Instanciar a classe ConfigController, responsável em tratar a URL
    $url = new Core\ConfigController();

    // Instanciar o método para carregar a página/controller
    $url->loadPage();
    
