<?php
    include('function/db_connect.php');
    clearstatcache();
    //print_r($_POST);exit();
    if(!empty($_POST))
    {
        $sno    = $_POST['staff_no'];
        $name   = $_POST['staff_name'];
        $email  = $_POST['staff_email'];
        $dept   = $_POST['staff_dept'];
        $gen    = $_POST['gender'];
        $staff_id = $_POST['staff_id'];
        $dob    = $_POST['dob'];
        //$user   = $_POST['user_name'];
        $pwd    = $_POST['pwd'];
        $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);

        if(empty($sno))
        {
            $check = $conn->prepare("SELECT * FROM tbl_staff WHERE staff_ID = '$staff_id' AND staff_email = '$email' ");
            $check->execute();
            $check->store_result(); 
            //echo json_encode($check->num_rows);
            if ($check->num_rows > 0) 
            {
                echo json_encode("Staff ID or Email already exists. Please use a different ID or Email.");
            } 
            else 
            {
                $sql = "INSERT INTO tbl_staff (staff_name, staff_email, staff_department, staff_gender, staff_ID, staff_dob, staff_password)
                VALUES ('$name', '$email', '$dept', '$gen', '$staff_id', '$dob', '$hashedPassword')";
    
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
            $sql = "UPDATE tbl_staff SET staff_name = '$name', staff_email = '$email', staff_department = '$dept', staff_gender = '$gen', staff_ID = '$staff_id', staff_dob = '$dob', staff_password = '$hashedPassword' WHERE staff_no = '$sno'";
            
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