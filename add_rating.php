<?php
    include 'init.php';

    
        $feedback_id = $_POST['feedback_id'];
        $q1 = $_POST['Q1'];
        $q2 = $_POST['Q2'];
        $q3 = $_POST['Q3'];
        $q4 = $_POST['Q4'];
        if(!empty($q1) && !empty($q2) && !empty($q3) && !empty($q4)){
            $getFromU->create('rating',array('feedback_id' => $feedback_id, 'Q1' => $q1, 'Q2' => $q2, 'Q3' => $q3, 'Q4' => $q4));
        }
        $avg = ($q1+$q2+$q3+$q4)/4;
        //insert in feedback table
        $getFromU->add_rating_in_feedback($feedback_id,$avg);
    
?>
