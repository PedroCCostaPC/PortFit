<?php

/**
 * Classe para bloquear acesso direto aos arquivos
 */

class BlockFile {
    public function returnFile() {
        if(!defined('P1E4D7R2O5')) {
            header("Location: /");
            die("Erro: Pagina nao encontrada!");
        }
    }
}

$returnFile = new BlockFile();
$returnFile->returnFile();