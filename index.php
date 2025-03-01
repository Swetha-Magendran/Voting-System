<?php 
	include('function/header.php'); 
	include('function/db_connect.php');
?>

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

	<!-- Home -->
	<div id="home" class="hero-area">
		<!-- Backgound Image -->
		<div class="bg-image bg-parallax overlay" style="background-image:url(./img/home-background.jpg)"></div>
		<!-- /Backgound Image -->
		<div class="home-wrapper">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h1 class="white-text">Participate in Elections</h1>
						<p class="lead white-text">It allows students and faculty to participate in elections, such as student council elections or faculty votes, in a secure and efficient manner.</p>
						<!-- <a class="main-button icon-button" href="#">Get Started!</a> -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /Home -->

	<!-- Courses -->
	<div id="courses" class="section">
		<div class="container">
			<div class="row">
				<div class="section-header text-center">
					<h2>Upcoming Election</h2>
					<!-- <p class="lead">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p> -->
				</div>
			</div>
			<div id="courses-wrapper">
				<div class="row">
				<?php                                    
					// Current date and time
					$currentDate = new DateTime();
					$currentDate->setTime(0, 0);  // Set current time to midnight
					$sql1 = "SELECT * FROM tbl_position";
					$result1 = $conn->query($sql1);
					// if($result1->num_rows > 0)
					// {
						while ($get = $result1->fetch_assoc()) 
						{
							$pos_no = $get['position_no'];
							$pos_name = $get['position_name'];
							$ele_date = date('d-M-y', strtotime($get['election_date']));
							$nomi_date = date('d-M-y', strtotime($get['nomination_date']));
							$inputDate = strtotime($nomi_date);   

							// Date to compare (example)
							$dateToCheck = new DateTime($nomi_date);
							$dateToCheck->setTime(0, 0);  // Set the date to midnight

							// // Compare the dates
							if ($dateToCheck < $currentDate) 
							{
								//echo "The date is in the past.";
								//echo "<option value='$pos_no'>$pos_name - Past</option>";
							} 
							elseif ($dateToCheck > $currentDate) 
							{
								//echo "The date is in the future.";
								?>
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="course">
									<a href="#" class="course-img">
										<!-- <img src="./img/course01.jpg" alt=""> -->
										<i class="course-link-icon fa fa-link"></i>
									</a>
									<a class="course-title" href="#"><?php echo $pos_name;?></a>
									<div class="course-details">
										<span class="course-price course-free">Nomination <br> <?php echo $nomi_date;?></span>
										<span class="course-category">Election <br> <?php echo $ele_date;?></span>
									</div>
								</div>
							</div>
								<?php
							} 
							else 
							{
								//echo "The date is today (present).";
								?>
							<div class="col-md-3 col-sm-6 col-xs-6">
								<div class="course">
									<a href="#" class="course-img">
										<!-- <img src="./img/course01.jpg" alt=""> -->
										<i class="course-link-icon fa fa-link"></i>
									</a>
									<a class="course-title" href="#"><?php echo $pos_name;?></a>
									<div class="course-details">
										<span class="course-price course-free">Nomination <br> <?php echo $nomi_date;?></span>
										<span class="course-category">Election <br> <?php echo $ele_date;?></span>
									</div>
								</div>
							</div>
								<?php
							}
							//echo "<option value='$pos_no'>$pos_name</option>";
						}
					// }
					// else
					// {
					// 	echo "No more upcoming event";
					// }
				?>
					
				</div>
			</div>
		</div>
	</div>
	<!-- /Courses -->

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