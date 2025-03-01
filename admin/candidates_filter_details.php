<?php 
    include('function/db_connect.php');
    //echo "<pre>";print_r($_POST);exit();
    if(!empty($_POST))
    {
        if(isset($_POST['candidate_dept_id']))
        {
            $output="<option value=''>Select Student</option>";
            $dept_id = $_POST['candidate_dept_id'];

            $sql = "SELECT student_no,student_name FROM tbl_students WHERE student_department = '$dept_id'";

            $response = array();

            if ($result = $conn->query($sql)) 
            {
                $response['status']=1;

                while ($fetch = mysqli_fetch_array($result)) 
                {
                    $no = $fetch['student_no'];
                    $name = $fetch['student_name'];
                    $output.="<option value='".$no."'>".$name."</option>";						
                }
                $response['html']=$output;
            }
            echo json_encode($response);
        }

        if(isset($_POST['candidate_id']))
        {
            $candidate_id = $_POST['candidate_id'];

            $sql = "SELECT student_no, student_email, student_gender, student_ID FROM tbl_students WHERE student_no = '$candidate_id'";

            $response = array();

            if ($result = $conn->query($sql)) 
            {

                while ($fetch = mysqli_fetch_array($result)) 
                {
                    $response =$fetch;				
                }
            }
            echo json_encode($response);
        }
    }
?>