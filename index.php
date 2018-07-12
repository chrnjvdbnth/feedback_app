<?php
    include 'init.php';

    $id = 2;//$_POST['empID'];
    $pw = 'pass';//$_POST['password'];
    if(!empty($id) && !empty($pw)){
        if($getFromU->login($id,$pw)){
            echo "success";
            $obj = $getFromU->get_details($id);
            if($obj->Department == "U"){
                $dept = "NULL";
            }
            else{
                $dept = $obj->Department;
            }
            $obj2 = $getFromU->get_post($id);
            $post = $obj2->emp_post;
            $a = array();
            array_push($a,array("emp_id"=>$obj->emp_id,"name"=>$obj->emp_name,"Department"=>$dept,"emp_post"=>$post));
            echo $v = json_encode(array("feeds"=>$a));
        }
        else{
            echo "incorrect id or password";
        }   
    }
?>
