<?php 
    include('function/db_connect.php');

    if(!empty($_POST))
    {
        $cno = $_POST['candidate_id'];

        $sql = "SELECT t1.*,t2.*, t3.department_name,t4.position_name 
        FROM tbl_candidate AS t1 JOIN tbl_students AS t2 ON t1.student_no = t2.student_no 
        JOIN tbl_department AS t3 ON t3.department_no = t2.student_department 
        JOIN tbl_position AS t4 ON t4.position_no = t1.position_no WHERE t1.candidate_no = '$cno'";

        $response = array();

        if ($result = $conn->query($sql)) 
        {
            $result->num_rows;

            while ($fetch = mysqli_fetch_array($result)) {
                //echo "<pre>";print_r($fetch);exit();
			    $response =$fetch;							
            }
        }
    }
    echo json_encode($response);
?>