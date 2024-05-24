<?php
namespace Sts\Controllers\Dashboard;

use CreateAcademy;
use DeleteAcademy;
use UpdateAcademy;

require_once(dirname(__FILE__, 5) . '/core/BlockFile.php');
require_once(dirname(__FILE__, 4) . '/helpers/EmployeeCheck.php');
require_once(dirname(__FILE__, 4) . '/functions/AcademyFunctions.php');
require_once(dirname(__FILE__, 4) . '/functions/SocialFunctions.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Create/AcademyCreate.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Update/AcademyUpdate.php');
require_once(dirname(__FILE__, 2) . '/CRUD/Delete/AcademyDelete.php');



/**
 * Controller da página dashboard -> academia
 * 
 * @author Pedro <pedro.ccosta@hotmail.com>
 */

 class Academia {
    /**
     * @var string $url variavel para link inicial do projeto
     */
    private $url = URL;

    /**
    * @var array|string|null $data Recebe os dados que devem ser enviados para VIEW */
    private array|string|null $data;

    /**
     *Instanciar a classe responsável em carregar a View
     * @return void
     */

    public function index() {

        $Academy = new \Sts\Models\Academy\Read();
        $academy = $Academy->academy();

        // Caso academia foi cadastrada
        if($academy) {
            $contact = $Academy->contact($academy['id']);
    
            /**
             * @function academyFormat -> Formata as informacoes da academia para VIEW
             * academyFormat recebe array com os dados da academia e Boolean
             * True -> formata horário para o form no dashboard
             * False -> formata horário para as páginas comuns
             * diretório da funcao -> app/functions/AcademyFunciotns.php
             */
            $academy = academyFormat($academy, true);
            $this->data['academy'] = $academy;
    
    
            // Pegando contato principal
            if($contact) {
                $this->data['contact']['id'] = $contact[0]['id'];
                $this->data['contact']['email'] = $contact[0]['email'];
                $this->data['contact']['ddd'] = $contact[0]['ddd'];
                $this->data['contact']['phone'] = $contact[0]['phone'];
                $this->data['contact']['dddSapp'] = $contact[0]['dddSapp'];
                $this->data['contact']['whatsapp'] = $contact[0]['whatsapp'];
            }
    
    
            // Formatando fotos
            $photos = $Academy->selectPhotos($academy['id']);
            $this->data['photos'] = $photos;
    
    
            // Formatando Redes sociais
            $Social = new \Sts\Models\Social\Read();
            $social = $Social->social($academy['id']);
            for($i = 0; $i < count($social); $i++) {
                /**
                 * @function formatSocial -> Formata as redes sociais para VIEW
                 * formatSocial recebe array com os dados da academia e Boolean
                 * True -> formata rede social para o form no dashboard
                 * False -> formata rede social para as páginas comuns
                 * diretório da funcao -> app/functions/SocialFunctions.php
                 */
                $this->data['social'][$i] = formatSocial($social[$i], true);
            }

        } else {
            $this->data = null;
        }


        // -------------------- MANIPULANDO FORMULARIO RECEBIDO POR POST

        // FORMULARIO LOCALIZACAO
        // Checando se existe $_POST['location']
        if(isset($_POST['location'])) {
            // Criar - Caso ainda não exista registro da academia
            if(!$academy) {
                $Create = new CreateAcademy();
                // Retorna para pagina 'academia' caso form erro ou sucesso
                $return = $Create->newUnit(true);
                if($return) {
                    return $this->data;
                }


            // Alterar - Caso exite registro da academia
            } else {
                $Update = new UpdateAcademy();
                // Retorna para pagina 'academia' caso form erro ou sucesso
                $return = $Update->updateUnit($academy['id']);
                if($return) {
                    return $this->data;
                }
            }
        }


        // FORMULARIO CONTATO
        if(isset($_POST['contact'])) {
            // Checa se existe academia cadastrada
            if(!$academy) {
                $_SESSION['msg'] = 'Informe primeiro o <b>endereço</b> da academia!';
                $_SESSION['msg-type'] = 'error';
                header("Location: $this->url/dashboard/academia");
                return true;

            } else {
                // Para criar contato caso ainda nao exista
                if(!isset($_POST['contact-id'])) {
                    $Create = new CreateAcademy();
                    // Retorna para pagina 'academia' caso form erro ou sucesso
                    $return = $Create->newContact($academy['id']);
                    if($return) {
                        return $this->data;
                    }

                // Para alterar contato caso ja exista
                } else {
                    $Update = new UpdateAcademy();
                    // Retorna para pagina 'academia' caso form erro ou sucesso
                    $return = $Update->updateContact();
                    if($return) {
                        return $this->data;
                    }
                }
            }
        }


        // FORMULARIO DE HORARIOS
        if(isset($_POST['time'])) {
            // Checa se existe academia cadastrada
            if(!$academy) {
                $_SESSION['msg'] = 'Informe primeiro o <b>endereço</b> da academia!';
                $_SESSION['msg-type'] = 'error';
                header("Location: $this->url/dashboard/academia");
                return true;

            // Montando horaios
            } else {
                $Update = new UpdateAcademy();
                // Retorna para pagina 'academia' caso form erro ou sucesso
                $return = $Update->updateTime($academy['id']);
                if($return) {
                    return $this->data;
                }
            }
        }


        // FORMUALRIO DE FOTOS
        if(isset($_POST['photo'])) {
            // Checa se existe academia cadastrada
            if(!$academy) {
                $_SESSION['msg'] = 'Informe primeiro o <b>endereço</b> da academia!';
                $_SESSION['msg-type'] = 'error';
                header("Location: $this->url/dashboard/academia");
                return true;

            // Criando as fotos
            } else {
                $Create = new CreateAcademy();
                // Retorna para pagina 'academia' caso form erro ou sucesso
                $return = $Create->newPhotos($academy['id']);
                if($return) {
                    return $this->data;
                }
            }
        }

        // FORMULARIO PARA EXCLUIR FOTOS
        if(isset($_POST['delete-photo'])) {
            $Delete = new DeleteAcademy();
            // Retorna para pagina 'academia' caso form erro ou sucesso
            $return = $Delete->deletePhoto();
            if($return) {
                return $this->data;
            }
        }


        // FORMULARIO PARA CRIAR REDES SOCIAIS
        if(isset($_POST['social'])) {
            // Checa se existe academia cadastrada
            if(!$academy) {
                $_SESSION['msg'] = 'Informe primeiro o <b>endereço</b> da academia!';
                $_SESSION['msg-type'] = 'error';
                header("Location: $this->url/dashboard/academia");
                return true;

            } else {
                $Create = new CreateAcademy();
                // Retorna para pagina 'academia' caso form erro ou sucesso
                $return = $Create->newSocial($academy['id']);
                if($return) {
                    return $this->data;
                }
            }
        }

        // FORMULARIO PARA ALTERAR REDES SOCIAIS
        if(isset($_POST['update-social'])) {
            $Update = new UpdateAcademy();
             // Retorna para pagina 'academia' caso form erro ou sucesso
            $return = $Update->updateSocial();
            if($return) {
                return $this->data;
            }
        }

        // FORMULARIO PARA EXCLUIR REDES SOCIAIS
        if(isset($_POST['delete-social'])) {
            $Update = new DeleteAcademy();
             // Retorna para pagina 'academia' caso form erro ou sucesso
            $return = $Update->deleteSocial();
            if($return) {
                return $this->data;
            }
        }

        $this->data['block-nav'] = true;
        $this->data['title-dash'] = true;
        
        $loadView = new \Core\ConfigView("sts/views/dashboard/academy", $this->data);
        $loadView->loadView();
    }
}
