<table id="basic-datatables" class="display table table-striped table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Department</th>
            <th>Gender</th>
            <th>Staff ID</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            include('function/db_connect.php');
            
            $sql = "SELECT  t1.*,t2.department_name FROM tbl_staff AS t1 JOIN tbl_department As t2 On t1.staff_department = t2.department_no";

            $result = $conn->query($sql);

            if($result->num_rows >0)
            {
                while ($row = $result->fetch_assoc()) 
                {
                    //echo "staff_name: " . $row['staff_name'] . "<br>";
                    $sno = $row['staff_no'];
                    $name = $row['staff_name'];
                    $dept = $row['department_name'];
                    $gen = $row['staff_gender'];
                    $sid = $row['staff_ID'];
                    ?>                    
                    <tr>
                        <td><?php  echo $name; ?></td>
                        <td><?php  echo $dept; ?></td>
                        <td><?php  echo $gen; ?></td>
                        <td><?php  echo $sid; ?></td>
                        <td>
                            <div class="form-button-action">
                              <button type="button" data-bs-toggle="tooltip" title=""
                                class="btn btn-link btn-primary btn-lg btn_edit" value="<?php  echo $sno; ?>" 
                                    data-original-title="Edit Task">
                                <i class="fa fa-edit"></i>
                              </button>
                              <button type="button" data-bs-toggle="tooltip" value="<?php  echo $sno; ?>"
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