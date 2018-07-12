<?php
    include 'init.php';

    $eid = 2;//$_POST['eid'];
    $obj = $getFromU->identify_dept($eid);
    $obj2 = $getFromU->get_post($eid);
    $category = 'Food';
    //************************Founder & CEO**************************
    if($obj->Department == 'U'){            //Founder can see all feedbacks but CEO cannot see feedback by founder
        $obj3 = $getFromU->get_feedback_by_post($obj2->emp_post,$category);
        $a = array();
        foreach($obj3 as $obj3s){
            if($obj3s->anonymous == 'NO'){
                $ob = $getFromU->get_emp_name($eid);
                array_push($a,array("status"=>$obj3s->status,"feedback_type"=>$obj3s->feedback_type,"anonymous"=>$ob->emp_name,"rating"=>$obj3s->avg_rating));
            }
            else if($obj3s->anonymous == 'YES'){
                array_push($a,array("status"=>$obj3s->status,"feedback_type"=>$obj3s->feedback_type,"anonymous"=>"Anonymous","rating"=>$obj3s->avg_rating));
            }
        }
        echo $v = json_encode(array("feeds"=>$a));
    }

    //**************************HR***********************************
    else if($obj->Department == 'HR'){      //HR manager can see feedback of all
        if($obj2->emp_post == 3){
            $obj4 = $getFromU->get_all_feedbacks($category);
            $a = array();
            foreach($obj4 as $obj4s){
                if($obj4s->anonymous == 'NO'){
                    $ob = $getFromU->get_emp_name($eid);
                    array_push($a,array("status"=>$obj4s->status,"feedback_type"=>$obj4s->feedback_type,"anonymous"=>$ob->emp_name,"rating"=>$obj4s->avg_rating));
                }
                else if($obj4s->anonymous == 'YES'){
                    array_push($a,array("status"=>$obj4s->status,"feedback_type"=>$obj4s->feedback_type,"anonymous"=>"Anonymous","rating"=>$obj4s->avg_rating));
                }
            }
            echo $v = json_encode(array("feeds"=>$a));
        }
        else{                               //Employee in HR dept can see his feedback and all other employees of equal or below level
            $obj5 = $getFromU->get_feedback_by_post($obj2->emp_post,$category);
            $a = array();
            foreach($obj5 as $obj5s){
                if($obj5s->anonymous == 'NO'){
                    $ob = $getFromU->get_emp_name($eid);
                    array_push($a,array("status"=>$obj5s->status,"feedback_type"=>$obj5s->feedback_type,"anonymous"=>$ob->emp_name,"rating"=>$obj5s->avg_rating));
                }
                else if($obj5s->anonymous == 'YES'){
                    array_push($a,array("status"=>$obj5s->status,"feedback_type"=>$obj5s->feedback_type,"anonymous"=>"Anonymous","rating"=>$obj5s->avg_rating));
                }
            }
            echo $v = json_encode(array("feeds"=>$a));
        }
    }

    //**************************OTHERS********************************
    else{                                   //If the employee is from any other department, then he can only see feedbacks from his dept of and employees under him
        $obj6 = $getFromU->get_feedback_by_post_and_dept($obj->Department,$obj2->emp_post,$category);
        $a = array();
        foreach($obj6 as $obj6s){
            if($obj6s->anonymous == 'NO'){
                $ob = $getFromU->get_emp_name($eid);
                array_push($a,array("status"=>$obj6s->status,"feedback_type"=>$obj6s->feedback_type,"anonymous"=>$ob->emp_name,"rating"=>$obj6s->avg_rating));
            }
            else if($obj6s->anonymous == 'YES'){
                array_push($a,array("status"=>$obj5s->status,"feedback_type"=>$obj6s->feedback_type,"anonymous"=>"Anonymous","rating"=>$obj6s->avg_rating));
            }
        }
        echo $v = json_encode(array("feeds"=>$a));
    }
?>