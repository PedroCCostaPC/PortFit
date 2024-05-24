<?php
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');

/**
 * @param ImageCreate -> para criar imagens enviadas por forumlario
 * Aceita imagem tipo PNG e JPG
 */
class ImageCreate {
    
    /**
     * function new Image
     *
     * @param array $file -> Recebe o $_FILES para tratar a imagem
     * @param string $directory -> Recebe o diretorio onde sera salvo a imagem
     * @param string $firstName -> Recebe o primeiro nome da imagem
     * @param string $oldName -> Checa se é para criar um novo dado ou alterar um ja existente
     * OPICIONAL O ENVIO
     * Caso nao envie, recebe valor 'Null' como padrao
     * Null -> significa que é para deletar antiga e criar nova imagem
     * @return void
     */
    public function newImage(array $file, string $directory, string $firstName, string $oldName = null) {
        
        // Definindo Extensao
        $extension = strtolower(substr($file[$firstName]['name'], -4));

        // Validando se é png ou jpg
        if($extension !== '.jpg' && $extension !== '.png') {
            $_SESSION['msg'] = 'Imagem deve ser <b>jpg</b> ou <b>png</b>';
            $_SESSION['msg-type'] = 'error';
            return;
        }


        // Deletando foto antiga, caso ja exista registro
        if($oldName) {
            unlink($directory . $oldName);
        }


        // Definindo nome
        $date = date('Y_m_d_H_m_s');
        $name = $firstName . '_' . $date . $extension;

        move_uploaded_file($file[$firstName]['tmp_name'], $directory.$name);

        return $name;
    }
}