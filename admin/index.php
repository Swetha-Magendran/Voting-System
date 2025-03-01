<?php 
  include('function/header.php');
  include('function/db_connect.php');
  ?>

<body>
  <div class="wrapper">
    
    <?php include('function/left_menu.php');?>

    <div class="main-panel">
      <?php include('function/main_header.php');?>

      <div class="container">
        <div class="page-inner">
          <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
            <div>
              <h3 class="fw-bold mb-3">Report Summary</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div class="icon-big text-center icon-primary bubble-shadow-small">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Total Students</p>
                        <?php 
                          $sql1 = "SELECT COUNT(student_no) AS student_count FROM tbl_students";

                          $response1 = array();
                  
                          if ($result1 = $conn->query($sql1)) 
                          {
                            $result1->num_rows;
                
                            while ($fetch1 = mysqli_fetch_array($result1)) 
                            {
                              $response1 =$fetch1['student_count'];	
                              ?>                                
                                <h4 class="card-title"><?php echo $response1;?></h4>
                              <?php
                            }
                          }
                        ?>
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div class="icon-big text-center icon-info bubble-shadow-small">
                        <i class="fas fa-user-check"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Total Staff</p>
                        <?php 
                          $sql2 = "SELECT COUNT(staff_no) AS staff_count FROM tbl_staff";

                          $response2 = array();
                  
                          if ($result2 = $conn->query($sql2)) 
                          {
                            $result2->num_rows;
                
                            while ($fetch2 = mysqli_fetch_array($result2)) 
                            {
                              $response2 =$fetch2['staff_count'];	
                              ?>                                
                                <h4 class="card-title"><?php echo $response2;?></h4>
                              <?php
                            }
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div class="icon-big text-center icon-success bubble-shadow-small">
                        <i class="fas fa-users"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Total Candidate</p>
                        <?php 
                          $sql3 = "SELECT COUNT(candidate_no) AS Cand_count FROM tbl_candidate WHERE status = 1";

                          $response3 = array();
                  
                          if ($result3 = $conn->query($sql3)) 
                          {
                            $result3->num_rows;
                
                            while ($fetch3 = mysqli_fetch_array($result3)) 
                            {
                              $response3 =$fetch3['Cand_count'];	
                              ?>                                
                                <h4 class="card-title"><?php echo $response3;?></h4>
                              <?php
                            }
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-3">
              <div class="card card-stats card-round">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col-icon">
                      <div class="icon-big text-center icon-secondary bubble-shadow-small">
                        <i class="far fa-check-circle"></i>
                      </div>
                    </div>
                    <div class="col col-stats ms-3 ms-sm-0">
                      <div class="numbers">
                        <p class="card-category">Total Voter</p>
                        <?php 
                          $sql4 = "SELECT COUNT(voter_no) AS voter_count FROM tbl_voter_details;";

                          $response4 = array();
                  
                          if ($result4 = $conn->query($sql4)) 
                          {
                            $result4->num_rows;
                
                            while ($fetch4 = mysqli_fetch_array($result4)) 
                            {
                              $response4 =$fetch4['voter_count'];	
                              ?>                                
                                <h4 class="card-title"><?php echo $response4;?></h4>
                              <?php
                            }
                          }
                        ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>

     <?php include('function/footer.php');?>