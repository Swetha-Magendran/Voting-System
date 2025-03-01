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
                            <input type="hidden" name="get_position_id" id="get_position_id">
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
                                        <h4 class="card-title">Position List</h4>
                                        <div id="sucess_msg" style="margin-left: 30px;"></div>
                                        <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#addRowModal">
                                            Add Position
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
                                                    <?php
                                                        // Get today's date in the format YYYY-MM-DD
                                                        $today = date('Y-m-d');
                                                        //$last_date = date('Y-m-d', strtotime('+1days'));
                                                    ?>
                                                    <form action="#" method="POST" id="position_form" enctype="multipart/form-data">
                                                        <input type="hidden" id="position_no" name="position_no">
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-6 col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="email2">Position Name</label>
                                                                        <input type="text" class="form-control" id="position_name" name="position_name" placeholder="Position Name" />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email2">Position Limit</label>
                                                                        <input type="number" class="form-control" id="position_limit" name="position_limit" placeholder="Position Limit" />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 col-lg-6">
                                                                    <div class="form-group">
                                                                        <label for="email2">Election Date</label>
                                                                        <input type="date" class="form-control" min="<?php echo $today; ?>" id="election_date" name="election_date" />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email2">Last Date of Nominations</label>
                                                                        <input type="date" class="form-control" min="<?php echo $today; ?>" id="nomination_date" name="nomination_date" />
                                                                        <span class="error" style="color:red;"></span>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email2">Election Result Date</label>
                                                                        <input type="date" class="form-control" min="<?php echo $today; ?>" id="election_result_date" name="election_result_date" />
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
                                    <div class="table-responsive refresh_position_table" id="refresh_position_table">
                                        <?php include('position_list.php'); ?>
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
                    $("form#position_form").submit(function(e) {
                        e.preventDefault();
                        //var formData = new FormData(this);
                        var data = $('#position_form').serialize();
                        var name = $('#position_name').val();
                        var limit = $('#position_limit').val();
                        var date = $('#election_date').val();
                        var nomi_date = $('#nomination_date').val();
                        var res_date = $('#election_result_date').val();

                        if (name != '' && limit != '' && date != '' && nomi_date != '' && res_date != '') {
                            $('.error').empty();
                            $.ajax({
                                type: 'POST',
                                url: 'position_add.php',
                                data: data,
                                dataType: 'json',
                                cache: false,
                                success: function(response) {
                                    //console.log(response);
                                    if (response == 'success') {

                                        $('#sucess_msg').empty();

                                        $('#sucess_msg').html("<div id='message'></div>");

                                        $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>Position  Details Added Successfully</h4>")

                                        $("#message").show();

                                        setTimeout(function() {
                                            $("#message").hide();
                                        }, 2500)

                                        $('#position_name').val('');
                                        $('#position_limit').val('');
                                        $('#election_date').val('');
                                        $('#nomination_date').val('');
                                        $('#addRowModal').modal('hide');

                                        var loadUrl = "position_list.php";

                                        $(".refresh_position_table").load(loadUrl);
                                        setTimeout(function() {
                                            location.reload();
                                        }, 3000);
                                    } else if (response == 'updated') {
                                        var loadUrl = "position_list.php";

                                        $(".refresh_position_table").load(loadUrl);

                                        $('#sucess_msg').empty();

                                        $('#sucess_msg').html("<div id='message'></div>");

                                        $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>Position  Details Updated Successfully</h4>")

                                        $("#message").show();

                                        setTimeout(function() {
                                            $("#message").hide();
                                        }, 2500)

                                        $('#position_no').val('');
                                        $('#position_name').val('');
                                        $('#position_limit').val('');
                                        $('#election_date').val('');
                                        $('#nomination_date').val('');
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

                //Position  form get values here
                $(document).on('click', '.btn_edit', function(e) {
                    e.preventDefault();
                    var get_id = $(this).attr('value');
                    //console.log(get_id);
                    if (get_id != '') {
                        $.ajax({
                            type: 'POST',
                            url: 'position_get_details.php',
                            data: "position_id=" + get_id,
                            dataType: 'json',
                            cache: false,
                            success: function(result) {
                                //console.log(response);
                                $('#addRowModal').modal('show');
                                $('#position_no').val(result.position_no);
                                $('#position_name').val(result.position_name);
                                $('#position_limit').val(result.position_limit);
                                $('#election_date').val(result.election_date);
                                $('#nomination_date').val(result.nomination_date);
                                $('#election_result_date').val(result.result_date);
                            }
                        });
                    }
                });

                $(document).on('click', '.btn_cancel', function(e) {
                    e.preventDefault();
                    $('#myModal').modal('hide');
                    $('#addRowModal').modal('hide');
                    $('#position_no').val('');
                    $('#position_name').val('');
                    $('#position_limit').val('');
                    $('#election_date').val('');
                    $('#nomination_date').val('');
                });

                $(document).on('click', '.btn_del', function(e) {
                    e.preventDefault();
                    var position_id = $(this).attr('value');
                    //console.log(position_id);
                    $('#get_position_id').val(position_id);
                    $('#myModal').modal('show');
                });

                $(document).on('click', '.btn_delete', function(e) {
                    e.preventDefault();
                    var position_no = $('#get_position_id').val();
                    //console.log(position_no);
                    if (position_no != '') {
                        $.ajax({
                            type: 'POST',
                            url: 'delete_data.php',
                            data: "position_id=" + position_no,
                            dataType: 'json',
                            success: function(result) {
                                console.log(result);
                                if (result == 'deleted') {
                                    var loadUrl = "position_list.php";

                                    $(".refresh_position_table").load(loadUrl);

                                    $('#sucess_msg').html("<div id='message'></div>");

                                    $('#message').html("<h4 style='color:block; font-weight:bold;text-align:center;'>Position  Details Deleted Successfully</h4>")

                                    $("#message").show();

                                    setTimeout(function() {
                                        $("#message").hide();
                                    }, 2500)

                                    $('#get_position_id').val('');
                                    $('#myModal').modal('hide');
                                } else {
                                    alert(result);
                                    setTimeout(function() {
                                        $("#message").hide();
                                    }, 2500)

                                    $('#get_position_id').val('');
                                    $('#myModal').modal('hide');
                                }
                            }
                        });
                    }
                });
            </script>