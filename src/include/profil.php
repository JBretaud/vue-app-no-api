<?php
require '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'include'.DIRECTORY_SEPARATOR.'loggedToObjects.php';
require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'PraticienDAO.php';
require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Objets'.DIRECTORY_SEPARATOR.'Praticien.php';
require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Objets'.DIRECTORY_SEPARATOR.'Rdv.php';
require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'rdvDAO.php';
$praticienDAO=new praticienDAO($pdo);
$praticien=null;
$rdvDAO=new rdvDAO($pdo);
    $prochainRdv=$rdvDAO->getNextRdv($idPatient);
    if(!empty($prochainRdv)){
        $date=new DateTime($prochainRdv['start']);
        $heure=$date->format('H:i');
        $praticien=$praticienDAO->get($prochainRdv['idPraticien']);
        $praticienRdv=$praticien->getPrenom().' '.$praticien->getNom();
    }
    
    
if(!empty($patient->getIdPraticien())){
    $praticien=$praticienDAO->get($patient->getIdPraticien());
}   
?>
<div id="profile" class="d-flex flex-row align-items-start justify-content-around" >
    <div id="donnees" class="d-flex pt-5 flex-column align-items-center"> 
        <h1> Données Personnelles </h1>
        <img class="separator" src='/cabinet/src/img/separator.png'>
        <div>
            <div class="mb-5">
                <h2>Coordonnées :</h2>
                <div class="pl-3" >
                    <?php if(!empty($prenom)&&!empty($nom)&&!empty($voie)&&!empty($cp)&&!empty($ville)): ?>
                        <p> <?=$prenom.' '.$nom?></p>
                        <p> <?=$voie?> </p>
                        <p class="mb-5"> <?=$cp.' '.$ville?> </p>
                        <div class="link-group">
                            <p><a href="/cabinet/account/modify">Modifier mes coordonnées</a></p>
                            <img src='/cabinet/src/img/highlight.png'>
                        </div>
                    <?php else: ?>
                        <div class="link-group">
                            <p><a href="/cabinet/account/modify">Mettre à jour mes informations.</a></p>
                            <img src='/cabinet/src/img/highlight.png'>
                        </div>
                     <?php endif; ?>
                </div>
            </div>
            <div>
                <h2>Contacts : </h2>
                
                <div class="pl-3">
                    <?php if(!empty($telephone)): ?>
                    <p> Téléphone : <?=$telephone?> </p>
                    <?php else: ?>
                    <div class="link-group">
                        <p> Téléphone : <a href="/cabinet/account/modify">Ajouter</a></p>
                        <img src='/cabinet/src/img/highlight.png'>
                    </div>
                    <?php endif; ?>
                    <p class="mb-5"> Adresse email : <a href="mailto:<?=$email?>"><?=$email?></a> </p>
                    <div class="link-group">
                        <p><a href="/cabinet/account/modify">Modifier mes contacts</a></p>
                        <img src='/cabinet/src/img/highlight.png'>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div style="width:60%"> 
        <div class="d-flex pt-5 flex-column align-items-center">
            <h1>Votre Suivi Médical</h1>
            <img class="separator" src='/cabinet/src/img/separator.png'>
            <div class="d-flex py-5 flex-row align-items-start justify-content-around" style ="width:100%">
                <?php if(!empty($patient->getIdPraticien())):?>
                <div class="d-flex flex-column justify-content-start align-items-center ">
                    <h2 class="mb-2">Vous êtes suivi par : </h2>
                    <h3 class="mb-1">Dr. <?=$praticien->getPrenom().' '.$praticien->getNom()?></h3>
                    <p class="mb-5"><a href="mailto:<?=$praticien->getEmail()?>">- Contacter -</a></p>
                </div>
                <?php else: ?>
                <div class="d-flex flex-column justify-content-start align-items-center " style="width:50%; text-align:center">
                    <h3 class="pl-3">Vous n'êtes pas encore suivi par un de nos praticiens. <br>
                        <a href="mailto:accueil@cabinet-medical.com">Contactez l'accueil si vous souhaitez modifier votre situation.</a> </h3>
                </div>
                <?php endif; ?>
                <?php if(!empty($prochainRdv)):?>
                    <div class="d-flex flex-column justify-content-start align-items-center" style="width:50%;">
                        <h2>Votre Prochain Rendez-vous :</h2>
                        <p>Le <?=$prochainRdv['Date']." à ".$heure."<br>avec Dr.". $praticienRdv?></p>
                    </div>
                    <?php else: ?>
                    <div class="d-flex flex-column justify-content-start align-items-center" style="width:50%;">
                        <h2>Prochain rendez-vous :</h2>
                        <h3>Pas de rendez-vous programmé</h3>
                        <div class="link-group">
                            <a href="/cabinet/patient/rdv/new?idPatient=<?=$idPatient?>">Réserver un créneau</a>
                            <img src='/cabinet/src/img/highlight.png'>
                        </div>
                    </div>
                    <?php endif; ?>
            </div>
        </div>
        <div class="d-flex flex-column align-items-center">
            <h1>Vos Documents:</h1>
            <img class="separator" src='/cabinet/src/img/separator.png'>
        </div>
    </div>
</div>
