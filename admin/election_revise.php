<?php
    include('function/db_connect.php');
    //clearstatcache();
    //echo "<pre>";print_r($_POST);exit();
    if(!empty($_POST))
    {
        $pno    = $_POST['pos_no'];   

        $query = "SELECT t1.student_no,t3.student_name,t3.election_result FROM tbl_candidate AS t1 
        JOIN tbl_position AS t2 ON t2.position_no = t1.position_no 
        JOIN tbl_students AS t3 ON t3.student_no = t1.student_no WHERE t2.position_no = '$pno'";
        $result = $conn->query($query);
        //echo "<pre>";print_r($result->num_rows);exit();   
        if ($result->num_rows > 0)
        {   
            while ($row = mysqli_fetch_array($result)) 
            {
                $sno = $row['student_no'];
                $ele_res = $row['election_result'];
                if($ele_res == 1)
                {
                    $sql1 = "UPDATE tbl_position SET announce_status = '0' WHERE position_no = '$pno'";
                    $get1 = $conn->query($sql1);
                    $sql2 = "UPDATE tbl_students SET election_result = '0' WHERE student_no = '$sno'";
                    $get2 = $conn->query($sql2);
                    $response['status'] = "revised";
                }
            }
            echo json_encode($response);
        } 
        else 
        {
            echo json_encode("Error: " . $query . "<br>" . $conn->error);
        }

        $conn->close();
        
    }
    
?>