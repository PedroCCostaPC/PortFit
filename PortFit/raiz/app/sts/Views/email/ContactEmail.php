<?php

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 2) . '/layout/EmailHeader.php');
require_once(dirname(__FILE__, 2) . '/layout/EmailFooter.php');

// E-Mail de criação do aluno
class ContactEmail {
    /**
     * @var string $url -> variavel para link inicial do projeto
     * @var string $academy -> variavel para nome da academia (empresa)
     */
    private $url = URL;
    private $academy = ACADEMY;

    public function create($contact) {

        $name = $contact['name'];
        $email = $contact['email'];
        $date = $contact['date'];
        $time = $contact['time'];
        $phone = $contact['phone'];
        $student = $contact['student'];
        $message = $contact['message'];

        $primaryColor = PRIMARY_COLOR;
        $secondaryColor = SECONDARY_COLOR;


        $text = headerEmail() . 
                "
                <!-- CORPO -->
                <table align='center' style='width: 100%; max-width: 700px;'>
                    <tr>
                        <td>
                            <table align='center' style='width: 100%; max-width: 700px;  border: solid 1px #b3b3b3;'>
                                <tr>
                                    <td style='padding: 20px; background: #ededed;'>
                            
                                        <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; color: " . $primaryColor . "; text-align: left;'>
                                            <b><span style='color: " . $secondaryColor . ";'>Nome:</span> " . $name . "</b>
                                        </p>
                            
                                        <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; color: " . $primaryColor . "; text-align: left;'>
                                            <b><span style='color: " . $secondaryColor . ";'>Email:</span> " . $email . "</b>
                                        </p>
                            
                                    </td>
                            
                                    <td style='padding: 20px; background: #ededed;'>
                            
                                        <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; color: " . $primaryColor . "; text-align: left;'>
                                            <b>" . $date . "</b>
                                        </p>
                                        <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; color: " . $primaryColor . "; text-align: left;'>
                                            <b>" . $time . "</b>
                                        </p>
                            
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>


                    <tr>
                        <td>
                            <table align='center' style='width: 100%; max-width: 700px;'>

                                <tr>
                                    <td style='padding: 20px 30px;'>
                                        <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; line-height: 25px; color: " . $primaryColor . ";'>
                                            <b style='color: " . $secondaryColor . ";'>Telefone:</b> " . $phone . "
                                        </p>
                            
                            
                                        <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; line-height: 25px; color: " . $primaryColor . ";'>
                                            <b style='color: " . $secondaryColor . ";'>Aluno:</b> " . $student . "
                                        </p>
                            
                                        <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; line-height: 25px; color: " . $primaryColor . ";'>
                                            <b style='color: " . $secondaryColor . ";'>Mensagem:</b> " . $message . " 
                                        </p>
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