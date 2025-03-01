<?php
include('function/header.php');
include('function/db_connect.php');
?>
<style>
    select {
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
    .contact-form textarea.input {
        height: 105px !important;
    }
    .section-header {
        padding-top: 40px !important;
    }


  
</style>

<body>

    <!-- Header -->
    <?php include('function/top_menu.php'); ?>
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
                    <h1 class="white-text">Apply for Candidature</h1>

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Contact -->
    <div id="contact" class="section" style="padding-top: 25px !important;padding-bottom: 80px !important;;">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">
                <!-- <div class="col-md-1"></div> -->
                <!-- contact form -->
                <div class="col-md-12">
                    <?php
                    if (!empty($_SESSION['logged_userID'])) {
                        $log_id = $_SESSION['logged_userID'];
                        $query = "SELECT t1.*,t2.student_ID,t3.position_name FROM tbl_candidate AS t1 JOIN tbl_students AS t2 ON t2.student_no = t1.student_no JOIN tbl_position As t3 ON t3.position_no = t1.position_no  WHERE t2.student_ID = '$log_id'";
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($fetch1 = mysqli_fetch_array($result)) {
                                //echo "<pre>";print_r($fetch);exit();
                                $sta = $fetch1['status'];
                                $student_id = $fetch1['student_ID'];
                                $pos_name = $fetch1['position_name'];
                                if ($sta == 1) {
                    ?>
                                    <div class="contact-form" id="output_div">
                                        <div class="section-header text-center">
                                            <!-- <h2>Your request has been sent successfully.</h2>
                                        <p class="lead">You have to wait for the staff response.</p> -->
                                            <h2>Congratulations!</h2>
                                            <p class="lead">Your candidature has been accepted for the position of <b><?php echo $pos_name; ?></b>!</p>
                                        </div>
                                    </div>
                                <?php
                                } 
                                else if($sta == 2)
                                {
                                    ?>
                                        <div class="contact-form" id="output_div">
                                            <div class="section-header text-center">
                                                <!-- <h2>Your request has been sent successfully.</h2>
                                            <p class="lead">You have to wait for the staff response.</p> -->
                                            <h2>Thank you for applying!</h2>
                                            <p class="lead">Unfortunately, your application has not been accepted. 
                                                We appreciate your interest in running for office and encourage you to apply again in the future.</p>
                                            </div>
                                        </div>
                                <?php
                                    }
                                else 
                                {
                                ?>
                                    <div class="contact-form" id="output_div">
                                        <div class="section-header text-center">
                                            <!-- <h2>Your request has been sent successfully.</h2>
                                        <p class="lead">You have to wait for the staff response.</p> -->
                                            <h2>Your application has been submitted successfully!</h2>
                                            <p class="lead">Your application is now being reviewed.</p>
                                            <p class="lead">You will receive an update regarding your status in a few days.</p>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                        } else {
                            ?>
                            <div class="contact-form" id="form_div">
                                <!-- <h4>Candidature Entry Form</h4> -->
                                <form id="candidate_form">
                                    <?php
                                    if (!empty($_SESSION['logged_userID'])) {
                                        $uid = $_SESSION['logged_userID'];
                                        $sql1 = "SELECT t1.student_no,t1.student_name,t1.student_ID,t2.department_name FROM tbl_students AS t1 
                                            JOIN tbl_department AS t2 ON t2.department_no = t1.student_department 
                                            WHERE t1.student_ID = '$uid'";
                                        $result1 = $conn->query($sql1);
                                        if ($result1->num_rows > 0) {
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $sno = $row1['student_no'];
                                                $cno = $row1['student_ID'];
                                                $name = $row1['student_name'];
                                                $dept = $row1['department_name'];
                                            }
                                        }
                                    }
                                    ?>
                                    <div class="col-md-6">
                                        <input type="hidden" name="student_no" id="student_no" value="<?php echo $sno; ?>">
                                        <label for="text">Student Name</label>
                                        <input class="input" type="text" id="candidate_name" value="<?php echo $name; ?>" readonly>
                                        <label for="text">Student ID</label>
                                        <input class="input" type="text" id="candidate_ID" value="<?php echo $cno; ?>" readonly>
                                        <!-- Candidate's Vision -->
                                        <label for="vision">Why are you a good fit for this position? (Your vision for the role)</label><br>
                                        <span class="error" style="color:red;"></span>
                                        <textarea class="input" id="election_vision" name="election_vision" rows="3" placeholder="Explain your qualifications, vision, and what you plan to achieve if elected."></textarea>
                                        
                                    </div>
                                    <div class="col-md-6">
                                        <label for="text">Student Department</label>
                                        <input class="input" type="text" id="candidate_dept" value="<?php echo $dept; ?>" readonly>
                                        <label for="text">Candidate Position</label>
                                        <span class="error" style="color:red;"></span>
                                        <?php
                                        // Current date and time
                                        $currentDate = new DateTime();
                                        $currentDate->setTime(0, 0);  // Set current time to midnight
                                        $sql1 = "SELECT * FROM tbl_position";
                                        $result1 = $conn->query($sql1);
                                        echo '<select id="candidate_position" name="candidate_position">';
                                        echo '<option value="">Select Position</option>';
                                        while ($get = $result1->fetch_assoc()) {
                                            $pos_no = $get['position_no'];
                                            $pos_name = $get['position_name'];
                                            $nomi_date = $get['nomination_date'];
                                            $announce_status = $get['announce_status'];
                                            $inputDate = strtotime($nomi_date);
                                            if ($announce_status != 1) {
                                                // Date to compare (example)
                                                $dateToCheck = new DateTime($nomi_date);
                                                $dateToCheck->setTime(0, 0);  // Set the date to midnight

                                                // // Compare the dates
                                                if ($dateToCheck < $currentDate) {
                                                    //echo "The date is in the past.";
                                                    //echo "<option value='$pos_no'>$pos_name - Past</option>";
                                                } elseif ($dateToCheck > $currentDate) {
                                                    //echo "The date is in the future.";
                                                    echo "<option value='$pos_no'>$pos_name</option>";
                                                } else {
                                                    //echo "The date is today (present).";
                                                    echo "<option value='$pos_no'>$pos_name</option>";
                                                }
                                                //echo "<option value='$pos_no'>$pos_name</option>";
                                            }
                                        }
                                        echo '</Select>';
                                        ?>

                                        <!-- Experience -->
                                        <label for="experience">Relevant Experience (if any)</label><span class="error" style="color:red;"></span>
                                        <textarea class="input" id="experience" name="experience" rows="3" placeholder="Describe any relevant leadership, club involvement, or activities."></textarea>
                                        
                                        <div id="message"></div>
                                        <button class="main-button icon-button pull-right" id="btn_submit">Request</button>
                                    </div>
                                </form>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <!-- /contact form -->
                <!-- <div class="col-md-1"></div> -->
            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Contact -->


    <!-- preloader -->
    <div id='preloader'>
        <div class='preloader'></div>
    </div>
    <!-- /preloader -->


    <!-- jQuery Plugins -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/main.js"></script>

</body>

</html>
<script>
    $(document).ready(function() {
        //$('#output_div').hide();
        //$('#btn_submit').on('click', function(){             
        $("form#candidate_form").submit(function(e) {
            e.preventDefault();
            //var formData = new FormData(this);
            var data = $('#candidate_form').serialize();
            var name = $('#candidate_name').val();
            var cid = $('#candidate_ID').val();
            var dept = $('#candidate_dept').val();
            var pos = $('#candidate_position').val();
            var vision = $('#election_vision').val();
            var experience = $('#experience').val();
            //console.log(data);
            if (name !== '' && cid !== '' && dept !== '' && pos !== '' && vision != '' && experience != '') {
                $('.error').empty();
                $.ajax({
                    type: 'POST',
                    url: 'candidate_request.php',
                    data: data,
                    dataType: 'json',
                    cache: false,
                    success: function(response) {
                        //console.log(response);
                        if (response == 'inserted') {
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        } else if (response == 'reached') {
                            $('#message').empty();

                            $('#message').html("<h4 style='color:red; font-weight:bold; text-align:center;'>The nomination limit has been reached. No further nominations can be accepted.</h4>");

                            $("#message").show();
                        } else {
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