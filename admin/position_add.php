<?php
    include('function/db_connect.php');
    clearstatcache();
    //print_r($_POST);exit();
    if(!empty($_POST))
    {
        $sno    = $_POST['position_no'];
        $name   = $_POST['position_name'];
        $limit = $_POST['position_limit'];
        $ele_date = $_POST['election_date'];
        $nomi_date = $_POST['nomination_date'];
        $res_date = $_POST['election_result_date'];
        if(empty($sno))
        {
            $check = $conn->prepare("SELECT * FROM tbl_position WHERE position_name = '$name'");
            $check->execute();
            $check->store_result(); 
            
            if ($check->num_rows > 0) 
            {
                echo json_encode("This position is already exists.");
            } 
            else 
            {
                $sql = "INSERT INTO tbl_position (position_name, position_limit, election_date, nomination_date, result_date) 
                VALUES ('$name', '$limit', '$ele_date', '$nomi_date', '$res_date')";
    
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
            $sql = "UPDATE tbl_position SET position_name = '$name', position_limit = '$limit', election_date = '$ele_date', nomination_date = '$nomi_date', result_date = '$res_date' WHERE position_no = '$sno'";
            
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