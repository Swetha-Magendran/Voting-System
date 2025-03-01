<?php 
    include('function/header.php');
    include('function/db_connect.php');
?>
<style>
	  .hero-area {
        padding-bottom: 15px !important;
    }
</style>
	<body>

		<!-- Header -->
		<?php include('function/top_menu.php');?>
		<!-- /Header -->

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<!-- <ul class="hero-area-tree">
							<li><a href="index.html">Home</a></li>
							<li>Contact</li>
						</ul> -->
						<h1 class="white-text">Election Result</h1>

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
                    
                    <div class="contact-form">
                        <div class="col-md-1"></div>
                        <div class="col-md-9">
							<!-- <div class="section-header">
								<h2>Congratulations!</h2>
							</div> -->
							<!-- category widget -->
							<div class="widget category-widget">
								<?php
									// Get the current date and set time to midnight
									$currentDate = new DateTime();
									$currentDate->setTime(0, 0);  // Set current time to midnight
									$formattedCurrentDate = $currentDate->format('Y-m-d'); // Format current date as YYYY-MM-DD

										$sql1 = "SELECT * FROM tbl_position WHERE announce_status = 1";
										$result1 = $conn->query($sql1); $row = 1;
										if($result1->num_rows > 0)
										{
											while ($get = $result1->fetch_assoc()) 
											{
												$pos_no = $get['position_no'];

												// Fetch the result_date from the database
												$result_date = new DateTime($get['result_date']);  // Convert result_date to DateTime object

												// Calculate the date range: result_date to 2 days after result_date
												$dateRangeEnd = clone $result_date;  // Clone the result_date to avoid modifying the original object
												$dateRangeEnd->modify('+2 days'); // Add 2 days to the result_date

												// Check if the current date is between the result_date and the end of the range
												if ($currentDate >= $result_date && $currentDate <= $dateRangeEnd) 
												{
													$query = "SELECT t1.*,t3.position_name, COUNT(t1.candidate_no) AS max_vote, t4.student_name, t4.student_gender, t4.election_result
														FROM tbl_voter_details AS t1 JOIN tbl_candidate AS t2 ON t2.candidate_no = t1.candidate_no 
														JOIN tbl_position AS t3 ON t3.position_no = t2.position_no 
														JOIN tbl_students AS t4 ON t4.student_no = t2.student_no 
														WHERE t2.position_no = '$pos_no' GROUP BY t1.candidate_no";
													$result = $conn->query($query);
													while ($row = mysqli_fetch_array($result)) 
													{
														$candidate_name = $row['student_name'];
														$candidate_pos= $row['position_name'];
														$gen = $row['student_gender'];
														$ele_res = $row['election_result'];											
														if($gen == 'Male')
														{
															$gender = 'Mr';
														}
														else
														{
															$gender = 'Miss';
														}
														if($ele_res == 1)
														{
															?>
															<!-- row -->
															<div class="row">
																<div class="section-header text-center">
																	<h2>Congratulations!</h2>
																	<p class="lead">To <?php echo $gender;?> <span style="color: maroon;"><?php echo $candidate_name;?></span> for being elected as the <span style="color: maroon;"><?php echo $candidate_pos;?></span>.</p>
																</div>
															</div>
															<!-- /row -->												
															
															<?php
														}
													}
												} 
												$row++;
											}
										}
									?>
							</div>
							<!-- /category widget -->
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->

	
		<!-- preloader -->
		<div id='preloader'><div class='preloader'></div></div>
		<!-- /preloader -->


		<!-- jQuery Plugins -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/main.js"></script>

	</body>
</html>
