<!doctype html>
<?php
require('../../includes/validations/geart_validation.php');
require ("../../config/db-config.php");
?>
<html lang="en">
<?php
  require("../../includes/header.php");
    ?>

<body class="  ">
    <!-- loader Start -->
    <!-- <div id="loading">
        <div id="loading-center">
        </div>
    </div> -->
    <!-- loader END -->
    <!-- Wrapper Start -->
    <!-- Wrapper Start -->
    <div class="wrapper">
        <?php require('../../includes/sidebar.php') ?>
        <div class="p-3"></div>
        <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
                <?php
              require('../../includes/nav.php');
              ?>
            </div>
        </div>
        <div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-hidden="true">
        </div>
        <div class="content-page">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    if($_SESSION['access_level'] == 3){

                    }else{
                        echo '<div class="col-lg-12">
                        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                            <div>
                                <h4 class="mb-3">Take Outs</h4>
                            </div>
                            <a href="take-out-equipment.php" class="btn btn-danger add-list"><i
                                    class="las la-plus mr-3"></i>Take out</a>
                        </div>
                    </div>';
                    }
                    ?>
                    <div class="col-lg-12">
                        <div class="table-responsive rounded mb-3">
                            <table class="data-table table mb-0 tbl-server-info" id="table">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>Take Out ID</th>
                                        <th>User</th>
                                        <th>Equipment Name</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody class="ligth-body">
                                    <?php
                                            //fetch data from db

                                            if ($_SESSION['access_level'] == 3){
                                                $sql = "SELECT `take_out`.`take_out_id`, `take_out`.`equipment_name`, `take_out`.`user_id`, `take_out`.`quantity`, `take_out`.`date`, `users`.`user_name`
                                                FROM `take_out`
                                                INNER JOIN `users` ON `take_out`.`user_id` = `users`.`user_id`";
                                            }else{
                                                $sql = "SELECT `take_out`.`take_out_id`, `take_out`.`equipment_name`, `take_out`.`user_id`, `take_out`.`quantity`, `take_out`.`date`, `users`.`user_name`
                                                FROM `take_out`
                                                INNER JOIN `users` ON `take_out`.`user_id` = `users`.`user_id`
                                                WHERE `sport` = '$_SESSION[sport]'";
                                            }
                                            

                                            //result
                                            $result = mysqli_query($conn, $sql);

                                            $resultCheck = mysqli_num_rows($result);

                                            if ($resultCheck > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '
                                                                <tr>
                                                                    <td>' . $row['take_out_id'] . '</td>
                                                                    <td>' . $row['user_name'] . '</td>
                                                                    <td>' . $row['equipment_name'] . '</td>
                                                                    <td>' . $row['quantity'] . '</td>
                                                                    <td>' . $row['date']. '</td>
                                                                </tr>';
                        }
                    }

                                            ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                if($_SESSION['access_level'] == 3){
                    echo '<div class="col-lg-12">
                    <!-- add button to print table -->
                    <button class="btn btn-danger add-list" onclick="printTable()"><i
                            class="las la-plus mr-3"></i>Print</button>
                </div>';
                }else{
                    
                }
                ?>
                </div>
                <!-- Page end  -->
            </div>
        </div>
    </div>
    <!-- Wrapper End-->

    <!-- Backend Bundle JavaScript -->
    <script>
    function printTable() {
        var table = document.getElementById('table');
        var win = window.open('', '', 'height=700,width=700');
        win.document.write(table.outerHTML);
        win.document.close();
        win.print();
    }
    </script>
    <?php
    require("../../includes/scripts.php");
    ?>
</body>

</html>