<?php
include('function/header.php');
include('function/db_connect.php');
?>

<body>
    <div class="wrapper">
        <?php include('function/left_menu.php'); ?>

        <div class="main-panel">
            <?php include('function/main_header.php'); ?>

            <!-- Modal Start-->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Confirmation</h4>
                        </div>
                        <div class="modal-body">
                            <p>Do you want ot delete this record?</p>
                            <input type="hidden" name="get_staff_id" id="get_staff_id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn_cancel" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger btn_delete" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal End-->
            <div class="container">
                <div class="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Staffs List</h4>
                                        <div id="sucess_msg" style="margin-left: 30px;"></div>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#addRowModal">
                                            Add Staff
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
                                                        <span class="fw-light"> Student </span>
                                                    </h5>
                                                    <button type="button" class="close btn_cancel" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="#" method="POST" id="staff_form" enctype="multipart/form-data">
                                                        <input type="hidden" id="staff_no" name="staff_no">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="email2">Staff Name</label>
                                                                        <input type="text" class="form-control" id="staff_name" name="staff_name" placeholder="Staff Name" />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email2">Staff Email</label>
                                                                        <input type="text" class="form-control" id="staff_email" name="staff_email" placeholder="Staff Email" />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email2">Password</label>
                                                                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="email2">Staff Department</label>
                                                                        <?php
                                                                        $sql = "SELECT * FROM tbl_department";
                                                                        $result = $conn->query($sql);
                                                                        echo '<select class="form-select form-control" id="staff_dept" name="staff_dept">';
                                                                        echo '<option>Select</option>';
                                                                        while ($row = $result->fetch_assoc()) {
                                                                            //echo "staff_name: " . $row['staff_name'] . "<br>";
                                                                            $dept_no = $row['department_no'];
                                                                            $dept_name = $row['department_name'];

                                                                            echo "<option value='$dept_no'>$dept_name</option>";
                                                                        }
                                                                        $conn->close();
                                                                        echo '</Select>';
                                                                        ?>
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email2">Staff ID</label>
                                                                        <input type="text" class="form-control" id="staff_id" name="staff_id" placeholder="Staff ID" />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="defaultSelect">Gender</label>
                                                                        <select class="form-select form-control" id="gender" name="gender">
                                                                            <option>Select</option>
                                                                            <option>Male</option>
                                                                            <option>Female</option>
                                                                        </select>
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email2">Date Of Birth</label>
                                                                        <input type="date" class="form-control" id="dob" name="dob" placeholder="DOB" />
                                                                        <span class="error" style="color:red;"></span>
                                                                        <div id="dob_message"></div>
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
                                    <div class="table-responsive refresh_staffs_table" id="refresh_staffs_table">
                                        <?php include('staffs_list.php'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('function/footer.php'); ?>

            <script>
                $(document).ready(function() {
                    //Staff form add and update details here
                    $("form#staff_form").submit(function(e) {
                        e.preventDefault();
                        //var formData = new FormData(this);
                        var data = $('#staff_form').serialize();
                        var name = $('#staff_name').val();
                        var email = $('#staff_email').val();
                        var dept = $('#staff_dept').val();
                        var gen = $('#gender').val();
                        var staff_id = $('#staff_id').val();
                        //var dob = $('#dob').val();
                        //var staff_imag = $('#staff_img').val();
                        //var user_name = $('#user_name').val();
                        var pwd = $('#pwd').val();
                        //console.log(formData);

                        const dob = new Date($('#dob').val());
                        const today = new Date();
                        const age = today.getFullYear() - dob.getFullYear();
                        const monthDiff = today.getMonth() - dob.getMonth();

                        // Check if the birthday has occurred this year
                        // if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) 
                        // {
                        //     age--;
                        // }        

                        if (name != '' && email != '' && dept != '' && gen != '' && staff_id != '' && dob != '' && pwd != '') {
                            if (age >= 18) {
                                $('.error').empty();
                                //$('#dob_message').text('You are eligible.').css('color', 'green');
                                // Here, you can submit the form or do other actions

                                $.ajax({
                                    type: 'POST',
                                    url: 'staff_add.php',
                                    data: data,
                                    dataType: 'json',
                                    cache: false,
                                    success: function(response) {
                                        ///console.log(response);
                                        if (response == 'success') {

                                            $('#sucess_msg').empty();

                                            $('#sucess_msg').html("<div id='message'></div>");

                                            $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>Staff Details Added Successfully</h4>")

                                            $("#message").show();

                                            setTimeout(function() {
                                                $("#message").hide();
                                            }, 2500)

                                            $('#staff_name').val('');
                                            $('#staff_email').val('');
                                            $('#staff_dept').val('');
                                            $('#gender').val('');
                                            $('#staff_id').val('');
                                            $('#dob').val('');
                                            //$('#user_name').val('');
                                            $('#pwd').val('');
                                            $('#addRowModal').modal('hide');

                                            var loadUrl = "Staffs_list.php";

                                            $(".refresh_staffs_table").load(loadUrl);

                                            setTimeout(function() {
                                                location.reload();
                                            }, 3000);
                                        } else if (response == 'updated') {
                                            var loadUrl = "staffs_list.php";

                                            $(".refresh_staffs_table").load(loadUrl);

                                            $('#sucess_msg').empty();

                                            $('#sucess_msg').html("<div id='message'></div>");

                                            $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>Staff Details Updated Successfully</h4>")

                                            $("#message").show();

                                            setTimeout(function() {
                                                $("#message").hide();
                                            }, 2500)

                                            $('#staff_no').val('');
                                            $('#staff_name').val('');
                                            $('#staff_email').val('');
                                            $('#staff_dept').val('');
                                            $('#gender').val('');
                                            $('#staff_id').val('');
                                            $('#dob').val('');
                                            //$('#user_name').val('');
                                            $('#pwd').val('');
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
                                $('#dob_message').text('You must be at least 18 years old.').css('color', 'red');
                            }
                        } else {
                            $('.error').text('This field is required');
                        }
                    });
                });

                //Staff form get values here
                $(document).on('click', '.btn_edit', function(e) {
                    e.preventDefault();
                    var get_id = $(this).attr('value');
                    //console.log(get_id);
                    if (get_id != '') {
                        $.ajax({
                            type: 'POST',
                            url: 'staff_get_details.php',
                            data: "staff_id=" + get_id,
                            dataType: 'json',
                            cache: false,
                            success: function(result) {
                                //console.log(response);
                                $('#addRowModal').modal('show');
                                $('#staff_no').val(result.staff_no);
                                $('#staff_name').val(result.staff_name);
                                $('#staff_email').val(result.staff_email);
                                $('#staff_dept').val(result.staff_department);
                                $('#gender').val(result.staff_gender);
                                $('#staff_id').val(result.staff_ID);
                                $('#dob').val(result.staff_dob);
                                //$('#user_name').val(result.staff_username);
                            }
                        });
                    }
                });

                $(document).on('click', '.btn_cancel', function(e) {
                    e.preventDefault();
                    $('#myModal').modal('hide');
                    $('#addRowModal').modal('hide');
                    $('#staff_no').val('');
                    $('#staff_name').val('');
                    $('#staff_email').val('');
                    $('#staff_dept').val('');
                    $('#gender').val('');
                    $('#staff_id').val('');
                    $('#dob').val('');
                    //$('#user_name').val('');
                    $('#pwd').val('');
                });

                $(document).on('click', '.btn_del', function(e) {
                    e.preventDefault();
                    var staff_id = $(this).attr('value');
                    //console.log(staff_id);
                    $('#get_staff_id').val(staff_id);
                    $('#myModal').modal('show');
                });

                $(document).on('click', '.btn_delete', function(e) {
                    e.preventDefault();
                    var staff_no = $('#get_staff_id').val();
                    console.log(staff_no);
                    if (staff_no != '') {
                        $.ajax({
                            type: 'POST',
                            url: 'delete_data.php',
                            data: "Staff_id=" + staff_no,
                            dataType: 'json',
                            success: function(result) {
                                if (result == 'deleted') {
                                    var loadUrl = "staffs_list.php";

                                    $(".refresh_staffs_table").load(loadUrl);

                                    $('#sucess_msg').html("<div id='message'></div>");

                                    $('#message').html("<h4 style='color:block; font-weight:bold;text-align:center;'>Staff Details Deleted Successfully</h4>")

                                    $("#message").show();

                                    setTimeout(function() {
                                        $("#message").hide();
                                    }, 2500)

                                    $('#get_staff_id').val('');
                                    $('#myModal').modal('hide');
                                }
                            }
                        });
                    }
                });
            </script>