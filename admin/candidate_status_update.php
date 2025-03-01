<?php
    include('function/db_connect.php');
    //clearstatcache();
    //echo "<pre>";print_r($_POST);exit();
    if(!empty($_POST))
    {
        $cno    = $_POST['candidate_no'];
        $sta    = $_POST['status'];

        if($sta == 0)
        {
            $sql = "UPDATE tbl_candidate SET `reason` =  'null', `status` = '$sta' WHERE candidate_no = '$cno'";
            
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
        else if($sta == 1)
        {
            $sql = "UPDATE tbl_candidate SET `reason` =  'null', `status` = '$sta' WHERE candidate_no = '$cno'";
            
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
        else
        {
            
            $reason = $_POST['reason'];
            $sql = "UPDATE tbl_candidate SET `reason` =  '$reason', `status` = '$sta' WHERE candidate_no = '$cno'";
            
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