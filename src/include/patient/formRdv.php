<?php
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'praticienDAO.php';
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Objets'.DIRECTORY_SEPARATOR.'Praticien.php';
    $praticienDAO=new praticienDAO($pdo);
    $praticien=$praticienDAO->get($_GET['idPraticien']);
    $creneau=$_GET['creneau'];
    $creneau=explode("-",$creneau);
    $date=new DateTime("{$creneau[0]}-{$creneau[1]}-{$creneau[2]} {$creneau[3]}:{$creneau[4]}");
    if ($_SESSION['type']==3){
        $adress="/cabinet/admin/rdv/finalize";
    }elseif ($_SESSION['type']==1){
        $adress="/cabinet/patient/rdv/finalize";
    }
?>
    <div class="w-100 d-flex flex-column align-items-center">
        <form id="formRdv" class="d-flex flex-column align-items-center w-50" action="<?= $adress ?>" method="post">
            <input type="hidden" name="idClient" value=<?= $_GET['idPatient'] ?>>
            <input type="hidden" name="idPraticien" value=<?= $_GET['idPraticien'] ?>>
            <input type="hidden" name="start" value=<?= $date->format('Y-m-d/H:i') ?>>
            <div class="d-flex flex-column align-items-center mb-5">
                <h1>Rendez-vous</h1>
                <img class="separator" src='/cabinet/src/img/separator.png'>
            </div>
            <h3 class="mt-5"> Dr. <?=$praticien->getPrenom().' '.$praticien->getNom()?></h3>
            <div class="d-flex flex-row align-items-end mb-4">
                <label class="m-0">Le </label>
                <input class="border-0 date" readonly name="Date" value=<?= $date->format('Y-n-d') ?>>
                <label class="m-0">à </label>
                <input class="border-0 date hour" readonly value=<?= $date->format('H:i') ?>>
            </div>
            <div class="form-group d-flex flex-column align-items-center w-100">
                <label><h3>- Motif du rendez-vous - </h3></label>
                <textarea class="w-50" name="Description"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Réserver le créneau</button>
        </form>
    </div>