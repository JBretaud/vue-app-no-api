<?php
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'PatientDAO.php';
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Objets'.DIRECTORY_SEPARATOR.'Patient.php';
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Objets'.DIRECTORY_SEPARATOR.'User.php';
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'idDAO.php';
    $patient=new Patient(null,null ,null,null,null,null,null,null,$_GET['email'], $_GET['idUtilisateur'], null);
    $userDAO=new idDAO($pdo);
    $user=$userDAO->get($_GET['idUtilisateur'],null);
    if (empty($user->getIdClient())){
        $patientDAO=new patientDAO($pdo);
        $patientDAO->create($patient);
        $idPatient=$patientDAO->getId($patient);
        $user->setIdClient($idPatient);
        $userDAO->update($user);
    }else{
        header('Location: /cabinet/account/new/error');
        exit();
    }
    
    
    header('Location: /cabinet/account/new/complete');
    exit();
?>