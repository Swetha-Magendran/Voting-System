<?php
    include('function/db_connect.php');
    //clearstatcache();
    //echo "<pre>";print_r($_POST);exit();
    if(!empty($_POST))
    {
        $cno    = $_POST['candidate_sno'];
        //$name   = $_POST['candidate_name'];
        //$email  = $_POST['candidate_email'];
        $dept   = $_POST['candidate_dept'];
        //$gen    = $_POST['gender'];
        //$candi_id = $_POST['candidate_id'];
        $pos    = $_POST['candidate_position'];
        $student_no = $_POST['student_no'];

        if(empty($cno))
        {
            $check = $conn->prepare("SELECT * FROM tbl_candidate WHERE student_no = '$student_no' AND position_no = '$pos'");
            $check->execute();
            $check->store_result(); 
            
            if ($check->num_rows > 0) 
            {
                echo json_encode("This Candidate is already applied.");
            } 
            else 
            {
                $sql = "INSERT INTO tbl_candidate (student_no, position_no) 
                VALUES ('$student_no', '$pos')";
    
                if ($conn->query($sql)) 
                {
                    echo json_encode("success");
                } 
                else 
                {
                    echo json_encode("Error: " . $sql . "<br>" . $conn->error);
                }
    
                $conn->close();
            }
        }
        else
        {
            $sql = "UPDATE tbl_candidate SET student_no = '$student_no', position_no = '$pos' WHERE candidate_no = '$cno'";
            
            if ($conn->query($sql)) 
            {
                echo json_encode("updated");
            } 
            else 
            {
                echo json_encode("Error: " . $sql . "<br>" . $conn->error);
            }

            $conn->close();
        }
        
    }
    
?>