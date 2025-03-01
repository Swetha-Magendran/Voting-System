<!-- <table id="basic-datatables" class="display table table-striped table-hover"> -->
<table id="add-row" class="display table table-striped table-hover">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Name</th>
            <th>ID</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            include('function/db_connect.php');
            
            $sql = "SELECT * FROM tbl_admin";

            $result = $conn->query($sql);
            $i = 1;

            if($result->num_rows >0)
            {
                while ($row = $result->fetch_assoc()) 
                {
                    //echo "staff_name: " . $row['staff_name'] . "<br>";
                    $ano = $row['admin_no'];
                    $name = $row['admin_name'];
                    $aid = $row['admin_ID'];
                    ?>                    
                    <tr>
                        <td><?php  echo $i; ?></td>
                        <td><?php  echo $name; ?></td>
                        <td><?php  echo $aid; ?></td>
                        <td>
                            <div class="form-button-action">
                              <button type="button" data-bs-toggle="tooltip" title=""
                                class="btn btn-link btn-primary btn-lg btn_edit" value="<?php  echo $ano; ?>" 
                                    data-original-title="Edit Task">
                                <i class="fa fa-edit"></i>
                              </button>
                              <button type="button" data-bs-toggle="tooltip" value="<?php  echo $ano; ?>"
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