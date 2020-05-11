<?php
    
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'DAO'.DIRECTORY_SEPARATOR.'rdvDAO.php';
    require_once '..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Classes'.DIRECTORY_SEPARATOR.'Date'.DIRECTORY_SEPARATOR.'Week.php';
            try {
                $week = new App\Date\Week($_GET['month'] ?? null, $_GET['year'] ?? null, $_GET['week'] ?? null);
            } catch (\Exception $e){
                $week = new App\Date\Week();
            }
            
             $start=$week->getStartingDay();

?>
        <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
            <h1><?= $week->toString();?></h1>
            
            <a href="/cabinet/calendar/month?month=<?= $week->month?>&year=<?=$week->year?>">Affichage Mois</a>
            <div>
                <a href="/cabinet/calendar/week?month=<?= $week->previousWeek()->month?>&year=<?= $week->previousWeek()->year; ?>&week=<?= $week->previousWeek()->week; ?>" class="btn btn-primary">&lt</a>
                <a href="/cabinet/calendar/week?month=<?= $week->nextWeek()->month?>&year=<?= $week->nextWeek()->year; ?>&week=<?= $week->nextWeek()->week; ?>" class="btn btn-primary">&gt</a>
            </div>
        </div>
        <div class="d-flex flex-row">
            <div class="heures d-flex flex-column align-items-end">
                <div class="bufferth"></div>
                <div class="bufferbuffer"></div>
                <div class="txtHeures d-flex flex-column justify-content-between">
                    <?php for($i=0;$i<11;$i++):?>
                    <p><?=($i+9)."h00"?></p>
                    <?php endfor;?>
                </div>
                <div class="bufferHeuresBas"></div>
                <div class="bufferbufferBas"></div>
            </div>
            <table class="calendar__weektable">
                <tr>
                    <th class="thbufferHeuresLeft"></th>
                    <?php foreach($week->days as $k => $day):
                        $date = (clone $start)->modify("+" . ($k) ." days");
                    ?>
                    <th  <?= $week->withinMonth($date) ? '' :  'class= calendar__othermonth'?>>
                        <div class="calendar__hour"><?= $day.'<br>'.$date->format('d') ?></div>
                    </th>
                    <?php endforeach; ?>
                    <th class="thbufferHeuresRight"></th>
                </tr>
                <tr>
                    <th class="buffer thbufferHeuresLeft"></th>
                    <?php foreach($week->days as $k => $day): ?>
                        <td class="buffer"></td>
                    <?php endforeach; ?>
                    <th class="buffer thbufferHeuresRight"></th>
                </tr>

            <?php for($i = 0; $i < 10; $i++): ?>
                <tr>
                    <td class="tdbufferHeuresLeft"></td>
                    <?php foreach($week->days as $k => $day):
                        $date = (clone $start)->modify("+" . ($k) ." days");
                    ?>
                    <td class="calendar__hour <?php if($i==0){echo "olcontainer";} ?>">
                    <?php if($i==0):?>
                    <div class="overlay ol<?= $day ?>">
                        <?php $date->format('Y/m/d'); ?>
                    </div>
                    <?php endif;?>
                    </td>
                    <?php endforeach; ?>
                    <td class="tdbufferHeuresRight"></td>
                </tr>
            <?php endfor; ?>
                <tr>
                    <?php for($i=0;$i<9;$i++):
                        if($i==0):
                        ?>
                    <td class="calendar__buffer tdbufferHeuresLeft"></td>
                        <?php elseif($i==8): ?>
                    <td class="calendar__buffer tdbufferHeuresRight"></td>
                        <?php else: ?>
                    <td class="calendar__buffer"></td>
                        <?php endif;
                    endfor;?>
                </tr>
                <tr class="bufferFin"></tr>
            </table>
            <div class="heures d-flex flex-column align-items-start">
            <div class="bufferth"></div>
                <div class="bufferbuffer"></div>
                <div class="txtHeures d-flex flex-column justify-content-between">
                    <?php for($i=0;$i<11;$i++):?>
                    <p><?=($i+9)."h00"?></p>
                    <?php endfor;?>
                </div>
                <div class="bufferHeuresBas"></div>
                <div class="bufferbufferBas"></div>
            </div>
        </div>
