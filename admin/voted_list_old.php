<table id="basic-datatables" class="display table table-striped table-hover">
    <thead>
        <tr>
            <th>voter Name</th>
            <th>Voter ID (Student/Staff)</th>
            <th>Voted Postion</th>
            <th>Condidate Name</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            include('function/db_connect.php');
            
            $sql = "SELECT t1.*,t2.position_name,t4.student_name as candidate_name FROM tbl_voter_details AS t1 JOIN tbl_candidate AS t3 ON t3.candidate_no = t1.candidate_no JOIN tbl_position AS t2 ON t2.position_no = t3.position_no JOIN tbl_students AS t4 ON t4.student_no = t1.candidate_no";

            $result = $conn->query($sql);

            if($result->num_rows >0)
            {
                $voter_name = "";
                while ($row = $result->fetch_assoc()) 
                {
                    //echo "student_name: " . $row['student_name'] . "<br>";
                    $vno = $row['voter_no'];
                    $voter_id = $row['voter_ID_(student/staff)'];
                    $pos = $row['position_name'];
                    $cand_name = $row['candidate_name'];
                    $date = $row['voting_date'];

                    $query1 = "SELECT * FROM tbl_students WHERE student_ID = '$voter_id'";
                    $query2 = "SELECT * FROM tbl_staff WHERE staff_ID = '$voter_id'";
                    $result1 = $conn->query($query1); 
                    $result2 = $conn->query($query2);

                    if(($result1->num_rows > 0)) 
                    {      
                        while ($row1 = $result1->fetch_assoc()) 
                        {     
                            $voter_name = $row1['student_name'];
                        }
                    } 
                    else if($result2->num_rows > 0)
                    {
                        while ($row2 = $result2->fetch_assoc()) 
                        {     
                            $voter_name = $row2['staff_name'];
                        }
                    }
                    ?>                    
                    <tr>
                        <td><?php  echo $voter_name; ?></td>
                        <td><?php  echo $voter_id; ?></td>
                        <td><?php  echo $pos; ?></td>
                        <td><?php  echo $cand_name; ?></td>
                        <td><?php  echo date('d-m-Y',strtotime($date)); ?></td>
                    </tr>
                    <?php
                }
            }
        ?>
    </tbody>
</table>


<table id="basic-datatables" class="display table table-striped table-hover">
    <thead>
        <tr>
            <th>Candidate Name</th>
            <th>Position</th>
            <th>Election Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            include('function/db_connect.php');
            
            $sql1 = "SELECT t1.*,t2.student_name,t3.position_name,t3.election_date FROM tbl_candidate AS t1 JOIN tbl_students AS t2 ON t2.student_no = t1.student_no JOIN tbl_position As t3 ON t3.position_no = t1.position_no";

            $result1 = $conn->query($sql1);

            if($result1->num_rows >0)
            {
                while ($row = $result1->fetch_assoc()) 
                {
                    //echo "staff_name: " . $row['staff_name'] . "<br>";
                    $cno = $row['candidate_no'];
                    $name = $row['student_name'];
                    $pos = $row['position_name'];
                    $sta = $row['status'];
                    $date = date('d-M-y',strtotime($row['election_date']));
                    ?>                    
                    <tr>
                        <td><?php  echo $name; ?></td>
                        <td><?php  echo $pos; ?></td>
                        <td><?php  echo $date; ?></td>
                        <td></td>
                    </tr>
                    <?php
                }
            }
        ?>
    </tbody>
</table>