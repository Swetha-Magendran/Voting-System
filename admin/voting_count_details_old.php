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
            if ($result = $conn->query($sql)) 
            {
                $response['status']=1;
                $i = 1;  $highest = 0; 
                // Initialize variables
                $highest_value = null;
                $lowest_value = null;
                $same_value = null;  // This will store the value if a duplicate is found

                // Initialize an array to track values
                $values = [];
                while ($row1 = mysqli_fetch_array($result)) 
                {
                    $cno = $row1['student_no'];
                    $cand_name = $row1['student_name'];
                    $sql2 = "SELECT COUNT(t1.candidate_no) AS voting_count, max(t1.candidate_no) AS max_vote FROM tbl_voter_details AS t1 
                        JOIN tbl_candidate AS t2 ON t2.candidate_no = t1.candidate_no 
                            WHERE t2.student_no = '$cno' AND t2.position_no = '$pos_no'";
                    //echo "<pre>";print_r($sql2);exit();
                    $result2 = $conn->query($sql2);
                    
                    $output.='<tr>'; 
                    if ($result2->num_rows > 0) 
                    {
                        while($row2 = $result2->fetch_assoc())
                        {
                            $value = $row2['voting_count'];
                            //Track the value in an array to check for duplicates later
                            $values[] = $value;

                            // Update the highest value
                            if ($highest_value === null || $value > $highest_value) {
                                $highest_value = $value;
                            }

                            // Update the lowest value
                            if ($lowest_value === null || $value < $lowest_value) {
                                $lowest_value = $value;
                            }
                        }                               
                        
                    }
                    else
                    {
                        $vote_count = "";
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
                            $status = $row3['announce_status'];                         
                        }
                    }
                    else
                    {
                        $sno = "";
                    }
                    $output.='<tr>';
                    $output.='<td>'.$i.'</td>';
                    $output.='<td>'.$cand_name.'</td>';
                    $output.='<td>'.$value .'</td>';
                    $output.='<td></td>';
                    // if(($cno == $sno) && $status == 1)
                    // {
                    //     $output.='<td>Winner</td>';
                    // }	
                    // else
                    // {
                    //     $output.='<td></td>';
                    // }
                    $output.='</tr>';		
                    $i++;			
                }      
                
                // Check for same values (duplicates)
                $same_value = null; // Reset same_value
                $duplicates = array_count_values($values);
                foreach ($duplicates as $key => $count) 
                {
                    if ($count > 1) {
                        $same_value = $key;  // Found a duplicate value
                        break;  // We just need to find one duplicate value
                    }
                }

                // Display results
                echo "Highest value: " . $highest_value . "<br>";
                echo "Lowest value: " . $lowest_value . "<br>";
                if ($same_value !== null) 
                {
                    echo "Same value (duplicate): " . $same_value . "<br>";
                } 
                else 
                {
                    echo "No duplicates found.<br>";
                }
            }
            $output.= '</tbody>
                            </table>';

            //$response['max_count_candi'] = $candidate;
            //$response['max_count'] = $maxAmount;
            $response['html'] = $output;

            echo json_encode($response);
        }
    }



    $sql = "SELECT t3.student_name,t3.student_no FROM tbl_candidate AS t1 
        JOIN tbl_position AS t2 ON t2.position_no = t1.position_no 
        JOIN tbl_students AS t3 ON t3.student_no = t1.student_no 
        WHERE t1.position_no = '$pos_no'";

if ($result = $conn->query($sql)) {
    $response['status'] = 1;
    $i = 1;
    $highest_value = null;
    $candidates = [];  // To store candidate details and their vote counts
    
    // Step 1: Fetch candidates and their vote counts
    while ($row1 = mysqli_fetch_array($result)) {
        $cno = $row1['student_no'];
        $cand_name = $row1['student_name'];

        // Query to get the voting count for each candidate
        $sql2 = "SELECT COUNT(t1.candidate_no) AS voting_count, t3.election_result AS ele_result 
                 FROM tbl_voter_details AS t1 
                 JOIN tbl_candidate AS t2 ON t2.candidate_no = t1.candidate_no 
                 JOIN tbl_students AS t3 ON t3.student_no = t2.student_no 
                 WHERE t2.student_no = '$cno' AND t2.position_no = '$pos_no'";
        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0) {
            while ($row2 = $result2->fetch_assoc()) {
                $value = $row2['voting_count'];
                $ele_result = $row2['ele_result'];

                // Track highest vote count
                if ($highest_value === null || $value > $highest_value) {
                    $highest_value = $value;
                }

                // Store candidate details
                $candidates[] = ['student_no' => $cno, 'name' => $cand_name, 'votes' => $value, 'election_result' => $ele_result];
            }
        }
    }

    // Step 2: Find candidates with the highest vote count
    $top_candidates = array_filter($candidates, function($candidate) use ($highest_value) {
        return $candidate['votes'] === $highest_value;
    });

    // Step 3: Handle duplicates (if more than one candidate has the highest vote)
    if (count($top_candidates) > 1) {
        // Randomly select a candidate from the top candidates
        $random_key = array_rand($top_candidates);  // Random key from the top_candidates array
        $selected_candidate = $top_candidates[$random_key];

        // Prepare response for a draw match
        $response['candidates_details'] = $selected_candidate;
        $response['count_status'] = "Draw_match";  // Indicates a draw with random selection
    } else {
        // No duplicates, just select the single candidate with the highest vote count
        $selected_candidate = reset($top_candidates);  // Since there's only one candidate with the highest vote
        $response['candidates_details'] = $selected_candidate;
        $response['count_status'] = "winner";  // Indicates a single winner
    }

    // Step 4: Prepare HTML table output
    $output = '<table class="table"><thead><tr><th>Rank</th><th>Candidate Name</th><th>Votes</th><th>Status</th></tr></thead><tbody>';
    foreach ($candidates as $index => $candidate) {
        $output .= '<tr>';
        $output .= '<td>' . ($index + 1) . '</td>';
        $output .= '<td>' . $candidate['name'] . '</td>';
        $output .= '<td>' . $candidate['votes'] . '</td>';

        // Display status as "Winner" if they won
        if (($candidate['election_result'] == 1) && ($announce_status == 1)) {
            $output .= '<td>Winner</td>';
        } else {
            $output .= '<td></td>';
        }

        $output .= '</tr>';
    }
    $output .= '</tbody></table>';

    $response['html'] = $output;
    echo json_encode($response);
}

?>


