<?php 
    include('function/db_connect.php');
    //echo "<pre>";print_r($_POST);exit();
    if(!empty($_POST))
    {
        if(isset($_POST['positing_id']))
        {
            $output = "";
            //$output="<option value=''>Select Candidate</option>";
            $pos_id = $_POST['positing_id'];

            $sql = "SELECT t2.student_no,t2.student_name FROM tbl_candidate AS t1 
            JOIN tbl_students AS t2 ON t2.student_no = t1.student_no WHERE t1.status = 1 AND t1.position_no = '$pos_id'";

            $response = array();

            if ($result = $conn->query($sql)) 
            {
                $response['status'] = 1;

                while ($fetch = mysqli_fetch_array($result)) 
                {
                    $no = $fetch['student_no'];
                    $name = $fetch['student_name'];
                    //$output.="<option value='".$no."'>".$name."</option>";
                    $output .= '<input type="radio" id="candi_no_'.$no.'" name="candidate_no" value="'.$no.'">
                                    <label for="html">'.$name.'</label><br>';						
                }
                $response['html']=$output;
            }
            echo json_encode($response);
        }
    }
?>