<?php
require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');

function headerEmail() {
    /**
    * @var string $url -> variavel para link inicial do projeto
    */
    $url = URL;
    $primaryColor = PRIMARY_COLOR;
    $secondaryColor = SECONDARY_COLOR;


    $header = "
        <!-- HEADER -->
        <table align='center' style='width: 100%; max-width: 700px; border-collapse: collapse;'>
            <tr>
                <td style='background-color: ". $primaryColor . "; height: 110px; text-align: center;'>
        
                    <a href='" . $url . "'>
                        <img src='" . $url . "/assets/img/logoEmail.png' style='height: 60px;'>
                    </a>
        
                </td>
            </tr>
        </table>
    ";

    return $header;
}
