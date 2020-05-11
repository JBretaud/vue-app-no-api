<?php
    class rdvDAO{
        private $pdo;

        public function __construct($pdo){
            $this->pdo=$pdo;
        }

        public function create(?Rdv $rdv){
            $query = $this->pdo->prepare('INSERT INTO rdv(idPatient, idPraticien, start, Description,Date)VALUES(:idPatient, :idPraticien, :start, :Description, :Date);');
            $query->execute([
                'idPatient'=>$rdv->getIdClient(),
                'idPraticien'=>$rdv->getIdPraticien(),
                'start'=>$rdv->getStart(),
                'Description'=>$rdv->getDescription(),
                'Date'=>$rdv->getDate()
            ]);
        }

        public function getNextRdv(?int $idPatient){
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Objets'.DIRECTORY_SEPARATOR.'Rdv.php';
            $query=$this->pdo->prepare('SELECT * FROM rdv WHERE idPatient=:idPatient ORDER BY start;');
            $query->execute(['idPatient'=>$idPatient]);
            $data= $query->fetch();
            if(!empty($data)){
                return new Rdv($data);
            }else{
                return null;
            }
        }

        public function getAllDayRdv(?Day $day,?int $idPraticien){
            $date=$day->getStart();
            $query=$this->pdo->prepare('SELECT * FROM rdv WHERE Date=:Date AND idPraticien=:idPraticien;');
            $query->execute([
                'Date'=>$date->format('Y-m-d'),
                'idPraticien'=>$idPraticien
                ]);
            $data= $query->fetchAll();
            $ListeRdv=[];
            foreach($data as $rdv){
                array_push($ListeRdv,new Rdv($rdv));
            }
            return $ListeRdv;
        }
    }