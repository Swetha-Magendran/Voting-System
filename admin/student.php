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
                            <input type="hidden" name="get_student_id" id="get_student_id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn_cancel" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger btn_delete" data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Delete Modal End-->
            <div class="container">
                <div class="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <?php include('students_import.php'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Students List</h4>
                                        <div id="sucess_msg" style="margin-left: 30px;"></div>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#addRowModal">
                                            Add Student
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
                                                    <form action="#" method="POST" id="student_form" enctype="multipart/form-data">
                                                        <input type="hidden" id="stu_sno" name="stu_sno">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="email2">Student Name</label>
                                                                        <input type="text" class="form-control" id="stu_name" name="stu_name" placeholder="Student Name" />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email2">Student Email</label>
                                                                        <input type="text" class="form-control" id="stu_email" name="stu_email" placeholder="Student Email" />
                                                                        <span class="error" style="color:red;"></span>
                                                                        <span class="error_email" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email2">Password</label>
                                                                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="email2">Student Department</label>
                                                                        <?php
                                                                        $sql = "SELECT * FROM tbl_department";
                                                                        $result = $conn->query($sql);
                                                                        echo '<select class="form-select form-control" id="stu_dept" name="stu_dept">';
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
                                                                        <!-- </select> -->
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email2">Student ID</label>
                                                                        <input type="text" class="form-control" id="stu_id" name="stu_id" placeholder="Student ID" />
                                                                        <span class="error" style="color:red;"></span>
                                                                        <span class="error_student_id" style="color:red;"></span>
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
                                                            <button class="btn btn-danger btn_cancel" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive refresh_students_table" id="refresh_students_table">
                                        <?php include('students_list.php'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('function/footer.php'); ?>

            <script>
                //Position  form add and update details here
                $(document).ready(function() {
                    //Student form add and update details here
                    $("form#student_form").submit(function(e) {
                        e.preventDefault();

                        var data = $('#student_form').serialize();
                        var name = $('#stu_name').val();
                        var email = $('#stu_email').val();
                        var dept = $('#stu_dept').val();
                        var gen = $('#gender').val();
                        var stu_id = $('#stu_id').val();
                        //var user_name = $('#user_name').val();
                        var pwd = $('#pwd').val();
                        //console.log(formData);

                        const dob = new Date($('#dob').val());
                        const today = new Date();
                        const age = today.getFullYear() - dob.getFullYear();
                        const monthDiff = today.getMonth() - dob.getMonth();

                        if (name != '' && email != '' && dept != '' && gen != '' && stu_id != '' && dob != '' && pwd != '') {
                            if (age >= 18) {
                                $('.error').empty();
                                // Here, you can submit the form or do other actions

                                $.ajax({
                                    type: 'POST',
                                    url: 'student_add.php',
                                    data: data,
                                    dataType: 'json',
                                    success: function(response) {
                                        //console.log(response);
                                        if (response == 'success') {
                                            $('#message').empty();

                                            $('#sucess_msg').html("<div id='message'></div>");

                                            $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>Student Details Added Successfully</h4>")

                                            $("#message").show();

                                            setTimeout(function() {
                                                $("#message").hide();
                                            }, 2500)

                                            $('#stu_name').val('');
                                            $('#stu_email').val('');
                                            $('#stu_dept').val('');
                                            $('#gender').val('');
                                            $('#stu_id').val('');
                                            $('#dob').val('');
                                            $('#pwd').val('');

                                            $('#addRowModal').modal('hide');

                                            var loadUrl = "students_list.php";

                                            $(".refresh_students_table").load(loadUrl);

                                            setTimeout(function() {
                                                location.reload();
                                            }, 3000);
                                        } else if (response == 'updated') {
                                            var loadUrl = "students_list.php";

                                            $(".refresh_students_table").load(loadUrl);

                                            $('#message').empty();

                                            $('#sucess_msg').html("<div id='message'></div>");

                                            $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>Student Details Updated Successfully</h4>")

                                            $("#message").show();

                                            setTimeout(function() {
                                                $("#message").hide();
                                            }, 2500)

                                            $('#stu_sno').val('');
                                            $('#stu_name').val('');
                                            $('#stu_email').val('');
                                            $('#stu_dept').val('');
                                            $('#gender').val('');
                                            $('#stu_id').val('');
                                            $('#dob').val('');
                                            $('#pwd').val('');

                                            $('#addRowModal').modal('hide');

                                            setTimeout(function() {
                                                location.reload();
                                            }, 3000);
                                        } else {
                                            $('.error_student_id').text('This Student ID already exists.');
                                            $('.error_email').text('This Email Id already exists.');
                                            setTimeout(function() {
                                                $("#message").hide();
                                            }, 2500)
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

                //Student form get values here
                $(document).on('click', '.btn_edit', function(e) {
                    e.preventDefault();
                    var get_id = $(this).attr('value');
                    //console.log(get_id);
                    if (get_id != '') {
                        $.ajax({
                            type: 'POST',
                            url: 'student_get_details.php',
                            data: "student_id=" + get_id,
                            dataType: 'json',
                            success: function(result) {
                                //console.log(response);
                                $('#addRowModal').modal('show');
                                $('#stu_sno').val(result.student_no);
                                $('#stu_name').val(result.student_name);
                                $('#stu_email').val(result.student_email);
                                $('#stu_dept').val(result.student_department);
                                $('#gender').val(result.student_gender);
                                $('#stu_id').val(result.student_ID);
                                $('#dob').val(result.student_dob);
                                //$('#user_name').val(result.student_username);
                            }
                        });
                    }
                });

                $(document).on('click', '.btn_cancel', function(e) {
                    e.preventDefault();
                    $('#myModal').modal('hide');
                    $('#addRowModal').modal('hide');
                    $('#stu_sno').val('');
                    $('#stu_name').val('');
                    $('#stu_email').val('');
                    $('#stu_dept').val('');
                    $('#gender').val('');
                    $('#stu_id').val('');
                    $('#dob').val('');
                    //$('#user_name').val('');
                    $('#pwd').val('');
                });

                $(document).on('click', '.btn_del', function(e) {
                    e.preventDefault();
                    var student_id = $(this).attr('value');
                    //console.log(staff_id);
                    $('#get_student_id').val(student_id);
                    $('#myModal').modal('show');
                });

                $(document).on('click', '.btn_delete', function(e) {
                    e.preventDefault();
                    var student_no = $('#get_student_id').val();
                    //console.log(student_no);
                    if (student_no != '') {
                        $.ajax({
                            type: 'POST',
                            url: 'delete_data.php',
                            data: "Student_id=" + student_no,
                            dataType: 'json',
                            success: function(result) {
                                if (result == 'deleted') {
                                    var loadUrl = "students_list.php";

                                    $(".refresh_students_table").load(loadUrl);

                                    $('#sucess_msg').html("<div id='message'></div>");

                                    $('#message').html("<h4 style='color:block; font-weight:bold;text-align:center;'>Student Details Deleted Successfully</h4>")

                                    $("#message").show();

                                    setTimeout(function() {
                                        $("#message").hide();
                                    }, 2500)

                                    $('#get_student_id').val('');
                                    $('#myModal').modal('hide');
                                }
                            }
                        });
                    }
                });
            </script>