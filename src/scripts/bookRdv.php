<?php

require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'rdvDAO.php';
require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Objets'.DIRECTORY_SEPARATOR.'Rdv.php';

echo $_POST['start'];
$start=str_replace("/"," ",$_POST['start']);
echo $start;
$rdv=new Rdv(null,$_POST['idClient'],$_POST['idPraticien'],$start,null,$_POST['Description'], $_POST['Date']);

$rdvDAO=new rdvDAO($pdo);
$rdvDAO->create($rdv);
if($_SESSION['type']==3){
    header('Location: /cabinet/admin/fiche?idPatient='.$_POST['idClient']);
    exit();
}elseif($_SESSION['type']==1){
    header('Location: /cabinet/profil');
    exit();
}
?>