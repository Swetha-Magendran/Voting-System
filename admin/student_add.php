<?php
    include('function/db_connect.php');

    //print_r($_POST);exit();
    if(!empty($_POST))
    {
        $sno    = $_POST['stu_sno'];
        $name   = $_POST['stu_name'];
        $email  = $_POST['stu_email'];
        $dept   = $_POST['stu_dept'];
        $gen    = $_POST['gender'];
        $stu_id = $_POST['stu_id'];
        $dob    = $_POST['dob'];
        //$user   = $_POST['user_name'];
        $pwd    = $_POST['pwd'];
        $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);

        if(empty($sno))
        {
            $check = $conn->prepare("SELECT * FROM tbl_students WHERE student_ID = '$stu_id' OR student_email = '$email' ");
            $check->execute();
            $check->store_result(); 
            //echo json_encode($check->num_rows);
            if ($check->num_rows > 0) 
            {
                echo json_encode("Student ID or Email already exists. Please use a different ID or Email.");
            } 
            else 
            {
                $sql = "INSERT INTO tbl_students (student_name, student_email, student_department, student_gender, student_ID, student_dob, student_password)
                VALUES ('$name', '$email', '$dept', '$gen', '$stu_id', '$dob', '$hashedPassword')";
    
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
            $sql = "UPDATE tbl_students SET student_name = '$name', student_email = '$email', student_department = '$dept',student_gender = '$gen', student_ID = '$stu_id', student_dob = '$dob', student_password = '$hashedPassword' WHERE student_no = '$sno'";
            
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