<?php
    if ($_SESSION['type']==1){
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'PatientDAO.php';
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Objets'.DIRECTORY_SEPARATOR.'Patient.php';
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Objets'.DIRECTORY_SEPARATOR.'User.php';
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'idDAO.php';
    $patientDAO=new patientDAO($pdo);
    $userDAO=new idDAO($pdo);
    $user=$userDAO->get(null,$_SESSION['login']);
    $patient=$patientDAO->get($user->getIdPatient());
        $nom=strtoupper($patient->getNom());
        $prenom=ucfirst($patient->getPrenom());
        $dateNaissance=$patient->getDateNaissance();
        $voie=$patient->getVoie();
        $cp=$patient->getcp();
        $ville=ucfirst($patient->getVille());
        $email=$patient->getEmail();
        $telephone=$patient->getTelephone();
        if($path[0]!='account'){
            if (strlen($telephone)==10){
                $pos=[8,6,4,2];
                foreach($pos as $i){
                    $telephone=substr_replace($telephone,".",$i,0);
                }
            }
        }
        $idPatient=$patient->getIdPatient();
        $idPraticien=$patient->getIdPraticien();
        $idUtilisateur=$patient->getIdUtilisateur();
    }
?>