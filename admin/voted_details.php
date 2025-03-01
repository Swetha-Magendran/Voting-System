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
                            <input type="hidden" name="get_department_id" id="get_department_id">
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
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Voted List</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive refresh_department_table" id="refresh_department_table">
                                        <?php include('voted_list.php'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php include('function/footer.php'); ?>

            <script>
            $(document).ready(function()
            { 
                //Department  form add and update details here
                $("form#department_form").submit(function(e) {
                    e.preventDefault();
                    //var formData = new FormData(this);
                    var data = $('#department_form').serialize();
                    var name = $('#department_name').val();
                    
                    if (name != '') 
                    {
                        $('.error').empty();
                        $.ajax({
                            type: 'POST',
                            url: 'department_add.php',
                            data: data,
                            dataType: 'json',
                            cache: false,
                            success: function(response) {
                                console.log(response);
                                if (response == 'success') {

                                    $('#sucess_msg').empty();

                                    $('#sucess_msg').html("<div id='message'></div>");

                                    $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>Department  Details Added Successfully</h4>")

                                    $("#message").show();

                                    setTimeout(function() {
                                        $("#message").hide();
                                    }, 2500)

                                    $('#department_name').val('');

                                    var loadUrl = "department_list.php";

                                    $(".refresh_department_table").load(loadUrl);

                                    setTimeout(function() {
                                        location.reload();
                                    }, 3000);
                                } 
                                else if (response == 'updated') 
                                {
                                    var loadUrl = "department_list.php";

                                    $(".refresh_department_table").load(loadUrl);

                                    $('#sucess_msg').empty();

                                    $('#sucess_msg').html("<div id='message'></div>");

                                    $('#message').html("<h4 style='color:green; font-weight:bold;text-align:center;'>Department  Details Updated Successfully</h4>")

                                    $("#message").show();

                                    setTimeout(function() {
                                        $("#message").hide();
                                    }, 2500)

                                    $('#department_no').val('');
                                    $('#department_name').val('');

                                    setTimeout(function() {
                                        location.reload();
                                    }, 3000);
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

                //Department  form get values here
                $(document).on('click', '.btn_edit', function(e) {
                    e.preventDefault();
                    var get_id = $(this).attr('value');
                    //console.log(get_id);
                    if (get_id != '') {
                        $.ajax({
                            type: 'POST',
                            url: 'department_get_details.php',
                            data: "department_id=" + get_id,
                            dataType: 'json',
                            cache: false,
                            success: function(result) {
                                //console.log(response);
                                $('#department_no').val(result.department_no);
                                $('#department_name').val(result.department_name);
                            }
                        });
                    }
                });

                $(document).on('click', '.btn_cancel', function(e) {
                    e.preventDefault();
                    $('#myModal').modal('hide');
                    $('#department_no').val('');
                    $('#department_name').val('');
                });

                $(document).on('click', '.btn_del', function(e) {
                    e.preventDefault();
                    var department_id = $(this).attr('value');
                    //console.log(department_id);
                    $('#get_department_id').val(department_id);
                    $('#myModal').modal('show');
                });

                $(document).on('click', '.btn_delete', function(e) {
                    e.preventDefault();
                    var department_no = $('#get_department_id').val();
                    //console.log(department_no);
                    if (department_no != '') {
                        $.ajax({
                            type: 'POST',
                            url: 'delete_data.php',
                            data: "department_id=" + department_no,
                            dataType: 'json',
                            success: function(result) {
                                if (result == 'deleted') 
                                {
                                    var loadUrl = "department_list.php";

                                    $(".refresh_department_table").load(loadUrl);

                                    $('#sucess_msg').html("<div id='message'></div>");

                                    $('#message').html("<h4 style='color:block; font-weight:bold;text-align:center;'>Department  Details Deleted Successfully</h4>")

                                    $("#message").show();

                                    setTimeout(function() {
                                        $("#message").hide();
                                    }, 2500)

                                    $('#get_department_id').val('');
                                    $('#myModal').modal('hide');
                                }
                                else
                                {
                                    alert(result);
                                    setTimeout(function() {
                                        $("#message").hide();
                                    }, 2500)

                                    $('#get_department_id').val('');
                                    $('#myModal').modal('hide');
                                }
                            }
                        });
                    }
                });
            </script>