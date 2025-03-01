<table id="basic-datatables" class="display table table-striped table-hover">
    <thead>
        <tr>
            <th>S.No</th>
            <th>Position</th>
            <th>Limit</th>
            <th>Election Date</th>
            <th>Nomination Date</th>
            <th>Result Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            include('function/db_connect.php');
            
            $sql = "SELECT * FROM tbl_position";

            $result = $conn->query($sql);
            $i = 1;

            if($result->num_rows >0)
            {
                while ($row = $result->fetch_assoc()) 
                {
                    //echo "staff_name: " . $row['staff_name'] . "<br>";
                    $sno = $row['position_no'];
                    $name = $row['position_name'];
                    $limit = $row['position_limit'];
                    $ele_date = $row['election_date'];
                    $nomi_date = $row['nomination_date'];
                    $res_date = $row['result_date'];
                    ?>                    
                    <tr>
                        <td><?php  echo $i; ?></td>
                        <td><?php  echo $name; ?></td>
                        <td><?php  echo $limit; ?></td>
                        <td><?php  echo date("d-M-Y", strtotime($ele_date) ); ?></td>
                        <td><?php  echo date("d-M-Y", strtotime($nomi_date) ); ?></td>
                        <td><?php  echo date("d-M-Y", strtotime($res_date) ); ?></td>
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