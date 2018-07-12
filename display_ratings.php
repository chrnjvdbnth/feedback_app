<?php
    include 'init.php';

    //display average rating by category
    //enter category
    $cat = $_POST['category'];
    $obj = $getFromU->get_avg_rating($cat);
    $q1=0;$q2=0;$q3=0;$q4=0;$c=0;$a=0;
    $c1=0;$c2=0;$c3=0;$c4=0;
    $x=0;
    foreach($obj as $objs){
        $q1 = $objs->Q1;
        $c1 = $c1 + $q1;
        $q2 = $objs->Q2;
        $c2 = $c2 + $q2;
        $q3 = $objs->Q3;
        $c3 = $c3+ $q3;
        $q4 = $objs->Q4;
        $c4 = $c4 + $q4;
        $a = $q1+$q2+$q3+$q4+$a;
        $c = $c + 4;
        $x=$x+1;
    }
    echo "avg of q1: ".$c1/$x."<br>";
    echo "avg of q2: ".$c2/$x."<br>";
    echo "avg of q3: ".$c3/$x."<br>";
    echo "avg of q4: ".$c4/$x."<br>";
    echo "avg of all: ".$a/$c;
?>