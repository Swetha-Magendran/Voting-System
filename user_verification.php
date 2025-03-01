<?php 
    include('function/db_connect.php');
    //echo "<pre>";print_r($_POST);exit();
    if(!empty($_POST))
    {
        $uid = $_POST['user_id'];
        $pwd = $_POST['user_pass'];

        $sql1 = "SELECT * FROM tbl_students WHERE student_ID = '$uid'";
        $result1 = $conn->query($sql1);
        $query1 = $result1->num_rows;

        $sql2 = "SELECT * FROM tbl_staff WHERE staff_ID = '$uid'";
        $result2 = $conn->query($sql2);
        $query2 = $result2->num_rows;

        if ($query1 > 0) 
        {
            while ($fetch1 = mysqli_fetch_array($result1)) 
            {
                //echo "<pre>";print_r($fetch);exit();
                $student_id = $fetch1['student_ID'];
                $student_name = $fetch1['student_name'];
                $student_pwd = $fetch1['student_password'];
                if(password_verify($pwd, $student_pwd)) 
                {
                    session_unset();		
                    session_start();
                    $_SESSION['logged_role'] = "student";
                    $_SESSION['logged_user'] = $student_name;
                    $_SESSION['logged_userID'] = $student_id;

                    //header("Location: student.php");
                    echo json_encode("success_student");
                }
                else
                {
                    echo json_encode("failed");
                    //header("Location: login.php?invalid='failed'");
                }
            }
        }
        else if($query2 > 0) 
        {
            while ($fetch2 = mysqli_fetch_array($result2)) 
            {
                //echo "<pre>";print_r($fetch);exit();
                $staff_id = $fetch2['staff_ID'];
                $staff_name = $fetch2['staff_name'];
                $staff_pwd = $fetch2['staff_password'];
                if(password_verify($pwd, $staff_pwd)) 
                {		
                    session_unset();
                    session_start();
                    $_SESSION['logged_role'] = "staff";
                    $_SESSION['logged_user'] = $staff_name;
                    $_SESSION['logged_userID'] = $staff_id;
                    //header("Location: staff.php");
                    echo json_encode("success_staff");
                }
                else
                {
                    echo json_encode("failed");
                    //header("Location: login.php?invalid='failed'");
                }
            }
        }
        else
        {
            echo json_encode("invalid_data");
            //header("Location: login.php?invalid='failed'");
        }
    }
?>