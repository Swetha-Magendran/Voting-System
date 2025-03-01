<?php
    include('function/db_connect.php');
    clearstatcache();
    //print_r($_POST);exit();
    if(!empty($_POST))
    {
        $ano    = $_POST['admin_no'];
        $name   = $_POST['admin_name'];
        $aid = $_POST['admin_ID'];
        $pwd    = $_POST['password'];
        $hashedPassword = password_hash($pwd, PASSWORD_DEFAULT);
        //print_r($_POST['password']);
        if(empty($ano))
        {
            $check = $conn->prepare("SELECT * FROM tbl_admin WHERE admin_ID = '$name'");
            $check->execute();
            $check->store_result(); 
            
            if ($check->num_rows > 0) 
            {
                echo json_encode("This admin is already exists.");
            } 
            else 
            {
                $sql = "INSERT INTO tbl_admin (admin_ID, admin_name, admin_password) VALUES ('$aid', '$name', '$hashedPassword')";
    
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
            $sql = "UPDATE tbl_admin SET admin_ID = '$aid', admin_name = '$name', admin_password = '$hashedPassword' WHERE admin_no  = '$ano'";
            
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