<?php 
    include('function/db_connect.php');
    //echo "<pre>";print_r($_POST);exit();
    if(!empty($_POST))
    {
        $stu_no = $_POST['student_no'];
        $pos_no = $_POST['candidate_position'];
        $vision = $_POST['election_vision'];
        $exp = $_POST['experience'];
        
        //$query = "SELECT COUNT(t1.position_no) AS pos_count,t2.position_limit FROM tbl_candidate AS t1 JOIN tbl_position AS t2 ON t2.position_no = t1.position_no WHERE t1.position_no = '$pos_no'";
        $query = "SELECT * FROM tbl_position WHERE position_no = '$pos_no'";
        //$res = $conn->query($query);
        if($result1 = $conn->query($query))
        {
            while ($fetch1 = mysqli_fetch_array($result1)) 
            {
                $pos_no = $fetch1['position_no'];
                $pos_limit = $fetch1['position_limit'];
                $query2 = "SELECT COUNT(position_no) AS pos_count FROM tbl_candidate WHERE position_no = '$pos_no'";
                $result2 = $conn->query($query2);
                while ($fetch2 = mysqli_fetch_array($result2)) 
                {
                    $pos_count = $fetch2['pos_count'];
                    if($pos_limit > $pos_count)
                    {    
                        $sql = "INSERT INTO tbl_candidate (`student_no`, `position_no`, `vision`, `experience`, `status`) VALUES 
                        ('$stu_no', '$pos_no', '$vision', '$exp', '0')";

                        if ($conn->query($sql)) 
                        {
                            echo json_encode("inserted");
                        } 
                        else 
                        {
                            echo json_encode("Error: " . $sql . "<br>" . $conn->error);
                        }
                    }
                    else
                    {
                        echo json_encode("reached");
                    }
                }
                
            }
        }
    }
?>