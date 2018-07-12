<?php

    class User{
        protected $pdo;

        function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function login($emp_id, $password){
            $stmt = $this->pdo->prepare("SELECT `emp_id` FROM `employee` WHERE `emp_id` = :emp_id AND `password`=:password");
            $stmt->bindParam(":emp_id",$emp_id,PDO::PARAM_INT);
            $stmt->bindParam(":password",$password,PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->rowCount();

            if($count>0){
                return true;
            }
            else{
                return false;
            }
        }

        public function create($table, $fields = array()){
            $columns = implode(',', array_keys($fields));
            $values = ':'.implode(', :', array_keys($fields));
            $sql = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";
            //echo $sql;
            if($stmt = $this->pdo->prepare($sql)){
                foreach($fields as $key => $data){
                    $stmt->bindValue(':'.$key,$data);
                }
                $stmt->execute();
            }
        }

        public function return_feedback_types(){
            $stmt = $this->pdo->prepare("SELECT `feedback_name` FROM `feedback_convert`");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function previous_feedback($user_id){
            $stmt = $this->pdo->prepare("SELECT `status` , `feedback_type` , `anonymous` FROM `feedback` WHERE `feedback_by` = :user_id");
            $stmt->bindParam(":user_id",$user_id,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function feedback_que_rating($feedback_type){
            $stmt = $this->pdo->prepare("SELECT `Q1` , `Q2` , `Q3` , `Q4` FROM `feedback_que` WHERE `feedback_type` = :feedback_type");
            $stmt->bindParam(":feedback_type",$feedback_type,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function fetchDetails($eid){
            $stmt = $this->pdo->prepare("SELECT * FROM `hr_database` WHERE `emp_id` = :eid");
            $stmt->bindParam(":eid",$eid,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function checkEid($eid){
            $stmt = $this->pdo->prepare("SELECT `emp_id` FROM `hr_database` WHERE `emp_id` = :eid");
            $stmt->bindParam(":eid",$eid,PDO::PARAM_INT);
            $stmt->execute();
            $count = $stmt->rowCount();
            if($count>0){
                return false;
            }
            else{
                return true;
            }
        }

        public function identify_dept($eid){
            $stmt = $this->pdo->prepare("SELECT `Department` FROM `hr_database` WHERE `emp_id` = :eid");
            $stmt->bindParam(":eid",$eid,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
        
        public function get_post($eid){
            $stmt = $this->pdo->prepare("SELECT `emp_post` FROM `hr_database` WHERE `emp_id` = :eid");
            $stmt->bindParam(":eid",$eid,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function get_feedback_by_post($post,$category){
            $stmt = $this->pdo->prepare("SELECT * FROM `feedback` LEFT JOIN `hr_database` ON `emp_id` = `feedback_by` WHERE emp_post >= :post AND `feedback_type` = :category ");
            $stmt->bindParam(":post",$post,PDO::PARAM_INT);
            $stmt->bindParam(":category",$category,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchALL(PDO::FETCH_OBJ);
        }

        public function get_all_feedbacks($category){
            $stmt = $this->pdo->prepare("SELECT * FROM `feedback` WHERE `feedback_type` = :category");
            $stmt->bindParam(":category",$category,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchALL(PDO::FETCH_OBJ);
        }

        public function get_feedback_by_post_and_dept($dept, $post, $category){
            $stmt = $this->pdo->prepare("SELECT * FROM `feedback` LEFT JOIN `hr_database` ON `emp_id` = `feedback_by` WHERE `emp_post` >= :post AND `Department` = :dept AND `feedback_type` = :category");
            $stmt->bindParam(":post",$post,PDO::PARAM_INT);
            $stmt->bindParam(":dept",$dept,PDO::PARAM_STR);
            $stmt->bindParam(":category",$category,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchALL(PDO::FETCH_OBJ);    
        }

        public function get_avg_rating($cat){
            $stmt = $this->pdo->prepare("SELECT `feedback_id`,`Q1`,`Q2`,`Q3`,`Q4` FROM `rating` LEFT JOIN `feedback` ON fid = feedback_id WHERE feedback_type = :cat");
            $stmt->bindParam(":cat",$cat,PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchALL(PDO::FETCH_OBJ);
        }

        public function get_emp_name($eid){
            $stmt = $this->pdo->prepare("SELECT `emp_name` FROM `hr_database` WHERE `emp_id` = :eid");
            $stmt->bindParam(":eid",$eid,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }

        public function add_rating_in_feedback($fid,$avg){
            $stmt = $this->pdo->prepare("UPDATE `feedback` SET `avg_rating` = :avg WHERE `feedback`.`feedback_id` = :fid");
            $stmt->bindParam(":fid",$fid,PDO::PARAM_INT);
            $stmt->bindParam(":avg",$avg,PDO::PARAM_INT);
            $stmt->execute();
        }

        public function get_details($eid){
            $stmt = $this->pdo->prepare("SELECT `emp_id`,`emp_name`,`Department`,`emp_post` FROM `hr_database` WHERE `emp_id` = :eid");
            $stmt->bindParam(":eid",$eid,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        }
    }
?>