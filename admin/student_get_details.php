<?php 
    include('function/db_connect.php');

    if(!empty($_POST))
    {
        $sno = $_POST['student_id'];

        $sql = "SELECT * FROM tbl_students WHERE student_no = '$sno'";

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