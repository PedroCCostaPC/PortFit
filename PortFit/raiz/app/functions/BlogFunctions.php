<?php
require_once(dirname(__FILE__, 3) . '/core/BlockFile.php'); 

// ---------------------------------------------------------------------------------------
// FUNCAO PARA FORMATAR BLOG PARA VIEW
function formatBlog($post, $summary) {

    $result['id'] = $post['id'];
    $result['banner'] = $post['banner'];
    $result['title'] = $post['title'];
    
    // Envia resumo para pagina onde mostra apenas parte do texto
    if($summary) {
        $result['summary'] = strip_tags($post['post'], '<p>');
        $result['summary'] = substr($result['summary'], 0, 200) . '...';
        
        // Envia post completo
    } else {
        $result['post'] = $post['post'];
    }
    
    $result['author'] = $post['author'];
    $result['photo'] = $post['photo'];
    $result['published'] = formatDate($post['published']);

    return $result;
}


// FUNCAO PARA FORMATAR DATA DE PUBLICACAO
function formatDate($date) {
    $dateArray = explode('-', $date);

    $result = $dateArray['2'] . '/' . $dateArray ['1'] . '/' . $dateArray ['0'];

    return $result;
}