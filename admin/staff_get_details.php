<?php 
    include('function/db_connect.php');

    if(!empty($_POST))
    {
        $staff_id = $_POST['staff_id'];

        $sql = "SELECT * FROM tbl_staff WHERE staff_no = '$staff_id'";

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