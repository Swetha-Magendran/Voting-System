<?php 
    include('function/header.php');
    include('function/db_connect.php');
?>
<style>
    select
    {
        height: 40px;
        width: 100%;
        border: 1px solid #EBEBEB;
        border-radius: 4px;
        background: transparent;
        padding-left: 15px;
        padding-right: 15px;
        -webkit-transition: 0.2s border-color;
        transition: 0.2s border-color;
        margin-bottom: 30px;
    }
    
    .hero-area {
        padding-bottom: 15px !important;
    }
</style>
	<body>

		<!-- Header -->
		<?php include('function/top_menu.php');?>
		<!-- /Header -->

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<!-- <ul class="hero-area-tree">
							<li><a href="index.html">Home</a></li>
							<li>Contact</li>
						</ul> -->
						<h1 class="white-text">Start Voting</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Contact -->
		<div id="contact" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">
                    <?php
                        if(!empty($_SESSION['logged_userID']))
                        {
                            $log_id = $_SESSION['logged_userID'];
                            //$query = "SELECT * FROM `tbl_voter_details` WHERE `voter_ID` = '$log_id'";
                            $query = "SELECT t3.student_name AS candidate_name, t4.position_name 
                            FROM tbl_voter_details AS t1 JOIN tbl_candidate AS t2 ON t2.candidate_no = t1.candidate_no 
                            JOIN tbl_students AS t3 ON t3.student_no = t2.student_no 
                            JOIN tbl_position AS t4 ON t4.position_no = t2.position_no WHERE t1.voter_ID = '$log_id'";
                            $result = $conn->query($query);
                            if($result->num_rows >0)
                            {     
                                while ($fetch = mysqli_fetch_array($result)) 
                                { 
                                    $candi_name = $fetch['candidate_name'];
                                    $pos_name = $fetch['position_name'];
                                }
                    ?>
                    <div id="output_div">
                        <div class="section-header text-center">
                            <h2>Thanks for voting!</h2>
                            <p class="lead">You have successfully voted for <B><?php echo $candi_name;?></B> for the position of <b><?php echo $pos_name;?></b>.</p>
                            <p class="lead">The results will be announced soon.</p>
                        </div>
                    </div>
                    <?php
                            }
                            else
                            {
                                ?> 
                    <div id="voting_div">
                        <form id="voting_form">  
                            <h4>Voter Details</h4>                                         
                            <?php
                                if(!empty($_SESSION['logged_userID']))
                                {
                                    $uid = $_SESSION['logged_userID'];
                                    $sql1 = "SELECT t1.student_no,t1.student_name,t1.student_ID,t2.department_name FROM tbl_students AS t1 
                                        JOIN tbl_department AS t2 ON t2.department_no = t1.student_department 
                                        WHERE t1.student_ID = '$uid'";
                                    $result1 = $conn->query($sql1);

                                    $sql2 = "SELECT t1.staff_no,t1.staff_name,t1.staff_ID,t2.department_name FROM tbl_staff AS t1 
                                        JOIN tbl_department AS t2 ON t2.department_no = t1.staff_department 
                                        WHERE t1.staff_ID = '$uid'";
                                    $result2 = $conn->query($sql2);

                                    if($result1->num_rows >0)
                                    {
                                        while ($row1 = $result1->fetch_assoc()) 
                                        {
                                            $sno = $row1['student_no'];
                                            $SID = $row1['student_ID'];
                                            $name = $row1['student_name'];
                                            $dept = $row1['department_name'];
                                        }
                                    }
                                    else if($result2->num_rows >0)
                                    {
                                        while ($row2 = $result2->fetch_assoc()) 
                                        {
                                            $sno = $row2['staff_no'];
                                            $SID = $row2['staff_ID'];
                                            $name = $row2['staff_name'];
                                            $dept = $row2['department_name'];
                                        }
                                    }
                                    else
                                    {
                                        echo "Invalid User";
                                    }
                                }
                            ?>
                            <div class="contact-form">
                                <div class="col-md-6">
                                    <label for="text">Voter Name</label>
                                    <input class="input" type="text" id="voter_name" value="<?php echo $name;?>" readonly>                        
                                    <label for="text">Voting Position</label>
                                    <?php
                                        // Current date and time
                                        $currentDate = new DateTime();
                                        $currentDate->setTime(0, 0);  // Set current time to midnight
                                        $sql1 = "SELECT * FROM tbl_position";
                                        $result1 = $conn->query($sql1);
                                        echo '<select id="candidate_position" name="candidate_position">';
                                        echo '<option value="">Select Position</option>';
                                        while ($get = $result1->fetch_assoc()) 
                                        {
                                            $pos_no = $get['position_no'];
                                            $pos_name = $get['position_name'];
                                            $ele_date = $get['election_date'];
                                            $nomi_date = $get['nomination_date'];
                                            $announce_status = $get['announce_status'];
                                            $inputDate = strtotime($nomi_date);   
                                            
                                            if($announce_status != 1)
                                            {
                                                // Date to compare (example)
                                                $dateToCheck = new DateTime($ele_date);
                                                $dateToCheck->setTime(0, 0);  // Set the date to midnight
    
                                                // // Compare the dates
                                                if ($dateToCheck < $currentDate) 
                                                {
                                                    //echo "The date is in the past.";
                                                    //echo "<option value='$pos_no'>$pos_name - Past</option>";
                                                } 
                                                elseif ($dateToCheck > $currentDate) 
                                                {
                                                    //echo "The date is in the future.";
                                                    //echo "<option value='$pos_no'>$pos_name</option>";
                                                } 
                                                else 
                                                {
                                                    //echo "The date is today (present).";
                                                    echo "<option value='$pos_no'>$pos_name</option>";
                                                }
                                                //echo "<option value='$pos_no'>$pos_name</option>";
                                            }
                                        }
                                        echo '</Select>';
                                    ?>
                                    <span class="error" style="color:red;"></span>
                                </div>
                                <div class="col-md-6">                            
                                    <label for="text">Voter ID</label>
                                    <input class="input" type="text" name="student_ID" id="student_ID" value="<?php echo $SID;?>" readonly>
                                    <label for="text">Candidate Name</label>
                                    <div id="candidates_list"></div>
                                    <!-- <select class="form-select form-control" name="candidate_no" id="candidate_no">
                                        <option value="">Select</option>
                                    </select> -->
                                    <span class="error" style="color:red;"></span>
                                    <button class="main-button icon-button pull-right" id="btn_submit">Vote Here</button>                                
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                            }
                        }
                    ?>
                </div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->

	
		<!-- preloader -->
		<div id='preloader'><div class='preloader'></div></div>
		<!-- /preloader -->


		<!-- jQuery Plugins -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>

	</body>
</html>
<script>
    $(document).ready(function() {
        $(document).on('change', '#candidate_position', function(e) 
        {
            e.preventDefault();
            var pos_id = $(this).val();
            //console.log(pos_id);
            if (pos_id != '') 
            {
                $.ajax({
                    type: 'Post',
                    url: 'candidates_details.php',
                    data: "positing_id=" + pos_id,
                    dataType: 'json',
                    success: function(response) 
                    {
                        //console.log(response);
                        //$('#candidate_no').empty().html(response.html);
                        $('#candidates_list').empty().html(response.html);
                    }
                });
            }
        });
        
        $("form#voting_form").submit(function(e) {
            e.preventDefault();
            //var formData = new FormData(this);
            var data = $('#voting_form').serialize();
            var sno = $('#student_no').val();
            var pos = $('#candidate_position').val();
            var cno = $('#candidate_no').val();
            //console.log(data);
            if (pos !== '' && cno !== '') 
            {
                $('.error').empty();
                $.ajax({
                    type: 'POST',
                    url: 'voting_store.php',
                    data: data,
                    dataType: 'json',
                    cache: false,
                    success: function(response) 
                    {
                        //console.log(response);
                        if (response == "voted") 
                        {
                            $('#student_no').val('');       
                            $('#candidate_position').val('');
                            $('#candidate_no').val('');   
                            setTimeout(function() {
                                location.reload();
                            }, 1000);  
                        } 
                        else 
                        {
                            $('.error').text('Invalid data!');
                        }
                    }
                });
            } else {
                $('.error').text('This field is required');
            }
        });
    });
</script>