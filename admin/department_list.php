<table id="basic-datatables" class="display table table-striped table-hover">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Department Short Form</th>
            <th>Department Full Form</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            include('function/db_connect.php');
            
            $sql = "SELECT * FROM tbl_department";

            $result = $conn->query($sql);
            $i = 1;

            if($result->num_rows >0)
            {
                while ($row = $result->fetch_assoc()) 
                {
                    //echo "staff_name: " . $row['staff_name'] . "<br>";
                    $sno = $row['department_no'];
                    $name = $row['department_name'];
                    $full = $row['department_full_name'];
                    ?>                    
                    <tr>
                        <td><?php  echo $i; ?></td>
                        <td><?php  echo $name; ?></td>
                        <td><?php  echo $full; ?></td>
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
                    $i++;
                }
            }
        ?>
    </tbody>
</table>