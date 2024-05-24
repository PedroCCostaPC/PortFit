<?php
namespace Core;
require_once(dirname(__FILE__) . '/BlockFile.php');

// Definindo timeZone
date_default_timezone_set('America/Sao_Paulo');

session_start();

abstract class Config {
    protected function config(): void {
        // URL do projeto
        define('URL', 'http://localhost/projetos/GGGGGG/raiz');
        // define('URL', 'https://pedrocesarcosta.com.br/projetos/portfit');

        define('CONTROLLER', 'Home');
        define('CONTROLLERERRO', 'Error');

        // Credenciais do banco de dados
        define('HOST', '127.0.0.1');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'portfit2');
        define('PORT', 3306);

        // Define ID do Cargo Boss / Admin
        define('BOSS', 1);
        define('ADMIN', 2);

        // Define nome da academia
        define('ACADEMY', 'Port Fit');

        // Define cores principais da academia
        define('PRIMARY_COLOR', '#191919');
        define('SECONDARY_COLOR', '#98a100');


        // DDI do país
        define('DDI', 55);

        define('EMAILADM', 'empresa@email.com');
        define('EMAILHOST', '');
        define('EMAILPASS', 'senhaEmail');
        define('EMAILPORT', 000);
        define('EMAILNAME', 'Port Fit');
    }
}