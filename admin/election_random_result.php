<?php
    include('function/db_connect.php');
    //clearstatcache();
    //echo "<pre>";print_r($_POST);exit();
    if(!empty($_POST))
    {
        $pno    = $_POST['pos_no'];   

        $query = "SELECT t1.*,t3.position_name, t2.student_no , COUNT(t1.candidate_no) AS max_vote, t4.student_name 
            FROM tbl_voter_details AS t1 JOIN tbl_candidate AS t2 ON t2.candidate_no = t1.candidate_no 
            JOIN tbl_position AS t3 ON t3.position_no = t2.position_no 
            JOIN tbl_students AS t4 ON t4.student_no = t2.student_no 
            WHERE t2.position_no = '$pno' GROUP BY t1.candidate_no";
        $result = $conn->query($query);
        //echo "<pre>";print_r($result->num_rows);exit();   
        if ($result->num_rows > 0)
        {   
            $highest_value = null;
            $lowest_value = null;
            $same_value = null;  // Track if duplicate values are found
            $values = [];        // Array to track vote counts
            $candidates = [];    // To store candidate details and their vote counts

           
            while ($row = mysqli_fetch_array($result)) 
            {
                $cno = $row['student_no'];
                $candidate_name = $row['student_name'];
                $candidate_pos= $row['position_name'];
                $value = $row['max_vote'];
                $values[] = $value;  // Track vote count
                            
                // Update highest and lowest vote count
                if ($highest_value === null || $value > $highest_value) {
                    $highest_value = $value;
                }
                if ($lowest_value === null || $value < $lowest_value) {
                    $lowest_value = $value;
                }

                // Store candidate details
                $candidates[] = ['student_no' => $cno,'name' => $candidate_name, 'votes' => $value, 'position' => $candidate_pos];
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
                //echo $selected_candidate['student_no'] . " - " . $selected_candidate['name'] . " - " . $selected_candidate['position'] . " - " . $selected_candidate['votes'] . " votes<br>";
                $sno = $selected_candidate['student_no'];

                $sql = "UPDATE tbl_position SET announce_status = '1' WHERE position_no = '$pno'";
                $get = $conn->query($sql);

                $sql01 = "UPDATE tbl_students SET election_result = '1' WHERE student_no = '$sno'";
                $get01 = $conn->query($sql01);

                // Prepare response for a draw match
                $response['candidates_details'] = $selected_candidate;
                $response['count_status'] = "Draw_match";  // Indicates a draw with random selection
                $response['status'] = "updated";
                $response['candi_name'] = $selected_candidate['name'];
                $response['candi_pos'] = $selected_candidate['position'];

            } else {
                // No duplicates for the highest vote count
                $single_candidate = array_filter($candidates, function($candidate) use ($highest_value) {
                    return $candidate['votes'] === $highest_value;
                });
                
                // echo "Highest Vote_Count: " . $highest_value . "<br>";
                foreach ($single_candidate as $candidate) {
                    // echo $candidate['student_no'] . " - " . $candidate['name'] . " - " . $candidate['votes'] . " votes<br>";
                    $win_sno = $candidate['student_no'];
                }
            }
            
            //$response['status'] = "updated";

            echo json_encode($response);
        } 
        else 
        {
            echo json_encode("Error: " . $query . "<br>" . $conn->error);
        }

        $conn->close();
        
    }
    
?>