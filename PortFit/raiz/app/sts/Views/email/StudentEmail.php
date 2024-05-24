<?php

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 2) . '/layout/EmailHeader.php');
require_once(dirname(__FILE__, 2) . '/layout/EmailFooter.php');

// E-Mail de criação do aluno
class StudentEmail {
    /**
     * @var string $url -> variavel para link inicial do projeto
     * @var string $academy -> variavel para nome da academia (empresa)
     */
    private $url = URL;
    private $academy = ACADEMY;

    public function create($name, $password) {
        $primaryColor = PRIMARY_COLOR;
        $secondaryColor = SECONDARY_COLOR;

        $text = headerEmail() . 
                "
                <!-- CORPO -->
                <table align='center' style='width: 100%; max-width: 700px;'>
                    <tr>
                        <td style='padding: 20px 30px;'>
                            <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 18px; color: " . $secondaryColor . ";'>
                                <b>Olá " . $name . "!</b>
                            </p>

                            <br>

                            <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; line-height: 25px; color: " . $primaryColor . ";'>
                                Sua conta na <b style='color: " . $secondaryColor . ";'>" . $this->academy ."</b> foi realizada com sucesso. <br>
                                Agora você poderá acompanhar suas <b>avaliações física</b>, <b>lista de treino</b>, <b>alimentação</b> e <b>evolução</b>.
                            </p>
                            <br>


                            <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; line-height: 25px; color: " . $primaryColor . ";'>
                                Você pode acessar sua área do aluno com esse mesmo email e a senha abaixo:
                            </p>

                            <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 25px; line-height: 25px; color: " . $primaryColor . "; text-align: center;'>
                                <b>" . $password . "</b>
                            </p>

                            <br>
                            <p style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; line-height: 25px; color: " . $primaryColor . ";'>
                                <b>NOTA</b>: Você pode alterar sua senha a qualquer momento na sua área do aluno.
                            </p>
                        </td>
                    </tr>


                    <tr>
                        <td style='padding-bottom: 50px;'>
                            
                            <table align='center'>
                                <tr>
                                    <td>

                                        <a href='" . $this->url . "/aluno' style='font-family: Verdana, Geneva, Tahoma, sans-serif; font-size: 14px; color: " . $primaryColor . "; text-decoration: none;'>
                                            <table align='center' style='background-color: " . $secondaryColor . "; width: 200px; height: 70px; border-radius: 5px; text-align: center;'>
                                                <tr>
                                                    <td>
                                                        <b>
                                                            Fazer Login
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