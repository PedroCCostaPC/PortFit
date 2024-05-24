<?php
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/functions/AcademyFunctions.php');
require_once(dirname(__FILE__, 3) . '/Controllers/AllPages/AcademyContact.php');
require_once(dirname(__FILE__, 4) . '/functions/SocialFunctions.php');
require_once(dirname(__FILE__, 3) . '/Controllers/AllPages/Social.php');

// Funcao para enviar as redes sociais
function socials($social, $url) {
    $result = null;

    foreach($social as $soci) {

        $result = $result . "
            <td style='padding-left: 10px;'>
                <a href='" . $soci['link'] . "' style='color: #fff; font-size: 14px;'>
                    <img src='" . $url . "/assets/img/social/" . $soci['icon'] ."' alt='" . $soci['name'] . "' style='height: 25px;'>
                </a>
            </td>
        ";

    }

    return $result;
}

function footerEmail() {

    $url = URL;
    $Academy = new AcademyContact();
    $academy = $Academy->contact();
    $primaryColor = PRIMARY_COLOR;
    $secondaryColor = SECONDARY_COLOR;

    $Social = new Social();
    $social = $Social->social();

    

    $footer = "
        <!-- FOOTER -->
        <table align='center' style='width: 100%; max-width: 700px; border-collapse: collapse; border: 1px solid " . $primaryColor . ";'>
            <tr style='background-color: " . $primaryColor . "; border: 1px solid " . $primaryColor . ";'>
                <td style='padding: 20px;'>
        
                    <!-- CONTATOS -->
                    <table style='width: 100%;'>
                        <tr>
                            <td style='border-bottom: solid 2px " . $secondaryColor . "; padding: 0 20px;'>
                                <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; color: #fff; font-size: 16px;'>
                                    NOSSOS CONTATOS
                                </p>
                            </td>
                        </tr>
                    </table>
        
                    <table>
                        <tr>
                            <td style=' padding: 0 20px;'>
                                <p style='color: #fff; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px;'>
                                    <img style='height: 16px;' src='" . $url . "/assets/img/phone.png'> 
                                    " . $academy['contact'][0]['phone'] . "
                                </p>
        
                                <p style='color: #fff; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px;'>
                                    <img style='height: 16px;' src='" . $url . "/assets/img/zap.png'> 
                                    " . $academy['contact'][0]['whatsapp'] . "
                                </p>
        
                                <p style='color: #ffffff; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px;'>
                                    <img style='height: 16px;' src='" . $url . "/assets/img/email.png'> 
                                    <span style='color: #ffffff;'>" . $academy['contact'][0]['email'] . "</span>
                                </p>
                            </td>
                        </tr>
                    </table>
        
        
                    <!-- HORARIOS -->
                    <table style='width: 100%;'>
                        <tr>
                            <td style='border-bottom: solid 2px " . $secondaryColor . "; padding: 40px 20px 0 20px;'>
                                <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; color: #fff; font-size: 16px;'>
                                    NOSSOS HORÁRIOS
                                </p>
                            </td>
                        </tr>
                    </table>
        
                    <table align='center' style='width: 100%;'>
                        <tr>
                            <td style='padding: 0 20px;'>
                                <p style='color: #fff; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px;'>
                                    Segunda a Sexta: <br>
                                    <span style='font-size: 17px; color: " . $secondaryColor . ";'>" . $academy['timeWeek'] . "</span>
                                </p>
        
                                <p style='color: #fff; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px;'>
                                    Feriados: <br>
                                    <span style='font-size: 17px; color: " . $secondaryColor . ";'>" . $academy['timeHoliday'] . "</span>
                                </p>
                            </td>
        
                            <td>
                                <p style='color: #fff; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px;'>
                                    Sábado: <br>
                                    <span style='font-size: 17px; color: " . $secondaryColor . ";'>" . $academy['timeSaturday'] . "</span>
                                </p>
        
                                <p style='color: #fff; font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px;'>
                                    Domingo: <br>
                                    <span style='font-size: 17px; color: " . $secondaryColor . ";'>" . $academy['timeSunday'] . "</span>
                                </p>
                            </td>
                        </tr>
                    </table>
        
                    <table>
                        <tr>
                            <td style='padding: 30px 20px 0 20px;'>
                                <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; color: #fff; font-size: 14px;'>
                                    " . 
                                    $academy['address'] . ", " . $academy['road'] . ", " . $academy['number'] . " - " . $academy['state'] . " - " . $academy['uf']
                                    . "
                                </p>
                            </td>
                        </tr>
                    </table>
        
        
                    <!-- REDES SOCIAIS -->
                    <table align='right'>
                        <tr>
                            <td style='padding: 50px 20px 20px 20px;'>
        
                                <table>
                                    <tr>
                                        " . socials($social, $url) . "
                                    </tr>
                                </table>
        
                            </td>
                        </tr>
                    </table>
        
                </td>
            </tr>
        </table>
    ";

    return $footer;
}
