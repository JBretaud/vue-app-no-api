<?php
if(!empty($_POST['login'])){
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'idDAO.php';
    $idDAO=new idDAO($pdo);
    $user=$idDAO->get(null,$_POST['login']);
    if(empty($user)){
        $idDAO->create($_POST['login'],$_POST['pass'],1,$_POST['email']);
        $user=$idDAO->get(null,$_POST['login']);
    }
    
    header('Location: /cabinet/account/new/etape2?idUtilisateur='.$user->getId().'&email='.$user->getEmail());
    exit();
}else{
    header('Location: /cabinet/account/new/etape1/error');
    exit();
}