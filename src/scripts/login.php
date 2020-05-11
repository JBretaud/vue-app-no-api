<?php 
if(!empty($_POST['login'])){
    require_once '../src/Classes/DAO/idDAO.php';

    $auth=new idDAO($pdo);


    $user = $auth->login($_POST['login'],$_POST['pass']);
    if (!empty($user)){
        $_SESSION['login']=$user->getLogin();
        $_SESSION['type']=$user->getIdTypeUtilisateur();
        $_SESSION['id']=$user->getIdUtilisateur();
        header('Location: /cabinet/accueil');
        exit();
    }else{
        header('Location: /cabinet/login/error');
        exit();
    }
}else{
    header('Location: /cabinet/accueil');
    exit();
}

