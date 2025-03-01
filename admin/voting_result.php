<?php include('function/header.php');
clearstatcache();
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
  top: 80%;
  right: 0%;
}
    
.firstSpan:hover .secondSpan {
  visibility: visible;
}
</style>
<body>
    <div class="wrapper">
        <?php include('function/left_menu.php'); ?>

        <div class="main-panel">
            <?php include('function/main_header.php'); ?>
            
            <!-- View Modal Start-->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Candidates List</h4>
                        </div>
                        <div class="modal-body">
                            <div id="candidates_list">

                            </div>
                            <div id="candidate_result">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default btn_cancel" data-dismiss="modal">Close</button>
                            <button type="button" style="display: none!important;" class="btn btn-danger btn_tie" value="" data-dismiss="modal">
                            <span class="firstSpan">Voting Tie<span class="secondSpan">Select Random Person</span></span>
                            </button>
                            <button type="button" style="display: none!important;" class="btn btn-success btn_result" value="" data-dismiss="modal">Announce Result</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- View Modal End-->
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
                                    <h4 class="card-title">Voting Result</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive refresh_department_table" id="refresh_department_table">
                                        <table id="basic-datatables" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>   
                                                    <th>S.No</th> 
                                                    <th>Voted Postion</th>
                                                    <!-- <th>Candidates Name</th> -->
                                                    <th>Election Date</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                include('function/db_connect.php');

                                                $sql = "SELECT * FROM `tbl_position`";

                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) 
                                                {
                                                    $voter_name = "";
                                                    while ($row = $result->fetch_assoc()) 
                                                    {
                                                        //echo "student_name: " . $row['student_name'] . "<br>";
                                                        $pos_no = $row['position_no'];
                                                        $pos_name = $row['position_name'];
                                                        $ele_date = $row['election_date'];
                                                        $sql1 = "SELECT t3.student_name,t3.student_no FROM tbl_candidate AS t1 
                                                        JOIN tbl_position AS t2 ON t2.position_no = t1.position_no 
                                                                JOIN tbl_students AS t3 ON t3.student_no = t1.student_no WHERE t1.position_no = '$pos_no'";
                                                        $result1 = $conn->query($sql1);
                                                ?>
                                                        <tr>
                                                            <td><?php echo $pos_no; ?></td>
                                                            <td><?php echo $pos_name; ?></td>
                                                            <td><?php echo date('d-M-Y', strtotime($ele_date)); ?></td>
                                                            <td>
                                                            <button class="btn btn-info btn_view" pos_val="<?php echo $pos_no; ?>">Info</button>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
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
                    $(document).on('click', '.btn_view', function(e)
                    {
                        var pos_no = $(this).attr('pos_val');
                        //$('#myModal').modal('show');
                        //console.log(pos_no);
                        if(pos_no != "")
                        {
                            $.ajax({
                                type: 'POST',
                                url: 'voting_count_details.php',
                                data: "pos_no=" + pos_no,
                                dataType: 'json',
                                success: function(result) {
                                    console.log(result);
                                    if(result.status == 1)
			                        {                
                                        if(result.count_status == 'Draw_match')
                                        {
                                            $('.btn_tie').show()
                                            $('.btn_result').hide();
                                            //$('.btn_revise').hide();
                                        }
                                        else if(result.count_status == 'winner')
                                        {
                                            $('.btn_tie').hide()
                                            $('.btn_result').show();
                                            //$('.btn_revise').show();
                                        }
                                        else
                                        {
                                            $('.btn_tie').hide()
                                            $('.btn_result').hide();
                                            //$('.btn_revise').hide();
                                        }
                                        $('#myModal').modal('show');
                                        $('.btn_tie').val(pos_no);
                                        $('.btn_result').val(pos_no);
                                        //$('.btn_revise').val(pos_no);
                                        $('#candidates_list').empty().html(result.html);
                                    }
                                }
                            });
                        }
                    });
                    $(document).on('click', '.btn_cancel', function(e) {
                        e.preventDefault();
                        $('#myModal').modal('hide');
                        $('.btn_result').val('');
                    });

                    $(document).on('click', '.btn_result', function(e)
                    {
                        var pos_no = $(this).attr('value');
                        //console.log(pos_no);
                        if(pos_no != '')
                        {
                            $.ajax({
                                type: 'POST',
                                url: 'election_result.php',
                                data: "pos_no=" + pos_no,
                                dataType: 'json',
                                success: function(response) {
                                    //console.log(response);
                                    if(response.status == 'updated')
			                        {
                                        $('#candidate_result').empty().html("<h4 style='color:green; font-weight:bold;text-align:center;'>Congratulations to Mr/Miss "+ response.candi_name +" for being elected as the "+ response.candi_pos +".</h4>")

                                        $("#candidate_result").show();

                                        // setTimeout(function() {
                                        //     $("#candidate_result").hide();
                                        // }, 2500)

                                        setTimeout(function() {
                                            location.reload();
                                        }, 3000);
                                    }
                                }
                            });
                        }
                    });

                    // $(document).on('click', '.btn_revise', function(e)
                    // {
                    //     var pos_no = $(this).attr('value');
                    //     //console.log(pos_no);
                    //     if(pos_no != '')
                    //     {
                    //         $.ajax({
                    //             type: 'POST',
                    //             url: 'election_revise.php',
                    //             data: "pos_no=" + pos_no,
                    //             dataType: 'json',
                    //             success: function(response) {
                    //                 //console.log(response);
                    //                 if(response.status == 'revised')
			        //                 {
                    //                     $('#candidate_result').empty().html("<h4 style='color:grey; font-weight:bold;text-align:center;'>This position result has been revised!</h4>")

                    //                     $("#candidate_result").show();

                    //                     // setTimeout(function() {
                    //                     //     $("#candidate_result").hide();
                    //                     // }, 2500)
                                        
                    //                     setTimeout(function() {
                    //                         location.reload();
                    //                     }, 3000);
                    //                 }
                    //             }
                    //         });
                    //     }
                    // });

                    $(document).on('click', '.btn_tie', function(e)
                    {
                        var pos_no = $(this).attr('value');
                        //console.log(pos_no);
                        if(pos_no != '')
                        {
                            $.ajax({
                                type: 'POST',
                                url: 'election_random_result.php',
                                data: "pos_no=" + pos_no,
                                dataType: 'json',
                                success: function(response) {
                                    //console.log(response);
                                    if(response.status == 'updated')
			                        {
                                        $('#candidate_result').empty().html("<h4 style='color:green; font-weight:bold;text-align:center;'>Congratulations to Mr/Miss "+ response.candi_name +" for being elected as the "+ response.candi_pos +".</h4>")

                                        $("#candidate_result").show();

                                        // setTimeout(function() {
                                        //     $("#candidate_result").hide();
                                        // }, 2500)

                                        setTimeout(function() {
                                            location.reload();
                                        }, 3000);
                                    }
                                }
                            });
                        }
                    });
                });
            </script>