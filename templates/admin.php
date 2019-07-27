<?php

/**
 * @package Aristech
 */

$week_days = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');

echo '<div class="wrap">
    <h2>Settings Daily Info </h2>
    <p>Shortcode to use <strong>[daily_info]</strong></p>

    <form method="post" action="">';
foreach ($week_days as $day) {
    $aristech = $this->{'aristech_' . $day};

    echo "<div class='widefat'>
           <h2 style='text-transform: capitalize;'> $day </h2>
           <!-- Repeater Content -->
           <div class='repeater' style='margin-bottom: 60px;text-align:center;'>
               <table class='wrapper' width='100%'>
                   <div data-repeater-list='group-$day'>";
    // var_dump($this->aristech_options);
    if (!empty($aristech)) {

        foreach ($aristech as $key => $value) {
            echo '<div style="margin-bottom: 5px; text-align:center;" data-repeater-item>
                               <input class="timepicker" placeholder="Start" type="text" style="width:20%;" name="aristech_' . $day . '_start" value="' . $value[$day . '_' . $key][0]['aristech_' . $day . '_start'] . '"/>
                               <input class="timepicker" placeholder="End" type="text" style="width:20%;" name="aristech_' . $day . '_end" value="' . $value[$day . '_' . $key][1]['aristech_' . $day . '_end'] . '"/>
                               <input type="text" placeholder="Text" style="width:50%;" name="aristech_' . $day . '_text" value="' . $value[$day . '_' . $key][2]['aristech_' . $day . '_text'] . '"/>
                               <input data-repeater-delete type="button" class="btn btn-danger" value="✗"/></div>';
        }
    } else {
        echo '<div style="margin-bottom: 5px; text-align:center;" data-repeater-item>
                           <input class="timepicker" placeholder="Start" type="text" style="width:20%;" name="aristech_' . $day . '_start" value=""/>
                           <input class="timepicker" placeholder="End" type="text" style="width:20%;" name="aristech_' . $day . '_end" value=""/>
                           <input type="text" placeholder="Text" style="width:50%;" name="aristech_' . $day . '_text" value=""/>
                           <input data-repeater-delete type="button" class="btn btn-danger" value="✗"/></div>';
    }
    echo '</div>
                   <input class="addData" data-repeater-create type="button" class="btn btn-primary" value="Add" />
               </table>
           </div>


       </div>';
}

echo '</div>
<input type="submit" name="submit_scripts_update" class="button button-primary" value="Save" />
</form>
</div>';
