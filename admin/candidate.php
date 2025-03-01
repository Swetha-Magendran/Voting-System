<?php
include('function/header.php');
include('function/db_connect.php');
?>

<body>
    <div class="wrapper">
        <?php include('function/left_menu.php'); ?>

        <div class="main-panel">
            <?php include('function/main_header.php'); ?>

            <!-- Delete Modal Start-->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmation</h4>
                        </div>
                        <div class="modal-body">
                            <p>Do you want ot delete this record?</p>
                            <input type="hidden" name="get_candidate_id" id="get_candidate_id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn_cancel" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger btn_delete" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Delete Modal End-->

            <!-- Reject Modal Start-->
            <div id="myModal_reject" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Candidate Rejection</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <form action="#" id="reject_form">
                                    <input type="hidden" id="reject_cno">
                                    <input type="hidden" id="reject_status">
                                    <label for="comment">
                                        <h5>Reason For Rejection</h5>
                                    </label>
                                    <textarea class="form-control" id="rej_reason" name="rej_reason" rows="5">
                                </textarea>
                                </form>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn_cancel" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger btn_reject" data-dismiss="modal">Reject</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Reject Modal End-->

            <div class="container">
                <div class="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Candidates List</h4>
                                        <div id="sucess_msg" style="margin-left: 30px;"></div>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#addRowModal">
                                            Add Candidate
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->
                                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="width: 150% !important;">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold"> Add</span>
                                                        <span class="fw-light"> Department </span>
                                                    </h5>
                                                    <button type="button" class="close btn_cancel" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="#" method="POST" id="candidate_form" enctype="multipart/form-data">
                                                        <input type="hidden" id="candidate_sno" name="candidate_sno">
                                                        <input type="hidden" id="student_no" name="student_no">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="email2">Candidate Department</label>
                                                                        <?php
                                                                        $sql = "SELECT * FROM tbl_department";
                                                                        $result = $conn->query($sql);
                                                                        echo '<select class="form-select form-control" id="candidate_dept" name="candidate_dept">';
                                                                        echo '<option value="">Select</option>';
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            //echo "staff_name: " . $row['staff_name'] . "<br>";
                                                                            $dept_no = $row['department_no'];
                                                                            $dept_name = $row['department_name'];

                                                                            echo "<option value='$dept_no'>$dept_name</option>";
                                                                        }
                                                                        echo '</Select>';
                                                                        ?>
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email2">Candidate Name</label>
                                                                        <!-- <input type="text" class="form-control" id="candidate_name" name="candidate_name" placeholder="Candidate Name" /> -->
                                                                        <select class="form-select form-control" name="candidate_name" id="candidate_name">
                                                                            <!-- <option value="">Select</option> -->
                                                                        </select>
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="email2">Candidate Email</label>
                                                                        <input type="text" class="form-control" id="candidate_email" placeholder="Candidate Email" readonly />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email2">Candidate ID</label>
                                                                        <input type="text" class="form-control" id="candidate_id" placeholder="Candidate ID" readonly />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="defaultSelect">Gender</label>
                                                                        <input type="text" class="form-control" id="gender" placeholder="Gender" readonly />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email2">Candidate Position</label>
                                                                        <?php
                                                                        // Current date and time
                                                                        $currentDate = new DateTime();
                                                                        $currentDate->setTime(0, 0);  // Set current time to midnight
                                                                        $sql1 = "SELECT * FROM tbl_position";
                                                                        $result1 = $conn->query($sql1);
                                                                        echo '<select class="form-select form-control" id="candidate_position" name="candidate_position">';
                                                                        echo '<option value="">Select</option>';
                                                                        while ($get = $result1->fetch_assoc()) {
                                                                            //echo "staff_name: " . $get['staff_name'] . "<br>";
                                                                            $pos_no = $get['position_no'];
                                                                            $pos_name = $get['position_name'];
                                                                            $nomi_date = $get['nomination_date'];
                                                                            $ele_date = date('d-m-y', strtotime($get['election_date']));
                                                                            $inputDate = strtotime($nomi_date);

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
                                                                        echo '</Select>';
                                                                        ?>
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-action">
                                                            <button class="btn btn-success" id="btn_submit">Submit</button>
                                                            <button class="btn btn-danger btn_cancel">Cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive refresh_candidate_table" id="refresh_candidate_table">
                                        <?php include('candidate_list.php'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('function/footer.php'); ?>

            <script>
                $(document).on('change', '#candidate_dept', function(e) {
                    e.preventDefault();
                    var candidate_dept_id = $(this).val();
                    //console.log(candidate_dept_id);
                    if (candidate_dept_id != '') {
                        $.ajax({
                            type: 'Post',
                            url: 'candidates_filter_details.php',
                            data: "candidate_dept_id=" + candidate_dept_id,
                            dataType: 'json',
                            success: function(response) {
                                //console.log(response);
                                $('#candidate_name').empty().html(response.html);
                            }
                        });
                    }
                });

                $(document).on('change', '#candidate_name', function(e) {
                    e.preventDefault();
                    var candidate_id = $(this).val();
                    //console.log(candidate_dept_id);
                    if (candidate_id != '') {
                        $.ajax({
                            type: 'Post',
                            url: 'candidates_filter_details.php',
                            data: "candidate_id=" + candidate_id,
                            dataType: 'json',
                            success: function(response) {
                                //console.log(response);
                                $('#candidate_email').val(response.student_email);
                                $('#gender').val(response.student_gender);
                                $('#candidate_id').val(response.student_ID);
                                $('#student_no').val(response.student_no)
                            }
                        });
                    }
                });

                $(document).on('click', '.btn_verify', function(e) {
                    e.preventDefault();
                    var get_cno = $(this).attr('get_cno');
                    var val = $(this).val();
                    // console.log(get_cno);
                    // console.log(val);
                    if (get_cno != '' && val == 0) 
                    {
                        var data = {
                            'candidate_no' : get_cno,
                            'status' : val
                        }
                        $.ajax({
                            type: 'POST',
                            url: 'candidate_status_update.php',
                            data: data,
                            dataType: 'json',
                            success: function(result) {
                                //console.log(result); 
                                if(result == 'updated')   
                                {               
                                    $('#reject_cno').val('');
                                    $('#reject_status').val('');                
                                    $('#message').empty();

                                    $('#sucess_msg').html("<div id='message'></div>");

                                    $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>This candidate has been added to waiting list!</h4>")

                                    $("#message").show();

                                    // setTimeout(function() {
                                    //         $("#message").hide();
                                    //     }, 2500)
                                        
                                }
                            }
                        });
                    }
                    else if (get_cno != '' && val == 1) {
                        var data = {
                            'candidate_no' : get_cno,
                            'status' : val
                        }
                        $.ajax({
                            type: 'POST',
                            url: 'candidate_status_update.php',
                            data: data,
                            dataType: 'json',
                            success: function(result) {
                                //console.log(result);
                                if(result == 'updated')   
                                {                 
                                    $('#reject_cno').val('');
                                    $('#reject_status').val('');              
                                    $('#message').empty();

                                    $('#sucess_msg').html("<div id='message'></div>");

                                    $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>This candidate has been approved!</h4>")

                                    $("#message").show();

                                    // setTimeout(function() {
                                    //         $("#message").hide();
                                    //     }, 2500)

                                    var loadUrl = "candidate_list.php";

                                    $(".refresh_candidate_table").load(loadUrl);
                                }
                            }
                        });
                    }
                    else
                    {
                        $('#myModal_reject').modal('show');
                        $('#reject_cno').val(get_cno);
                        $('#reject_status').val(val);
                    }
                });

                $(document).on('click', '.btn_reject', function(e) {
                    e.preventDefault();
                    var get_id = $('#reject_cno').val();
                    var val = $('#reject_status').val();
                    var reason = $('#rej_reason').val();
                    //console.log(get_id);
                    if (get_id != '' && val != '' && reason != '') {
                        var data = {
                            'candidate_no' : get_id,
                            'status' : val,
                            'reason' : reason
                        }
                        $.ajax({
                            type: 'POST',
                            url: 'candidate_status_update.php',
                            data: data,
                            dataType: 'json',
                            success: function(result) {
                                //console.log(result);
                                if(result == 'updated')   
                                {                 
                                    $('#reject_cno').val('');
                                    $('#reject_status').val('');       
                                    $('#myModal_reject').modal('hide');    
                                    $('#message').empty();

                                    $('#sucess_msg').html("<div id='message'></div>");

                                    $('#message').html("<h4 style='color:red; font-weight:bold;text-align:center;'>This candidate has been rejected!</h4>")

                                    $("#message").show();

                                    // setTimeout(function() {
                                    //         $("#message").hide();
                                    //     }, 2500)

                                    var loadUrl = "candidate_list.php";

                                    $(".refresh_candidate_table").load(loadUrl);
                                }
                            }
                        });
                    }
                });

                //Candidate form add and update details here
                $(document).ready(function() {
                    $("form#candidate_form").submit(function(e) {
                        e.preventDefault();
                        var data = $('#candidate_form').serialize();
                        var name = $('#candidate_name').val();
                        var email = $('#candidate_email').val();
                        var dept = $('#candidate_dept').val();
                        var gen = $('#gender').val();
                        var candidate_id = $('#candidate_id').val();
                        var position = $('#candidate_position').val();
                        //console.log(position);
                        if (name !== '' && email !== '' && dept !== '' && gen !== '' && candidate_id !== '' && position !== '') {
                            $('.error').empty();
                            // Here, you can submit the form or do other actions

                            $.ajax({
                                type: 'POST',
                                url: 'candidate_add.php',
                                data: data,
                                dataType: 'json',
                                success: function(response) {
                                    //console.log(response);
                                    if (response == 'success') {
                                        $('#message').empty();

                                        $('#sucess_msg').html("<div id='message'></div>");

                                        $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>Candidate Details Added Successfully</h4>")

                                        $("#message").show();

                                        setTimeout(function() {
                                            $("#message").hide();
                                        }, 2500)

                                        $('#candidate_name').val('');
                                        $('#candidate_email').val('');
                                        $('#candidate_dept').val('');
                                        $('#gender').val('');
                                        $('#candidate_id').val('');
                                        $('#candidate_position').val('');
                                        $('#student_no').val('');
                                        $('#addRowModal').modal('hide');

                                        var loadUrl = "candidate_list.php";

                                        $(".refresh_candidate_table").load(loadUrl);

                                        setTimeout(function() {
                                            location.reload();
                                        }, 3000);
                                    } else if (response == 'updated') {
                                        var loadUrl = "candidate_list.php";

                                        $(".refresh_candidate_table").load(loadUrl);

                                        $('#message').empty();

                                        $('#sucess_msg').html("<div id='message'></div>");

                                        $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>Candidate Details Updated Successfully</h4>")

                                        $("#message").show();

                                        setTimeout(function() {
                                            $("#message").hide();
                                        }, 2500)

                                        $('#candidate_sno').val('');
                                        $('#student_no').val('');
                                        $('#candidate_name').val('');
                                        $('#candidate_email').val('');
                                        $('#candidate_dept').val('');
                                        $('#gender').val('');
                                        $('#candidate_id').val('');
                                        $('#candidate_position').val('');
                                        $('#addRowModal').modal('hide');

                                        setTimeout(function() {
                                            location.reload();
                                        }, 3000);
                                    } else {
                                        $('#message').empty();

                                        $('#sucess_msg').html("<div id='message'></div>");

                                        $('#message').html("<h4 style='color:red; font-weight:bold;text-align:center;'>" + response + "</h4>")

                                        $("#message").show();
                                    }
                                }
                            });
                        } else {
                            $('.error').text('This field is required');
                        }
                    });
                });

                //Candidate form get values here
                $(document).on('click', '.btn_edit', function(e) {
                    e.preventDefault();
                    var get_id = $(this).attr('value');
                    //console.log(get_id);
                    if (get_id != '') {
                        $.ajax({
                            type: 'POST',
                            url: 'candidate_get_details.php',
                            data: "candidate_id=" + get_id,
                            dataType: 'json',
                            success: function(result) {
                                //console.log(response);
                                $('#addRowModal').modal('show');
                                $('#candidate_sno').val(result.candidate_no);
                                $('#student_no').val(result.student_no);
                                $('#candidate_name').append('<option value=' + result.student_no + '>' + result.student_name + '</option>');
                                //$('#candidate_name').val(result.student_name);
                                $('#candidate_email').val(result.student_email);
                                $('#candidate_dept').val(result.student_department);
                                $('#gender').val(result.student_gender);
                                $('#candidate_id').val(result.student_ID);
                                $('#candidate_position').val(result.position_no);
                            }
                        });
                    }
                });

                $(document).on('click', '.btn_cancel', function(e) {
                    e.preventDefault();
                    $('#myModal').modal('hide');
                    $('#myModal_approved').modal('hide');
                    $('#myModal_reject').modal('hide');
                    $('#addRowModal').modal('hide');
                    $('#candidate_sno').val('');
                    $('#student_no').val('');
                    $('#candidate_name').empty();
                    $('#candidate_email').val('');
                    $('#candidate_dept').val('');
                    $('#gender').val('');
                    $('#candidate_id').val('');
                    $('#candidate_position').val('');
                    $('#approve_cno').val('');
                    $('#reject_cno').val('');
                    // if ($(".status").is(':checked')) 
                    // {

                    // }
                    // else
                    // {

                    // }
                });

                $(document).on('click', '.btn_del', function(e) {
                    e.preventDefault();
                    var candidate_id = $(this).attr('value');
                    //console.log(staff_id);
                    $('#get_candidate_id').val(candidate_id);
                    $('#myModal').modal('show');
                });

                $(document).on('click', '.btn_delete', function(e) {
                    e.preventDefault();
                    var candidate_no = $('#get_candidate_id').val();
                    //console.log(candidate_no);
                    if (candidate_no != '') {
                        $.ajax({
                            type: 'POST',
                            url: 'delete_data.php',
                            data: "candidate_id=" + candidate_no,
                            dataType: 'json',
                            success: function(result) {
                                if (result == 'deleted') {
                                    var loadUrl = "candidate_list.php";

                                    $(".refresh_candidate_table").load(loadUrl);

                                    $('#sucess_msg').html("<div id='message'></div>");

                                    $('#message').html("<h4 style='color:block; font-weight:bold;text-align:center;'>Candidate Details Deleted Successfully</h4>")

                                    $("#message").show();

                                    setTimeout(function() {
                                        $("#message").hide();
                                    }, 2500)

                                    $('#get_candidate_id').val('');
                                    $('#myModal').modal('hide');
                                }
                            }
                        });
                    }
                });
            </script>