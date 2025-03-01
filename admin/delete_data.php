<?php
    include('function/db_connect.php');


    if(isset($_POST['Staff_id']))
    {
        $staffno = $_POST['Staff_id'];
        $sql = "DELETE from tbl_staff where staff_no = $staffno";
        if ($conn->query($sql)) 
        {
            echo json_encode("deleted");
        } 
        else 
        {
            echo json_encode("Error: " . $sql . "<br>" . $conn->error);
        }
    }

    if(isset($_POST['Student_id']))
    {
        $studentno = $_POST['Student_id'];
        $sql = "DELETE from tbl_students where student_no = $studentno";
        if ($conn->query($sql)) 
        {
            echo json_encode("deleted");
        } 
        else 
        {
            echo json_encode("Error: " . $sql . "<br>" . $conn->error);
        }
    }

    if(isset($_POST['position_id']))
    {
        //echo "<pre>";print_r($_POST);exit();
        $position_id = $_POST['position_id'];
        $query1 = "SELECT * FROM tbl_candidate WHERE position_no = $position_id";
        $query2 = "SELECT * FROM tbl_voter_details WHERE position_no = $position_id";
        $result1 = $conn->query($query1); 
        $result2 = $conn->query($query2);
        
        if(($result1->num_rows > 0) || ($result2->num_rows > 0)) 
        {           
            echo json_encode("This position is used in somewhere. So not able delete this position.");
        }
        else  
        {
            $sql = "DELETE from tbl_position where position_no = $position_id";
            if ($conn->query($sql)) 
            {
                echo json_encode("deleted");
            } 
            else 
            {
                echo json_encode("Error: " . $sql . "<br>" . $conn->error);
            }
        }      
        
    }

    if(isset($_POST['department_id']))
    {
        $department_id = $_POST['department_id'];
        $query1 = "SELECT * FROM tbl_students WHERE student_department = $department_id";
        $query2 = "SELECT * FROM tbl_staff WHERE staff_department = $department_id";
        $result1 = $conn->query($query1); 
        $result2 = $conn->query($query2);
        
        if(($result1->num_rows > 0) || ($result2->num_rows > 0)) 
        {           
            echo json_encode("This department is used in somewhere. So not able delete this department.");
        }
        else  
        {
            $department_id = $_POST['department_id'];
            $sql = "DELETE from tbl_department where department_no = $department_id";
            if ($conn->query($sql)) 
            {
                echo json_encode("deleted");
            } 
            else 
            {
                echo json_encode("Error: " . $sql . "<br>" . $conn->error);
            }
        }
    }

    if(isset($_POST['candidate_id']))
    {
        $candidate_id = $_POST['candidate_id'];
        $sql = "DELETE from tbl_candidate where candidate_no = $candidate_id";
        if ($conn->query($sql)) 
        {
            echo json_encode("deleted");
        } 
        else 
        {
            echo json_encode("Error: " . $sql . "<br>" . $conn->error);
        }
    }

    if(isset($_POST['admin_id']))
    {
        $aid = $_POST['admin_id'];
        $sql = "DELETE from tbl_admin where admin_no = $aid";
        if ($conn->query($sql)) 
        {
            echo json_encode("deleted");
        } 
        else 
        {
            echo json_encode("Error: " . $sql . "<br>" . $conn->error);
        }
    }
?>