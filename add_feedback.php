<?php
    include 'init.php';

    
        $id = $_POST['id'];
        $feedback = $_POST['feedback'];
        $feedback_for = $_POST['ff'];
        $anonymous = $_POST['anonymous'];
        if(!empty($id) && !empty($feedback) && !empty($feedback_for) && !empty($anonymous)){
            echo "success";
            $getFromU->create('feedback', array( 'status' => $feedback, 'feedback_by' => $id, 'feedback_type' => $feedback_for, 'anonymous' => $anonymous));
        }
        else{
            echo "all fields needs to be filled";
        }
    
?>
<html>
<title>add_feedback</title>
</html>