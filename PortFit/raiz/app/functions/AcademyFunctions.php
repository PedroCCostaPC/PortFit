<?php
require_once(dirname(__FILE__, 3) . '/core/BlockFile.php'); 

// ---------------------------------------------------------------------------------------
// FUNCAO PARA FORMATAR ACADEMIA PARA VIEW
function academyFormat($academy, $form) {

    $result['id'] = $academy['id'];
    $result['banner'] = $academy['banner'];
    $result['state'] = $academy['state'];
    $result['uf'] = $academy['uf'];
    $result['address'] = $academy['address'];
    $result['road'] = $academy['road'];
    $result['cep'] = $academy['cep'];
    $result['number'] = $academy['number'];
    $result['map'] = $academy['map'];
    
    // Formata para form do dashboard 
    if($form) {
        // Horarios
        $result['openHourWeek'] = timeForm($academy['openWeek'], 0);
        $result['openMinuteWeek'] = timeForm($academy['openWeek'], 1);
        $result['closeHourWeek'] = timeForm($academy['closeWeek'], 0);
        $result['closeMinuteWeek'] = timeForm($academy['closeWeek'], 1);

        $result['openHourHoliday'] = timeForm($academy['openHoliday'], 0);
        $result['openMinuteHoliday'] = timeForm($academy['openHoliday'], 1);
        $result['closeHourHoliday'] = timeForm($academy['closeHoliday'], 0);
        $result['closeMinuteHoliday'] = timeForm($academy['closeHoliday'], 1);

        $result['openHourSaturday'] = timeForm($academy['openSaturday'], 0);
        $result['openMinuteSaturday'] = timeForm($academy['openSaturday'], 1);
        $result['closeHourSaturday'] = timeForm($academy['closeSaturday'], 0);
        $result['closeMinuteSaturday'] = timeForm($academy['closeSaturday'], 1);
        
        $result['openHourSunday'] = timeForm($academy['openSunday'], 0);
        $result['openMinuteSunday'] = timeForm($academy['openSunday'], 1);
        $result['closeHourSunday'] = timeForm($academy['closeSunday'], 0);
        $result['closeMinuteSunday'] = timeForm($academy['closeSunday'], 1);
        
    // Formata para paginas publicas
    } else {
        // Horarios
        $result['timeWeek'] = formatTime($academy['openWeek'], $academy['closeWeek']);
        $result['timeHoliday'] = formatTime($academy['openHoliday'], $academy['closeHoliday']);
        $result['timeSaturday'] = formatTime($academy['openSaturday'], $academy['closeSaturday']);
        $result['timeSunday'] = formatTime($academy['openSunday'], $academy['closeSunday']);
    }



    return $result;
}


// FUNCAO PARA FORMATAR HORARIOS PARA VIEW
function formatTime($open, $close) {

    $openArray = explode(':', $open);
    $closeArray = explode(':', $close);

    if(!$open && !$close) {
        $result = 'Fechado';
    } elseif($open === '00:00:00' && $close === '00:00:00') {
        $result = '24 Horas';
    } else {
        $open = $openArray[0]. ':' . $openArray[1];
        $close = $closeArray[0]. ':' . $closeArray[1];

        $result = $open . ' - ' . $close;
    }

    return $result;
}

// FUNCAO PARA FORMATAR HORARIOS PARA FORMULARIO (DASHBOAD)
function timeForm($time, $house) {

    $timeArray = explode(':', $time);

    $result = isset($timeArray[$house]) ? $timeArray[$house] : null;

    return $result;
}

// FUNCAO PARA FORMATAR TELEFONE DA ACADEMIA
function formatPhone($ddd, $phone) {

    if($ddd && $phone) {
        $front = substr($phone, 0, -4);
        $back = substr($phone, -4);

        $phone = "$front-$back";
        $result = "($ddd) $phone";
    } else {
        $result = null;
    }

    return $result;

}