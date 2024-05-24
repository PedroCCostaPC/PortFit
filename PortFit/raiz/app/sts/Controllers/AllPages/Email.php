<?php

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 5) . '/vendor/autoload.php');


// CLASSE PARA CONTAR QUANTIDADE DE EMAIL NAO LIDOS
class EmailView {
    function view() {
        $Email = new \Sts\Models\Email\Read();
        $email = $Email->countUnread(false);

        return $email;
    }
}

$Email = new EmailView();
$emailView = $Email->view();
$emailView = $emailView['view'];

