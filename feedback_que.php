<?php
    include 'init.php';
    //This function will need the id of feedback to display the 4 questions associated to it
    
        $fd_name = $_POST['dept'];           //category for which the feedback is to be submitted
        $post = $_POST['post'];         //post of the employee       
        $obj = $getFromU->feedback_que_rating($fd,$post);
        foreach($obj as $objs){
            echo $objs->Q1;
            echo "<br>";
            echo $objs->Q2;
            echo "<br>";
            echo $objs->Q3;
            echo "<br>";
            echo $objs->Q4;
            echo "<br>";
        }
    
?>