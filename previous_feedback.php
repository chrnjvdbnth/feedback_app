<?php
    include 'init.php';

    $eid = $_POST['eid'];                   //pass user_id from android
    $pf = $getFromU->previous_feedback($eid);                    
    foreach($pf as $pfs){
        echo $pfs->status;
        echo "          ";
        echo $pfs->feedback_type;
        echo "          ";
        echo $pfs->anonymous;
        echo "<br>";
    }        
?>