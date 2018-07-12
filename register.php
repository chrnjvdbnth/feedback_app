<?php
    include 'init.php';

    if(isset($_POST['register'])){
        $id = $_POST['id'];
        $name = $_POST['name'];
        $department = $_POST['dept'];
        $phone = $_POST['phone'];
        $post = $_POST['post'];
        if(!empty($id) && !empty($name) && !empty($department) && !empty($phone) && !empty($post)){
            $getFromU->create('hr_database', array('emp_id' => $id, 'emp_name' => $name,  'Department' => $department, 'phone_no' => $phone, 'emp_post' => $post));
        }
    }
?>


<html>
<title>register</title>
<head></head>
<body>
    <form action="" method="post">
    employeeID:<input type="text" name="id"><br>
    name:<input type="text" name="name"><br>
    Department:<select name="dept">
    <option value="Technical">Technical</option>
    <option value="Marketing">Marketing</option>
    <option value="Consultant">Consultant</option>
    <option value="Finance">Finance</option>
    </select><br>
    phone_no:<input type="text" name="phone"><br>
    post:<select name="post">
    <option value="Jr. Engineer">Jr. Engineer</option>
    <option value="marketingManager">marketing Manager</option>
    <option value="Consultant">Consultant</option>
    <option value="Finance">Finance</option>
    </select><br>
    <input type="submit" value="register" name="register">
    </form>
    <?php
        if(isset($error1)){
            echo $error1;
        }
    ?>
</body>
</html>