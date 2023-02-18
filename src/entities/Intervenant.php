<?php
namespace entities;

class Intervenant implements \JsonSerializable {
    private $id;
    private $nom;
    private $prenom;
    private $mail;
    private $password;
    private $actif;
    private $role_code;
    private $site_uai;
    private $cle;

    function __construct() {
        
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getMail() {
        return $this->mail;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getRole_code() {
        return $this->role_code;
    }

    function isActif() {
        return $this->actif;
    }

    function getSite_uai() {
        return $this->site_uai;
    }

    public function __toString() {
        return $this->nom ." " . $this->prenom;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id ,
            'nom' => $this->nom ,
            'prenom' => $this->prenom ,
            'mail' => $this->mail ,
            'role_code' => $this->role_code ,
            'site_uai' => $this->site_uai ,
            'actif' => ($this->actif)==true 
        ];
    }

}
