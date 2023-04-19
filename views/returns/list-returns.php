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
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">

        <?php require('../../includes/sidebar.php') ?>
        <div class="p-3"></div>
    </div>
    <div class="p-3"></div>
    </div>
    </div>
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <?php
              require('../../includes/nav.php');
              ?>
        </div>
    </div>
    <div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup text-left">
                        <h4 class="mb-3">New Order</h4>
                        <div class="content create-workform bg-body">
                            <div class="pb-3">
                                <label class="mb-2">Email</label>
                                <input type="text" class="form-control" placeholder="Enter Name or Email">
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <div class="btn btn-danger mr-4" data-dismiss="modal">Cancel</div>
                                    <div class="btn btn-outline-primary" data-dismiss="modal">Create</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="mb-3">Returns</h4>
                        </div>
                        <a href="../returns/add-return.php" class="btn btn-danger add-list"><i
                                class="las la-plus mr-3"></i>Add Returns</a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive rounded mb-3">
                        <table class="data-table table mb-0 tbl-server-info" id="table">
                            <thead class="bg-white text-uppercase">
                                <tr class="ligth ligth-data">
                                    <th>Date</th>
                                    <th>Reference No</th>
                                    <th>Admin</th>
                                    <th>User</th>
                                    <th>Short fall</th>
                                    <th>Damaged</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                                <?php
                                            //fetch data from db

                                            
                                            $sql = "SELECT `returns`.`take_out_id`, `returns`.`date`, `returns`.`shortfall`, `returns`.`damaged`, `returns`.`description`, `returns`.`return_admin`, `users`.`user_name`
                                            FROM `returns`
                                            INNER JOIN `take_out` ON `returns`.`take_out_id` = `take_out`.`take_out_id`
                                            INNER JOIN `users` ON `take_out`.`user_id` = `users`.`user_id`";

                                            //result
                                            $result = mysqli_query($conn, $sql);

                                            $resultCheck = mysqli_num_rows($result);

                                            if ($resultCheck > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '
                                                                <tr>
                                                                    <td>' . $row['date'] . '</td>
                                                                    <td>' . $row['take_out_id'] . '</td>
                                                                    <td>' . $row['return_admin'] . '</td>
                                                                    <td>' . $row['user_name'] . '</td>
                                                                    <td>' . $row['shortfall'] . '</td>
                                                                    <td>' . $row['damaged']. '</td>
                                                                    <td>' . $row['description']. '</td>
                                                                </tr>';
                        }
                    }

                                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                if($_SESSION['level_access'] == 3){
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