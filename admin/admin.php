<?php include('function/header.php');
clearstatcache();
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
                            <input type="hidden" name="get_admin_id" id="get_admin_id">
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
                                        <h4 class="card-title">Admin List</h4>
                                        <div id="sucess_msg" style="margin-left: 30px;"></div>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#addRowModal">
                                            Add Admin
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Modal -->
                                    <div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content" style="width: 170% !important;">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold"> Add</span>
                                                        <span class="fw-light"> Admin </span>
                                                    </h5>
                                                    <button type="button" class="close btn_cancel" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="#" method="POST" id="admin_form" enctype="multipart/form-data">
                                                        <input type="hidden" id="admin_no" name="admin_no">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="email2">Admin Name</label>
                                                                        <input type="text" class="form-control" id="admin_name" name="admin_name" placeholder="Admin Name" />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="email2">Admin ID</label>
                                                                        <input type="text" class="form-control" id="admin_ID" name="admin_ID" placeholder="Admin ID" />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-lg-4">
                                                                    <div class="form-group">
                                                                        <label for="email2">Admin Password</label>
                                                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" />
                                                                        <span class="error" style="color:red;"></span>
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
                                    <div class="table-responsive refresh_admin_table" id="refresh_admin_table">
                                        <?php include('admin_list.php'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('function/footer.php'); ?>

            <script>
                //Admin  form add and update details here
                $(document).ready(function() {
                    $("form#admin_form").submit(function(e) {
                        e.preventDefault();
                        //var formData = new FormData(this);
                        var data = $('#admin_form').serialize();
                        var name = $('#admin_name').val();
                        var aid = $('#admin_ID').val();
                        var pwd = $('#password').val();

                        if (name != '' && aid != '' && pwd != '') {
                            $('.error').empty();
                            $.ajax({
                                type: 'POST',
                                url: 'admin_add.php',
                                data: data,
                                dataType: 'json',
                                cache: false,
                                success: function(response) {
                                    //console.log(response);
                                    if (response == 'success') {

                                        $('#sucess_msg').empty();

                                        $('#sucess_msg').html("<div id='message'></div>");

                                        $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>Admin  Details Added Successfully</h4>")

                                        $("#message").show();

                                        setTimeout(function() {
                                            $("#message").hide();
                                        }, 2500)

                                        $('#admin_name').val('');
                                        $('#admin_ID').val('');
                                        $('#password').val('');

                                        $('#addRowModal').modal('hide');

                                        var loadUrl = "admin_list.php";

                                        $(".refresh_admin_table").load(loadUrl);
                                        // setTimeout(function() {
                                        //     location.reload();
                                        // }, 3000);
                                    } else if (response == 'updated') {
                                        var loadUrl = "admin_list.php";

                                        $(".refresh_admin_table").load(loadUrl);

                                        $('#sucess_msg').empty();

                                        $('#sucess_msg').html("<div id='message'></div>");

                                        $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>Admin  Details Updated Successfully</h4>")

                                        $("#message").show();

                                        setTimeout(function() {
                                            $("#message").hide();
                                        }, 3500)

                                        $('#admin_no').val('');
                                        $('#admin_name').val('');
                                        $('#admin_ID').val('');

                                        $('#addRowModal').modal('hide');

                                        // setTimeout(function() {
                                        //     location.reload();
                                        // }, 3000);
                                    } else {
                                        return false;
                                    }
                                }
                            });
                        } else {
                            $('.error').text('This field is required');
                        }
                    });
                });

                //Admin  form get values here
                $(document).on('click', '.btn_edit', function(e) {
                    e.preventDefault();
                    var get_id = $(this).attr('value');
                    //console.log(get_id);
                    if (get_id != '') {
                        $.ajax({
                            type: 'POST',
                            url: 'admin_get_details.php',
                            data: "admin_id=" + get_id,
                            dataType: 'json',
                            cache: false,
                            success: function(result) {
                                //console.log(response);
                                $('#addRowModal').modal('show');
                                $('#admin_no').val(result.admin_no);
                                $('#admin_name').val(result.admin_name);
                                $('#admin_ID').val(result.admin_ID);
                            }
                        });
                    }
                });

                $(document).on('click', '.btn_cancel', function(e) {
                    e.preventDefault();
                    $('#myModal').modal('hide');
                    $('#addRowModal').modal('hide');
                    $('#admin_no').val('');
                    $('#admin_name').val('');
                    $('#admin_ID').val('');
                    $('#password').val('');
                });

                $(document).on('click', '.btn_del', function(e) {
                    e.preventDefault();
                    var admin_id = $(this).attr('value');
                    //console.log(admin_id);
                    $('#get_admin_id').val(admin_id);
                    $('#myModal').modal('show');
                });

                $(document).on('click', '.btn_delete', function(e) {
                    e.preventDefault();
                    var admin_no = $('#get_admin_id').val();
                    //console.log(admin_no);
                    if (admin_no != '') {
                        $.ajax({
                            type: 'POST',
                            url: 'delete_data.php',
                            data: "admin_id=" + admin_no,
                            dataType: 'json',
                            success: function(result) {
                                if (result == 'deleted') {
                                    var loadUrl = "admin_list.php";

                                    $(".refresh_admin_table").load(loadUrl);

                                    $('#sucess_msg').html("<div id='message'></div>");

                                    $('#message').html("<h4 style='color:block; font-weight:bold;text-align:center;'>Admin  Details Deleted Successfully</h4>")

                                    $("#message").show();

                                    setTimeout(function() {
                                        $("#message").hide();
                                    }, 2500)

                                    $('#get_admin_id').val('');
                                    $('#myModal').modal('hide');
                                }
                            }
                        });
                    }
                });
            </script>