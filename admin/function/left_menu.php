<?php
    //echo "<pre>";print_r($_SESSION["logged_adminID"]);
    if(!isset($_SESSION["logged_adminID"])) 
    {
      // if(empty($_SESSION['logged_adminID']))
      // {
        header("Location: login.php");
        exit;
      // }
    }
?>
<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <h3 style="color: #b9babf!important;"> Voting System</h3>

      <a href="index.php" class="logo">
        <!-- <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" /> -->
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary">
        <li class="nav-item active">
          <a  href="index.php" >
            <i class="fas fa-home"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-section">
          <span class="sidebar-mini-icon">
            <i class="fa fa-ellipsis-h"></i>
          </span>
          <h4 class="text-section">Components</h4>
        </li>
        <li class="nav-item">
          <a href="admin.php">
            <i class="fas fa-user-check"></i>
            <p>Admin</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="student.php">
            <i class="fas fa-users"></i>
            <p>Students</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="staff.php">
            <i class="fas icon-people menu-icon"></i>
            <p>Staffs</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="department.php">
            <i class="fab fa-codepen"></i>
            <p>Department</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="position.php">
            <i class="fas fa-file"></i>
            <p>Election Position</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="candidate.php">
            <i class="fab fa-superpowers"></i>
            <p>Candidates</p>
          </a>
        </li>
        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#tables">
            <i class="fas fa-clipboard-list"></i>
            <p>Voter Details</p>
            <span class="caret"></span>
          </a>
          <div class="collapse" id="tables">
            <ul class="nav nav-collapse">
              <li>
                <a href="voted_details.php">
                  <span class="sub-item">Voter list</span>
                </a>
              </li>
              <li>
                <a href="voting_result.php">
                  <span class="sub-item">Voting Result</span>
                </a>
              </li>
              <!-- <li>
                <a href="zimport.php">
                  <span class="sub-item">Import Excel</span>
                </a>
              </li> -->
            </ul>
          </div>
        </li>
      </ul>
    </div>
  </div>
</div>
<!-- End Sidebar -->