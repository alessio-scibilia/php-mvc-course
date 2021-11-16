<?php
$default_timetable_data = '0|||||';
$model = $model ?? (object)array
    (
        'lunedi' => $default_timetable_data,
        'martedi' => $default_timetable_data,
        'mercoledi' => $default_timetable_data,
        'giovedi' => $default_timetable_data,
        'venerdi' => $default_timetable_data,
        'sabato' => $default_timetable_data,
        'domenica' => $default_timetable_data
    );
$flag_field_prefix = $flag_field_prefix ?? 'orario_continuato';
$day_field_prefix = $day_field_prefix ?? 'giorno';
?>
<label><?php echo $view_model->translations->get('orari'); ?></label>
<br/>
<?php

$orari['lunedi'] = explode("|", $model->lunedi);
$orari['martedi'] = explode("|", $model->martedi);
$orari['mercoledi'] = explode("|", $model->mercoledi);
$orari['giovedi'] = explode("|", $model->giovedi);
$orari['venerdi'] = explode("|", $model->venerdi);
$orari['sabato'] = explode("|", $model->sabato);
$orari['domenica'] = explode("|", $model->domenica);

?>

<?php $weekdays = array('lunedi', 'martedi', 'mercoledi', 'giovedi', 'venerdi', 'sabato', 'domenica'); ?>
<?php $intervals = array('dalle', 'alle', 'dalle', 'alle'); ?>
<?php foreach ($weekdays as $weekday) { ?>
    <div class="time-container" style="display: inline-block;">
        <div class="d-flex align-items-center justify-content-between">
            <div class="time-title"><?php echo $view_model->translations->get($weekday); ?>
                <span> | <input type="hidden"
                                name="<?php echo $flag_field_prefix; ?>[<?php echo $weekday; ?>]"
                                value="0"/>
                    <input
                            type="checkbox"
                            name="<?php echo $flag_field_prefix; ?>[<?php echo $weekday; ?>]"
                            class="orario-continuato" <?php if ($orari[$weekday][0] == 1) echo 'checked="checked"'; ?>
                                                                            value="1"> Orario continuato </span>
            </div>
            <div class="input-time-container">
                <?php for ($i = 0; $i < 2; $i++) { ?>
                    <span class="time-span">
                            <?php echo $view_model->translations->get($intervals[$i]); ?> <input
                                type="time"
                                name="<?php echo $day_field_prefix; ?>[<?php echo $weekday; ?>][<?php echo $i; ?>]"
                                value="<?php echo $orari[$weekday][$i + 1] ?? null; ?>"
                                class="validate-hotel">
                    </span>
                <?php } ?>
            </div>
            <div class="input-time-container">
                <?php for ($i = 2; $i < 4; $i++) { ?>
                    <span class="time-span">
                        <?php echo $view_model->translations->get($intervals[$i]); ?> <input
                            <?php if ($orari[$weekday][0] == 1) echo 'disabled'; ?>
                            type="time"
                            name="<?php echo $day_field_prefix; ?>[<?php echo $weekday; ?>][<?php echo $i; ?>]"
                            class="validate-hotel"
                            value="<?php echo $orari[$weekday][$i + 1] ?? null; ?>">
                    </span>
                <?php } ?>
            </div>
        </div>
    </div>
<?php } ?>
