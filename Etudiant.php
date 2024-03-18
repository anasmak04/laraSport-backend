<?php

class Etudiant {

    private string $nom;
    private string $prenom;
    private string $cin;
    private string $nrImmatriculation;


    public function __construct($nom,$prenom,$cin,$nrImmatriculation)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->cin = $cin;
        $this->nrImmatriculation = $nrImmatriculation;
    }


    public function getNom(){
        return $this->nom;
    }

    public function setNom(string $nom){
        $this->nom = $nom;
    }


    public function getPrenom(){
        return $this->prenom;
    }

    public function setPrenom(string $prenom){
        $this->prenom = $prenom;
    }


    public function getCin(){
        return $this->cin;
    }

    public function setCin(string $cin){
        $this->cin = $cin;
    }



    public function getNrImmatriculation(){
        return $this->nrImmatriculation;
    }



    public function setNrImmatriculation(string $nrImmatriculation){
        return $this->nrImmatriculation = $nrImmatriculation;
    }


    public function getFullName(){
        return $this->nom . $this->prenom;
    }


    public function genrerNrImmatriculation(){
        return $this->nom . $this->prenom .','. 'CIN' . $this->cin .' le numéro d’immatriculation est : ' . $this->nom[0] . $this->prenom[0] . $this->cin;
    }

}

$etudiant = new Etudiant("anas", "elmakhloufi", "as569874", "");
echo $etudiant->genrerNrImmatriculation();
