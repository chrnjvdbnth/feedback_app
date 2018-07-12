<?php
    include 'init.php';

        $fb = $getFromU->return_feedback_types();
        foreach($fb as $fbs){
            echo $fbs->feedback_name;
            echo "<br>"; 
        }
?>

<html>
<title>feedback_types</title>
</html>