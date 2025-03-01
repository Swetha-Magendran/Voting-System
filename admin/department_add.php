<?php
    include('function/db_connect.php');
    clearstatcache();
    //print_r($_POST);exit();
    if(!empty($_POST))
    {
        $sno    = $_POST['department_no'];
        $name   = $_POST['department_name'];
        $full   = $_POST['department_full_form'];

        if(empty($sno))
        {
            $check = $conn->prepare("SELECT * FROM tbl_department WHERE department_name = '$name' AND department_full_name = '$full'");
            $check->execute();
            $check->store_result(); 
            
            if ($check->num_rows > 0) 
            {
                echo json_encode("This department is already exists.");
            } 
            else 
            {
                $sql = "INSERT INTO tbl_department (department_name, department_full_name) VALUES ('$name', '$full')";
    
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
            $sql = "UPDATE tbl_department SET department_name = '$name', department_full_name = '$full' WHERE department_no = '$sno'";
            
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