<?php

class Stagiaire
{
    private string $nom;
    private array $notes = [];
    private array $stagiaires = [];


    public function __construct($nom, $notes,  $stagiaires = null)
    {
        $this->nom = $nom;
        $this->notes = $notes;
    }



    public function getNom()
    {
        return $this->nom;
    }

    public function setNom(string $nom)
    {
        $this->nom = $nom;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes(string $notes)
    {
        $this->notes = $notes;
    }


    public function calculerMoyen()
    {
        if (count($this->notes) === 0) {
            return 0;
        }

        return array_sum($this->notes) / count($this->notes);
    }

    public function insertIStagiaires()
    {
       array_push($this->stagiaires,$this->nom , $this->notes);
        print_r($this->stagiaires);
    }


    public function afficherMin()
    {
        $min = $this->notes[0];

        for ($i = 1; $i < count($this->notes); $i++) {
            if ($this->notes[$i] < $min) {
                $min = $this->notes[$i];
            }
        }

        return $min;
    }




    public function afficherMax()
    {
        $max = $this->notes[0];

        for ($i = 1; $i < count($this->notes); $i++) {
            if ($this->notes[$i] > $max) {
                $max = $this->notes[$i];
            }
        }

        return $max;
    }
}

$notes = [10, 10, 10,  9];
$stagiaire = new Stagiaire("anas", $notes);
echo $stagiaire->afficherMax();
