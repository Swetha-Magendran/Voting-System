<style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
<table id="basic-datatables" class="display table table-striped table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <!-- <th>Department</th> -->
            <th>Candidate ID</th>
            <th>Gender</th>
            <th>Position</th>
            <th>Election Date</th>
            <th>Verify</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            include('function/db_connect.php');
            
            $sql = "SELECT t1.candidate_no,t1.status,t2.*,t3.department_name,t4.position_name,t4.election_date FROM tbl_candidate AS t1 JOIN tbl_students AS t2 ON t1.student_no=t2.student_no JOIN tbl_department AS t3 ON t3.department_no=t2.student_department JOIN tbl_position AS t4 ON t4.position_no=t1.position_no";

            $result = $conn->query($sql);

            if($result->num_rows >0)
            {
                while ($row = $result->fetch_assoc()) 
                {
                    //echo "staff_name: " . $row['staff_name'] . "<br>";
                    $cno = $row['candidate_no'];
                    $name = $row['student_name'];
                    $dept = $row['department_name'];
                    $gen = $row['student_gender'];
                    $cid = $row['student_ID'];
                    $pos = $row['position_name'];
                    $sta = $row['status'];
                    $date = date('d-M-y',strtotime($row['election_date']));
                    ?>                    
                    <tr>
                        <td><?php  echo $name; ?></td>
                        <!-- <td><?php  //echo $dept; ?></td> -->
                        <td><?php  echo $cid; ?></td>
                        <td><?php  echo $gen; ?></td>
                        <td><?php  echo $pos; ?></td>
                        <td><?php  echo $date; ?></td>
                        <td>
                          <label>
                              <input type="radio" class="btn_verify" get_cno="<?php echo $cno; ?>" name="status_<?php echo $cno; ?>" value="0" <?php echo ($sta == 0) ? 'checked' : ''; ?>>
                              Pending
                          </label>
                          <label>
                              <input type="radio" class="btn_verify" get_cno="<?php echo $cno; ?>" name="status_<?php echo $cno; ?>" value="1" <?php echo ($sta == 1) ? 'checked' : ''; ?>>
                              Approve
                          </label>
                          <label>
                              <input type="radio" class="btn_verify" get_cno="<?php echo $cno; ?>" name="status_<?php echo $cno; ?>" value="2" <?php echo ($sta == 2) ? 'checked' : ''; ?>>
                              Reject
                          </label>
                        </td>
                        <td>
                            <div class="form-button-action">
                              <button type="button" data-bs-toggle="tooltip" title=""
                                class="btn btn-link btn-primary btn-lg btn_edit" value="<?php  echo $cno; ?>" 
                                    data-original-title="Edit Task">
                                <i class="fa fa-edit"></i>
                              </button>
                              <button type="button" data-bs-toggle="tooltip" value="<?php  echo $cno; ?>"
                                class="btn btn-link btn-danger btn_del"   data-original-title="Remove">
                                <i class="fa fa-times"></i>
                              </button>
                            </div>
                        </td>
                    </tr>
                    <?php
                }
            }
        ?>
    </tbody>
</table>
