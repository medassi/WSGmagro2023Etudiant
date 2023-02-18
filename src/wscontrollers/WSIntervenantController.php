<?php

namespace wscontrollers;

use repositories\IntervenantRepository;

class WSIntervenantController {

    private $action;

    public function __construct($action) {
        $this->action = $action;
        $this->run();
    }

    private function run() {
        switch ($this->action) {
            case 'connect':
                if (!isset($_SESSION['intervenant'])) {
                    $mail = filter_input(INPUT_GET, 'mail', FILTER_SANITIZE_EMAIL);
                    $password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING);
                    if ($mail && $password) {
                        $user = IntervenantRepository::ws_auth($mail, $password);
                        if ($user) {
                            if ($user->isActif()) {
                                $this->explodeToSession($user);
                                echo new \WSJSONResponse("intervenant", "connect", true, $user);
                            } else {
                                echo new \WSJSONResponse("intervenant", "connect", false, "Le compte est désactivé");
                            }
                        } else {
                            echo new \WSJSONResponse("intervenant", "connect", false, "Le couple login/mdp ne correspond pas");
                        }
                    }
                } else {
                    echo new \WSJSONResponse("intervenant", "connect", false, "Vous êtes déjà connecté en tant que ".$_SESSION['intervenant']['mail']);
                }
                break;
            case "disconnect":
                unset($_SESSION['intervenant']);
                session_destroy();
                echo new \WSJSONResponse("intervenant", "disconnect", true, null);
                break;
            default:
                echo new \WSJSONResponse("intervenant", $this->action, false, "action non définie");
        }
    }

    function explodeToSession($user) {
        $_SESSION['intervenant']['id'] = $user->getId();
        $_SESSION['intervenant']['nom'] = $user->getNom();
        $_SESSION['intervenant']['prenom'] = $user->getPrenom();
        $_SESSION['intervenant']['mail'] = $user->getMail();
        $_SESSION['intervenant']['role_code'] = $user->getRole_code();
        $_SESSION['intervenant']['site_uai'] = $user->getSite_uai();
    }

}
