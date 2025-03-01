<?php include('function/header.php'); ?>

<body>

    <!-- Header -->
    <header id="header" class="transparent-nav">
        <div class="container">

            <div class="navbar-header">
                <!-- Logo -->
                <div class="navbar-brand">
                    <h3 class="white-text">Voting Management System</h3>
                </div>
                <!-- /Logo -->

                <!-- Mobile toggle -->
                <button class="navbar-toggle">
                    <span></span>
                </button>
                <!-- /Mobile toggle -->
            </div>

            <!-- Navigation -->
            <?php
            if (!isset($_SESSION['logged_user']) || empty($_SESSION['logged_user'])) {
            ?>
                <nav id="nav">
                    <ul class="main-menu nav navbar-nav navbar-right">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="admin/login.php">Admin</a></li>
                    </ul>
                </nav>
            <?php
            } else {
            ?>
                <nav id="nav">
                    <ul class="main-menu nav navbar-nav navbar-right">
                        <li><a href="index.php">Home</a></li>
                        <?php
                        if ($_SESSION['logged_role'] = 'student') {
                        ?>
                            <li><a href="student.php" class="active">Hi,<?php echo $_SESSION['logged_user']; ?></a></li>
                        <?php
                        } else {
                        ?>
                            <li><a href="staff.php" class="active">Hi,<?php echo $_SESSION['logged_user']; ?></a></li>
                        <?php
                        }
                        ?>
                        <li><a href="logout.php?logged_id='<?php echo $_SESSION['logged_userID']; ?>'">Logout</a></li>
                    </ul>
                </nav>
            <?php
            }
            ?>
            <!-- /Navigation -->

        </div>
    </header>
    <!-- /Header -->

    <!-- Hero-area -->
    <div class="hero-area section">

        <!-- Backgound Image -->
        <div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
        <!-- /Backgound Image -->

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <ul class="hero-area-tree">
                        <li><a href="index.php">Home</a></li>
                        <li>Login</li>
                    </ul>
                    <h1 class="white-text">Get In Touch</h1>

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
                <div class="col-md-4"></div>
                <!-- contact form -->
                <div class="col-md-4">
                    <div class="contact-form">
                        <h4>Login Form</h4>
                        <form id="login_form">
                            <input class="input" name="user_id" type="text" id="user_id" placeholder="User ID">
                            <span class="error" style="color:red;"></span>
                            <input class="input" name="user_pass" type="password" id="user_pass" placeholder="Password">
                            <span class="error" style="color:red;"></span>
                            <button class="main-button icon-button pull-right" id="btn_submit">Login</button>
                        </form>
                    </div>
                </div>
                <!-- /contact form -->
                <div class="col-md-4"></div>
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
        //$('#btn_submit').on('click', function(){             
        $("form#login_form").submit(function(e) {
            e.preventDefault();
            //var formData = new FormData(this);
            var data = $('#login_form').serialize();
            var name = $('#user_id').val();
            var pwd = $('#user_pass').val();
            //console.log(data);
            if (name !== '' && pwd !== '') {
                $('.error').empty();
                $.ajax({
                    type: 'POST',
                    url: 'user_verification.php',
                    data: data,
                    dataType: 'json',
                    cache: false,
                    success: function(response) {
                        console.log(response);
                        if (response == 'success_student') {

                            $('#user_id').val('');
                            $('#user_id').val('');

                            location.href = "student.php";
                        } else if (response == 'success_staff') {
                            $('#user_id').val('');
                            $('#user_id').val('');

                            location.href = "staff.php";
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