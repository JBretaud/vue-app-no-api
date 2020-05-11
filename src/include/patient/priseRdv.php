<?php
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Date'.DIRECTORY_SEPARATOR.'Day.php';
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Objets'.DIRECTORY_SEPARATOR.'Rdv.php';
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'rdvDAO.php';
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'praticienDAO.php';
    try {
        $day = new Day($_GET['year'] ?? null,$_GET['month'] ?? null, $_GET['day'] ?? null);
    } catch (\Exception $e){
        $day = new Day();
    }
    if(!empty($_POST)){
        $idPraticien=$_POST['idPraticien'];
    }
    if(isset($_POST['idPraticien'])){
        $idPraticien=$_POST['idPraticien'];
    }elseif(isset($_GET['idPraticien'])){
        $idPraticien=$_GET['idPraticien'];
    }
    $praticienDAO=new praticienDAO($pdo);
    $ListePraticiens=$praticienDAO->getListe();
    $ListeIdPraticiens=[];
    
    if ($_SESSION['type']==3){
        $adress="'/cabinet/admin/rdv/book?idPatient=";
    }elseif($_SESSION['type']==1){
        $adress="'/cabinet/patient/rdv/book?idPatient=";
    }

    $rdvDAO=new rdvDAO($pdo);
    
        if (!$day->pastDay()&&isset($idPraticien)){
            $listeRdvReserves=$rdvDAO->getAllDayRdv($day,$idPraticien);
            $listeCreneauxReserves=[];
            foreach($listeRdvReserves as $creneau){
                $debut=new DateTime($creneau['start']);
                array_push($listeCreneauxReserves,[
                    'debut'=>$debut,
                    'fin'=>(clone $debut)->modify("+{$creneau['duree']} minutes")
                ]);
            }
            $start=$day->getStart();
            $creneau=$start;
            $listeCreneaux=[];
            
            while($creneau->format('H')<19){
                $reserve=false;
                foreach($listeCreneauxReserves as $creneauReserve){
                    if ((clone $creneau)->modify("+20 minutes")>$creneauReserve['debut']&&(clone $creneau)->modify("+20 minutes")<=$creneauReserve['fin']){
                        $creneau=$creneauReserve['fin'];
                    }
                }
                $end=(clone $creneau)->modify("+20 minutes")->format('H');
                if(($creneau->format('H')<12||$creneau->format('H')>=13)&&($end<=12||($end>=13&&$end<19))){
                    if(!$day->pastHour((clone $creneau))){
                        array_push($listeCreneaux,(clone $creneau)->format('Y-m-d H:i'));
                    }
                }
                $creneau->modify("+20 minutes");
            }
        }
    
?>
<div class="w-100 d-flex flex-column align-items-center">
    <div class="d-flex flex-row align-items-center justify-content-between w-50">
        <a href="/cabinet/admin/rdv/new?<?php if(isset($idPraticien)) echo "idPraticien=".$idPraticien."&" ?>idPatient=<?=$_GET['idPatient']?>&month=<?= $day->previousDay()->getMonth()?>&year=<?= $day->previousDay()->getYear(); ?>&day=<?= $day->previousDay()->getDay(); ?>" class="btn btn-primary">&lt</a>
        <h1><?=$day->toString()?></h1>
        <a href="/cabinet/admin/rdv/new?<?php if(isset($idPraticien)) echo "idPraticien=".$idPraticien."&" ?>idPatient=<?=$_GET['idPatient']?>&month=<?= $day->nextDay()->getMonth()?>&year=<?= $day->nextDay()->getYear(); ?>&day=<?= $day->nextDay()->getDay(); ?>" class="btn btn-primary">&gt</a>
    </div>
    <form class="w-100 d-flex flex-row justify-content-center" action="#" method="post">
        <select name="idPraticien">
            <?php foreach($ListePraticiens as $Praticien): ?>
                <option name="idPraticien" value="<?= $Praticien['idPraticien'] ?>"><?="Dr. ".$Praticien['prenom'].' '.$Praticien['nom']?></option>
            <?php endforeach;?>
        </select>
        <button type="submit" class="btn btn-primary ml-2">Choisir</button>
    </form>
    <?php if(isset($idPraticien)): ?>
    <ul class="dispRdv d-flex flex-row justify-content-center align-items-center">
        <li class="my-3 mx-2 text-center" v-for="creneau in listeRdv">
            <?php if (!$day->pastDay()): ?>
            <a v-bind:href="<?= $adress.$_GET['idPatient'] ?>&creneau='+(creneau.getYear()+1900)+'-'+(creneau.getMonth()+1)+'-'+creneau.getDate()+'-'+creneau.getHours()+'-'+creneau.getMinutes()+'&idPraticien=<?=$idPraticien?>'" class="d-flex flex-column align-items-center justify-content-around">
                <span class="heure" v-if="creneau.getMinutes()>=10">{{creneau.getHours()}}:{{creneau.getUTCMinutes()}}</span>
                <span class="heure" v-if="creneau.getMinutes()<10">{{creneau.getHours()}}:0{{creneau.getUTCMinutes()}}</span>
                <span> - Prendre Rendez-vous -  </span>
            </a>
            <?php else: ?>
            <span> Pas de créneaux disponibles. </span>
            <?php endif; ?>
        </li>
    </ul>
</div>
<?php endif; ?>