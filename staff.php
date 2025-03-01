<?php 
    include('function/header.php');
    include('function/db_connect.php'); 
?>
<style>
.p {
  text-align: left;
}
    
/* .firstSpan {
  color: rgb(119, 162, 241)
} */
    
.firstSpan .secondSpan {
  visibility: hidden;
  width: 250px;
  background-color: gray;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 5px 0;
  position: absolute;
  z-index: 1;
}
    
.firstSpan:hover .secondSpan {
  visibility: visible;
}
</style>
<body>

    <!-- Header -->
    <?php include('function/top_menu.php'); ?>
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
                            <li>Blog</li>
                        </ul>
                        <h1 class="white-text">Blog Page</h1> -->

                </div>
            </div>
        </div>

    </div>
    <!-- /Hero-area -->

    <!-- Why us -->
    <div id="why-us" class="section">

        <!-- container -->
        <div class="container">

            <!-- row -->
            <div class="row">
                <div class="section-header text-center">
                    <h2>Welcome to Election Process</h2>
                    <!-- <p class="lead">Libris vivendo eloquentiam ex ius, nec id splendide abhorreant.</p> -->
                </div>

                <!-- feature -->
                <div class="col-md-6">
                    <div class="feature">
                        <i class="feature-icon fa fa-check"></i>
                        <div class="feature-content">
                            <h4><a href="voting.php">Vote Here </a></h4>
                            <p>"Vote Here" is a phrase often used in voting systems, inviting users to participate by selecting their preferred option. </p>
                        </div>
                    </div>
                </div>
                <!-- /feature -->

                <!-- feature -->
                <!-- <div class="col-md-4">
                    <div class="feature">
                        <i class="feature-icon fa fa-users"></i>
                        <div class="feature-content">
                            <h4><a href="#">Verify Candidate</a></h4>
                            <p>Ceteros fuisset mei no, soleat epicurei adipiscing ne vis. Et his suas veniam nominati.</p>
                        </div>
                    </div>
                </div> -->
                <!-- /feature -->

                <!-- feature -->
                <?php
                    $sql1 = "SELECT * FROM tbl_position WHERE announce_status = 1 GROUP BY announce_status";
                    $result1 = $conn->query($sql1);
                    if($result1->num_rows > 0)
                    {
                        ?>                    
                <div class="col-md-6">
                    <div class="feature">
                        <i class="feature-icon fa fa-bullhorn"></i>
                        <div class="feature-content">
                            <h4><a href="election_result.php">Election Result</a></h4>
                            <p>Election results refer to the official outcome of a voting process, where the candidates' votes are counted and the winner is determined.</p>
                        </div>
                    </div>
                </div>
                        <?php
                    }
                    else
                    {
                        ?>
                        <div class="col-md-6">
                            <div class="feature">
                                <i class="feature-icon fa fa-bullhorn"></i>
                                <div class="feature-content">
                                    <!-- <div class="tooltip">Testing
                                        <span class="tooltiptext">Tooltip text</span>
                                    </div> -->
                                    <h4><a href="#"><span class="firstSpan">Election Result<span class="secondSpan">Result will announce soon...</span></span></a></h4>
                                    <p>Election results refer to the official outcome of a voting process, where the candidates' votes are counted and the winner is determined.</p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                <!-- /feature -->

            </div>
            <!-- /row -->

        </div>
        <!-- /container -->

    </div>
    <!-- /Why us -->

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