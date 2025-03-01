<?php 
    include('function/db_connect.php');
    //echo "<pre>";print_r($_POST);exit();
    if(!empty($_POST))
    {
        $stu_ID = $_POST['student_ID'];
        $can_no = $_POST['candidate_no'];
        $date = date('Y-m-d h:i:s');
        //echo "<pre>";print_r($date);exit();
        $sql = "INSERT INTO `tbl_voter_details`(`voter_ID`, `candidate_no`, `voting_date`) 
        VALUES ('$stu_ID', '$can_no', '$date')";
        //echo "<pre>";print_r($sql);
        if ($conn->query($sql)) 
        {
            echo json_encode("voted");
        } 
        else 
        {
            echo json_encode("Error: " . $sql . "<br>" . $conn->error);
        }
      
    }
?>