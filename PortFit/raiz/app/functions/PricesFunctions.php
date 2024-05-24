<?php
require_once(dirname(__FILE__, 3) . '/core/BlockFile.php'); 


// ---------------------------------------------------------------------------------------

// FUNCAO PARA FORMATAR PRECOS PARA VIEW
function priceFormat($model, $price) {
    $result['id'] = $price['id'];
    $result['name'] = $price['name'];
    $result['time'] = $price['time'];
    $result['month'] = $price['month'];
    $result['emphasis'] = $price['emphasis'];


    // Tratando icone e classe(css) de mes ou ano
    if($price['month']) {
        $result['icon'] = 'month.png';
        $result['class'] = 'month';
    } else {
        $result['icon'] = 'year.png';
        $result['class'] = 'year';
    }

    // Tratando preco
    $priceArray = explode('.', $price['price']);
        
    $result['real'] = $priceArray[0];
    $penny = isset($priceArray[1]) ? $priceArray[1] : 0;
    $result['penny'] = (strlen($penny) < 2)? $penny . 0 : $penny;

    // Preco formatado
    $result['price'] = $result['real'] . ',' . $result['penny'];


    // Tratando planos do preco
    $schemes = $model->schemePrice($price['id']);
    $result['schemes'] = priceScheme($schemes);

    return $result;
}

// ---------------------------------------------------------------------------------------

// FUNCAO PARA FORMATAR PLANOS DO PRECO
function priceScheme($schemes) {
    for($i = 0; $i < count($schemes); $i++) {
        $result[$i]['id'] = $schemes[$i]['id'];
        $result[$i]['scheme'] = $schemes[$i]['scheme'];
    }
    return $result;
}



