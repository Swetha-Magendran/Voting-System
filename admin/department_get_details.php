<?php 
    include('function/db_connect.php');

    if(!empty($_POST))
    {
        $sno = $_POST['department_id'];

        $sql = "SELECT * FROM tbl_department WHERE department_no = '$sno'";

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