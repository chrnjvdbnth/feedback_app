<?php
    include 'init.php';

    $eid = 1;
    $pwd1 = 'password1';
    $pwd2 = 'password1';

    if($getFromU->checkEid($eid)){
        if($pwd1 == $pwd2){      //need another gatekeeper for this condition!!
            $getFromU->create('employee',array('emp_id' => $eid, 'password' => $pwd1));     //create an entry in employee table
        }
        else{
            echo "password not same";
        }
    }
    else{
        echo "employee id already exist";
    }
?>
<html>
    <title>
        user register
    </title>
</html>