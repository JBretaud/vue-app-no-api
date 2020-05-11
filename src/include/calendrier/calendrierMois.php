<?php
            require '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Date'.DIRECTORY_SEPARATOR.'Month.php';
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'PatientDAO.php';
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Objets'.DIRECTORY_SEPARATOR.'Patient.php';
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Objets'.DIRECTORY_SEPARATOR.'Praticien.php';
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'praticienDAO.php';
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Objets'.DIRECTORY_SEPARATOR.'Rdv.php';
            require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'rdvDAO.php';
            
            try {
                $month = new App\Date\Month($_GET['month'] ?? null, $_GET['year'] ?? null, $_GET['week'] ?? null);
            } catch (\Exception $e){
                $month = new App\Date\Month();
            }
            
            if ($month->getStartingDay()->format('w')!=1){
                $start= $month->getStartingDay()->modify('last monday');
            } else{
                $start= $month->getStartingDay();
            }


        ?>
        <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
            <h1><?= $month->toString();?></h1>
            <a href="/cabinet/calendar/week?year=<?=$month->year?>&month=<?=$month->month?>">Affichage Semaine</a>
            <div>
                <a href="/cabinet/calendar/month?&month=<?= $month->previousMonth()->month?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary">&lt</a>
                <a href="/cabinet/calendar/month?&month=<?= $month->nextMonth()->month?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-primary">&gt</a>
            </div>
        </div>

       
        
        <table class="calendar__table calendar__table--<?= $month->getWeeks()+1 ?>weeks">
            <?php for($i = 0; $i < $month->getWeeks()+1; $i++): ?>
            <tr>
                <?php foreach($month->days as $k => $day):
                   $date = (clone $start)->modify("+" . ($k + $i * 7) ." days"); 
                ?>
                <td <?= $month->withinMonth($date) ? '' :  'class= calendar__othermonth'?> >
                <?php if ($i===0):?> <div class="calendar__weekday"><?= $day; ?></div> <?php endif;?>
                    <div class="calendar__day"><?= $date->format('d') ?></div>
                </td>
                <?php endforeach; ?>
            </tr>
        <?php endfor; ?>
        </table>
        <?php $month->getWeeks();?>
        <script src="" async defer></script>
