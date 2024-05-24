<?php

namespace Core;
require_once(dirname(__FILE__) . '/BlockFile.php'); 

/**
 * Carregar as páginas da View
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */
class ConfigView {
    /**
     * Receber o endereço da VIEW e os dados.
     * @param string $nameView Endereço da VIEW que deve ser carregada
     * @param array|string|null $data Dados que a VIEW deve receber.
     * 
     */
    public function __construct(private string $nameView, private array|string|null $data) {
    }

    /**
     * Carregar a VIEW
     * Verificar se o arquivo existe, e carregar caso exista, não existindo para o carregamento
     *
     * @return void
     */
    public function loadView(): void {
        if(file_exists('app/' . $this->nameView . '.php')) {
            include 'app/sts/Views/layout/header.php';
            include 'app/' . $this->nameView . '.php';
            include 'app/sts/Views/layout/footer.php';
        } else {
            die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato com o administrador " . EMAILADM);
            // include 'app/sts/views/error.php';
        }
    }
}