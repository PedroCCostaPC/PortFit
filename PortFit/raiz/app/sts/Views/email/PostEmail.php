<?php

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 2) . '/layout/EmailHeader.php');
require_once(dirname(__FILE__, 2) . '/layout/EmailFooter.php');

// E-Mail de criação do funcionario
class PostEmail {
    /**
     * @var string $url -> variavel para link inicial do projeto
     * @var string $academy -> variavel para nome da academia (empresa)
     */
    private $url = URL;

    public function create($id, $name, $banner, $post) {
        $primaryColor = PRIMARY_COLOR;
        $secondaryColor = SECONDARY_COLOR;

        $text = headerEmail() . 
                "
                <!-- CORPO -->
                <table align='center' style='width: 100%; max-width: 700px; border-collapse: collapse;'>
                    <tr>
                        <td>
                            <table align='center' style='width: 100%; max-width: 700px; border-collapse: collapse;'>
                                <tr>
                                    <td style='background: #fff;'>
                            
                                        <img style='width: 100%;' src='" . $banner . "'>
                            
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <table align='center' style='width: 100%; max-width: 700px; border-collapse: collapse;'>

                                <tr>
                                    <td style='padding: 20px 30px;'>
                                        <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; color: " . $secondaryColor . "; font-size: 20px;'>
                                            <b style='font-family: Verdana, Geneva, Tahoma, sans-serif; color: " . $secondaryColor . "; font-size: 20px;'>
                                                Olá, " . $name . ". Tudo bem por aí?
                                            </b>
                                        </p>                           
                                        
                                    </td>
                                </tr>

                                <tr>
                                    <td style='padding: 20px 30px;'>
                                        " . $post . "
                                        
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style='padding-bottom: 50px;'>
                            
                            <table align='center'>
                                <tr>
                                    <td>

                                        <a href='" . $this->url . "/blog/post?key=" . $id . "' style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; color: #ffffff; text-decoration: none;'>
                                            <table align='center' style='background-color: " . $secondaryColor . "; width: 200px; height: 70px; border-radius: 5px; text-align: center;'>
                                                <tr>
                                                    <td>
                                                        <b style='color: " . $primaryColor . ";'>
                                                            Veja Mais
                                                        </b>
                                                    </td>
                                                </tr>
                                            </table>
                                        </a>

                                    </td>
                                </tr>
                            </table>

                        </td>
                    </tr>

                </table>
                " 
                . footerEmail();

        return $text;
    }

}