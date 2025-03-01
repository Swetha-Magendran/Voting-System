<?php 
    include('function/db_connect.php');
    //echo "<pre>";print_r($_POST);exit();
    if(!empty($_POST))
    {
        $aid = $_POST['admin_ID'];
        $pwd = $_POST['apwd'];

        $sql = "SELECT * FROM tbl_admin WHERE admin_ID = '$aid'";

        if ($result = $conn->query($sql)) 
        {
            $result->num_rows;

            while ($fetch = mysqli_fetch_array($result)) 
            {
                //echo "<pre>";print_r($fetch);exit();
                $no = $fetch['admin_no'];
                $id = $fetch['admin_ID'];
                $name = $fetch['admin_name'];
			    $hashedPassword = $fetch['admin_password'];
                //$hash = password_verify($pwd, $hashedPassword);
                //echo json_encode($hash);
                if(password_verify($pwd, $hashedPassword)) 
                {		
                    // backend_logout.php
                    session_name("backend_session");  // Specify backend session
                    session_start();  // Start the backend session
                    $_SESSION['logged_admin'] = $name;
                    $_SESSION['logged_adminID'] = $id;
                    echo json_encode("success");
                }
                else
                {
                    echo json_encode("failed");
                }
            }
        }
    }
?>