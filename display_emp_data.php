<?php
    include 'init.php';
    //this fuction will display employee data if needed
    
        if(!empty($_POST['eid'])){
            $id = $_POST['eid'];
            $obj = $getFromU->fetchDetails($id);
            foreach($obj as $objs){
                echo "NAME: ";
                echo $objs->emp_name;
                echo "<br>";
                echo "Department: ";
                echo $objs->Department;
                echo "<br>";
                echo "PHONE NUMBER: ";
                echo $objs->phone_no;
                echo "<br>";
                echo "POST: ";
                echo $objs->emp_post;
                echo "<br>";
            }
        }
        else{
            echo "Error: enter eid";
        }
    
?>