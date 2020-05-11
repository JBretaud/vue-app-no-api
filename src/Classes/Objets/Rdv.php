<?php
class Rdv{
    private $idRdv;
    private $idClient;
    private $idPraticien;
    private $start;
    private $duree;
    private $description;
    private $date;

    public function __construct(?array $attributes){
        $this->hydrate($attributes);
    }

    public function hydrate($attributes){
        foreach ($attributes as $key => $value)
        {
            if(!empty($value)){
                // On récupère le nom du setter correspondant à l'attribut.
                $method = 'set'.ucfirst($key);
                    
                // Si le setter correspondant existe.
                if (method_exists($this, $method))
                {
                // On appelle le setter.
                $this->$method($value);
                }
            }
        
        }
    }

    public function getIdRdv(){
        return $this->idRdv;
    }
    public function getIdClient(){
        return $this->idClient;
    }
    public function getIdPraticien(){
        return $this->idPraticien;
    }
    public function getStart(){
        return $this->start;
    }
    public function getDuree(){
        return $this->duree;
    }
    public function getDescription(){
        return $this->description;
    }
    public function getDate(){
        return $this->date;
    }

    public function setIdRdv($idRdv){
       $this->idRdv=$idRdv;
    }
    public function setIdClient($idClient){
        $this->idClient=$idClient;
    }
    public function setIdPraticien($idPraticien){
        $this->idPraticien=$idPraticien;
    }
    public function setStart($start){
        $this->start=$start;
    }
    public function setDuree($duree){
        if(empty($duree)){
            $this->duree=20;
        }else{
            $this->duree=$duree;
        }
    }
    public function setDescription($description){
        $this->description=$description;
    }
    public function setDate($date){
        $this->date=$date;
    }

    
} 