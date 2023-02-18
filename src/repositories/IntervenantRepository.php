<?php

namespace repositories;

use entities\Intervenant;
use repositories\PdoBD;

class IntervenantRepository {

    /**
     * 
     * @param string $mail
     * @param string $password
     * @return Intervenant
     */
    public static function ws_auth($mail, $password) {
        $sql = "SELECT id,nom,prenom,mail,actif,role_code,site_uai FROM intervenant where mail=:mail and `password`=md5(:password) and role_code ='Utilisateur'";
        $stmt = PdoBD::getInstance()->getMonPdo()->prepare($sql);
        $stmt->bindValue(":mail", $mail);
        $stmt->bindValue(":password", $password);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, '\entities\Intervenant');
        $ligne = $stmt->fetch();
        return $ligne;
    }

 

}
