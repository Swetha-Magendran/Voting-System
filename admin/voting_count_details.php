<?php 
    include('function/db_connect.php');
    //echo "<pre>";print_r($_POST);exit();
    if(!empty($_POST))
    {
        $output=""; 
        if(isset($_POST['pos_no']))
        {
            $output.=' <table class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Condidate Name</th>
                                            <th>Voting Count</th>
                                            <th>Result</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
            $pos_no = $_POST['pos_no'];

            $sql = "SELECT t3.student_name,t3.student_no FROM tbl_candidate AS t1 
            JOIN tbl_position AS t2 ON t2.position_no = t1.position_no 
            JOIN tbl_students AS t3 ON t3.student_no = t1.student_no 
            WHERE t1.position_no = '$pos_no'";

            if ($result = $conn->query($sql)) {
                $response['status'] = 1;
                $i = 1;
                $highest_value = null;
                $lowest_value = null;
                $same_value = null;  // Track if duplicate values are found
                $values = [];        // Array to track vote counts
                $candidates = [];    // To store candidate details and their vote counts
                $announce_status = 0;
                
                while ($row1 = mysqli_fetch_array($result)) {
                    $cno = $row1['student_no'];
                    $cand_name = $row1['student_name'];

                    // Query to get the voting count for each candidate
                    $sql2 = "SELECT COUNT(t1.candidate_no) AS voting_count, t3.election_result AS ele_result FROM tbl_voter_details AS t1 
                                JOIN tbl_candidate AS t2 ON t2.candidate_no = t1.candidate_no 
                                JOIN tbl_students AS t3 ON t3.student_no = t2.student_no 
                                WHERE t2.student_no = '$cno' AND t2.position_no = '$pos_no'";
                    $result2 = $conn->query($sql2);

                    if ($result2->num_rows > 0) {
                        while ($row2 = $result2->fetch_assoc()) {
                            $value = $row2['voting_count'];
                            $ele_result = $row2['ele_result'];
                            $values[] = $value;  // Track vote count
                            
                            // Update highest and lowest vote count
                            if ($highest_value === null || $value > $highest_value) {
                                $highest_value = $value;
                            }
                            if ($lowest_value === null || $value < $lowest_value) {
                                $lowest_value = $value;
                            }

                            // Store candidate details
                            $candidates[] = ['student_no' => $cno,'name' => $cand_name, 'votes' => $value, 'election_result' => $ele_result];
                        }
                    }
                }

                // Find duplicates for highest vote count
                $duplicates = array_filter($values, function($v) use ($highest_value) {
                    return $v === $highest_value;
                });

                if (count($duplicates) > 1) {
                    // There are duplicates for the highest vote count
                    $duplicate_candidates = array_filter($candidates, function($candidate) use ($highest_value) {
                        return $candidate['votes'] === $highest_value;
                    });

                    // echo "Highest Vote Count: " . $highest_value . "<br>";
                    // echo "Candidates with Highest Vote Count:<br>";
                    foreach ($duplicate_candidates as $duplicate) 
                    {
                        // echo $duplicate['student_no'] . " - " . $duplicate['name'] . " - " . $duplicate['votes'] . " votes<br>";
                        $response['candidates_details'] =$duplicate;
                        $response['count_status'] = "Draw_match";
                    }
                } else {
                    // No duplicates for the highest vote count
                    $single_candidate = array_filter($candidates, function($candidate) use ($highest_value) {
                        return $candidate['votes'] === $highest_value;
                    });
                    
                    // echo "Highest Vote_Count: " . $highest_value . "<br>";
                    foreach ($single_candidate as $candidate) {
                        // echo $candidate['student_no'] . " - " . $candidate['election_result'] . " - " . $candidate['votes'] . " votes<br>";
                        $response['candidates_details'] = $candidate;
                        $response['count_status'] = "winner";
                    }
                }
                $query = "SELECT t1.*,t2.student_no,t3.position_name, COUNT(t1.candidate_no) AS max_vote, t4.student_name, t3.announce_status 
                    FROM tbl_voter_details AS t1 JOIN tbl_candidate AS t2 ON t2.candidate_no = t1.candidate_no 
                    JOIN tbl_position AS t3 ON t3.position_no = t2.position_no 
                    JOIN tbl_students AS t4 ON t4.student_no = t2.student_no 
                    WHERE t2.position_no = '$pos_no' AND t2.student_no = '$cno' GROUP BY t1.candidate_no";
                $result3 = $conn->query($query);
                if ($result3->num_rows > 0) 
                {
                    while($row3 = $result3->fetch_assoc())
                    {
                        $sno = $row3['student_no'];
                        $announce_status = $row3['announce_status'];                         
                    }
                }
                // Output lowest value (if required)
                // echo "Lowest Vote Count: " . $lowest_value . "<br>";

                // Check for other conditions (if needed)
                //echo "<pre>";print_r($candidates);
                foreach ($candidates as $index => $candidate) {
                    
                    $output .= '<tr>';
                    $output .= '<td>' . ($index + 1) . '</td>';
                    $output .= '<td>' . $candidate['name'] . '</td>';
                    $output .= '<td>' . $candidate['votes'] . '</td>';
                    //$output.='<td></td>';
                    if(($candidate['election_result'] == 1))
                    {
                        $output.='<td>Winner</td>';
                    }	
                    else
                    {
                        $output.='<td></td>';
                    }
                    $output .= '</tr>';
                }
                $output .= '</tbody></table>';

                $response['html'] = $output;
                echo json_encode($response);
            }

        }
    }
?>