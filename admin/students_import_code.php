<?php
// backend_logout.php
session_name("backend_session");  // Specify backend session
session_start();
include('function/db_connect.php');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if(isset($_POST['save_excel_data']))
{
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx','ods'];


    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        foreach($data as $row)
        {
            if($count > 0)
            {
                //$name = $row['0'];
                $name = $row['1'];
                $email = $row['2'];
                $dept = $row['3'];
                $gen = $row['4'];
                $stu_id = $row['5'];
                $dob = date('Y-m-d',strtotime($row['6']));
                $hashedPassword = $row['7'];
                //echo ("SELECT * FROM `tbl_students` WHERE student_name='$name' AND student_department='$dept' AND student_ID='$stu_id'").'<br><br>';
                $check = $conn->query("SELECT * FROM `tbl_students` WHERE student_department='$dept'");
                //echo $check.'<br>';
                //echo ($check->num_rows).'<br>';
                if ($check->num_rows == 0) 
                {
                    $studentQuery = "INSERT INTO tbl_students (student_name, student_email, student_department, student_gender, student_ID, student_dob, student_password)
                    VALUES ('$name', '$email', '$dept', '$gen', '$stu_id', '$dob', '$hashedPassword')";
                    $result = $conn->query($studentQuery);
    
                    $msg = 'true';
                    $_SESSION['message'] = "<h4 style='color:green; font-weight:bold;text-align:center;'>Successfully Imported</h4>";
                    header('Location: student.php');
                    exit(0);
                }
                else
                {
                    $msg = 'false';
                    $_SESSION['message'] = "<h4 style='color:red; font-weight:bold;text-align:center;'>No New Records Found!</h4>";
                    header('Location: student.php');
                    exit(0);
                }
            }
            else
            {
                $count = "1";
            }
        }
    }
    else
    {
        $_SESSION['message'] = "<h4 style='color:red; font-weight:bold;text-align:center;'>Invalid File</h4>";
        header('Location: student.php');
        exit(0);
    }
}
?>