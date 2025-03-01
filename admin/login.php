<?php include('function/header.php');
clearstatcache();
?>

<body>
    <div class="wrapper">
        

        <div class="main-panel">
          

            <div class="container">
                <div class="page-inner">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Admin Login</div>
                                </div>
                                <form action="#" method="POST" id="admin_verification">
                                    <div class="card-body">
                                        <div class="row">
                                            <span class="error" style="color:red;"></span>
                                            <div class="col-md-12 col-lg-12">
                                                <div class="form-group">
                                                    <label for="email2">Admin ID</label>
                                                    <input type="text" class="form-control" id="admin_ID" name="admin_ID" placeholder="Admin ID" />
                                                    <span class="error" style="color:red;"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email2">Password</label>
                                                    <input type="password" class="form-control" id="apwd" name="apwd" placeholder="Password" />
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
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>

            <?php include('function/footer.php'); ?>
            <script>
                $(document).ready(function()
                {       
                    //$('#btn_submit').on('click', function(){             
                    $("form#admin_verification").submit(function(e) {
                        e.preventDefault();
                        //var formData = new FormData(this);
                        var data = $('#admin_verification').serialize();
                        var name = $('#admin_ID').val();
                        var pwd = $('#apwd').val();
                        //console.log(data);
                        if (name !== '' && pwd !== '') 
                        {
                            $('.error').empty();
                            $.ajax({
                                type: 'POST',
                                url: 'admin_verification.php',
                                data: data,
                                dataType: 'json',
                                cache: false,
                                success: function(response) 
                                {
                                    //console.log(response);
                                    if (response == 'success') 
                                    {

                                        $('#admin_ID').val('');
                                        $('#apwd').val('');

                                        location.href = "index.php";
                                    } 
                                    else 
                                    {
                                        $('.error1').text('Your details is Invalid!');
                                    }
                                }
                            });
                        } else {
                            $('.error').text('This field is required');
                        }
                    });
                });
            </script>