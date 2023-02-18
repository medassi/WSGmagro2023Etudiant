<?php

session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Europe/Paris');
require_once 'config.php';

spl_autoload_register(function ($className) {
    $classNameR = str_replace("\\", DIRECTORY_SEPARATOR, $className);
    include_once 'src/' . $classNameR . '.php';
});

use wscontrollers\WSIntervenantController;
use wscontrollers\WSInterventionController;
use wscontrollers\WSActiviteController;
use wscontrollers\WSMachineController;
use wscontrollers\WSCSODController;
use wscontrollers\WSInterventionIntervenantController;

$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (isset($_SESSION['intervenant'])) {
    if ($uc && $action) {
        switch ($uc) {
            case 'intervenant':
                new WSIntervenantController($action);
                break;
            case 'intervention':
                new WSInterventionController($action);
                break;
            case 'activite':
                new WSActiviteController($action);
                break;
            case 'machine':
                new WSMachineController($action);
                break;
            case 'csod':
                new WSCSODController($action);
                break;
            case 'intervention_intervenant':
                new WSInterventionIntervenantController($action);
                break;
            default:
                echo new \WSJSONResponse($uc, null, false, "uc non reconnu");
        }
    } else {
        echo new \WSJSONResponse(null, null, false, "uc et action non définis (connexion ok)");
    }
} else {
    if ($uc && $action) {
        switch ($uc) {
            case 'intervenant':
                $intervenantController = new WSIntervenantController($action);
                break;
            default :
                echo new \WSJSONResponse(null, null, false, "uc non reconnu (connexion echouée)");
        }
    } else {
        echo new \WSJSONResponse(null, null, false, "uc et action non définis (connexion echouée)");
    }
}
            
            
            
            
            