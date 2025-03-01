<?php 
	// Debugging: Check session variable
    if(!isset($_SESSION["logged_userID"])) 
    {
      // if(empty($_SESSION['logged_adminID']))
      // {
        header("Location: login.php");
        exit;
      // }
    }
	// if (isset($_SESSION['logged_userID'])) {
	// 	// echo 'Session is set, user ID: ' . $_SESSION['logged_userID']; // Debugging line
	// } else {
	// 	//echo 'Session is NOT set'; // Debugging line
	// 	// ob_start();
	// 	return header("Location: login.php");
	// 	// exit;
	// }
	?>	
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
            if(!isset($_SESSION['logged_user']) || empty($_SESSION['logged_user']))
            {
                ?>
        <nav id="nav">
            <ul class="main-menu nav navbar-nav navbar-right">
                <li><a href="index.php">Home</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="admin/login.php" target="_blank">Admin</a></li>
            </ul>
        </nav>
        <?php
            }
            else
            {
                ?>
        <nav id="nav">
            <ul class="main-menu nav navbar-nav navbar-right">
                <li><a href="index.php">Home</a></li>
                <?php
                    if($_SESSION['logged_role'] == 'student')
                    {
                        ?>
                <li><a href="student.php" class="active">Hi,<?php echo $_SESSION['logged_user'];?></a></li>
                        <?php
                    }
                    else
                    {
                        ?>
                <li><a href="staff.php" class="active">Hi,<?php echo $_SESSION['logged_user'];?></a></li>
                        <?php
                    }
                ?>
                <li><a href="logout.php?logged_id='<?php echo $_SESSION['logged_userID'];?>'">Logout</a></li>
            </ul>
        </nav>
        <?php
            }
        ?>
        <!-- /Navigation -->

    </div>
</header>