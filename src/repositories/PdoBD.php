<?php
namespace repositories ;

class PdoBD {
    private static $_serveur = 'mysql:host='.DBHOST.':'.DBPORT;
    private static $_bdd = 'dbname='.DBNAME;
    private static $_user = DBUSER;
    private static $_mdp = DBPASS;
    private static $_monPdo;
    private static $_instance = null;

    private function __construct() {
        PdoBD::$_monPdo = new \PDO(PdoBD::$_serveur . ';' . PdoBD::$_bdd, PdoBD::$_user, PdoBD::$_mdp);
        PdoBD::$_monPdo->query("SET CHARACTER SET utf8");
    }

    public function _destruct() {
        PdoBD::$_monPdo = null;
    }

    public static function getInstance() {
        if (PdoBD::$_instance == null) {
            PdoBD::$_instance = new PdoBD();
        }
        return PdoBD::$_instance;
    }
    public function getMonPdo() {
        return self::$_monPdo;
    }

}