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
                    <div class="col-lg-12">
                        <div class="d-flex flex-wrap flex-wrap align-items-center justify-content-between mb-4">
                            <div>
                                <h4 class="mb-3">Equipment List</h4>
                            </div>
                            <?php
                            if($_SESSION['access_level'] == 3){
                             echo '<a href="add-equipment.php" class="btn btn-danger add-list"><i
                                    class="las la-plus mr-3"></i>Add Equipment</a>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="table-responsive rounded mb-3">
                            <table class="data-table table mb-0 tbl-server-info">
                                <thead class="bg-white text-uppercase">
                                    <tr class="ligth ligth-data">
                                        <th>Equipment Code</th>
                                        <th>Name</th>
                                        <th>Sport</th>
                                        <th>Quantity</th>
                                        <th>Quantity Available</th>
                                    </tr>
                                </thead>
                                <tbody class="ligth-body">
                                    <?php
                                            //fetch data from db

                                            if ($_SESSION['access_level'] == 3){
                                                $sql = "SELECT `equipment_code`, `equipment_name`, `sport`, `quantity`, `quantity_available`
                                                FROM equipment";
                                            }else{
                                                $sql = "SELECT `equipment_code`, `equipment_name`, `sport`, `quantity`, `quantity_available`
                                                FROM equipment 
                                                WHERE `sport` = '$_SESSION[sport]'";
                                            }
                                            

                                            //result
                                            $result = mysqli_query($conn, $sql);

                                            $resultCheck = mysqli_num_rows($result);

                                            if ($resultCheck > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '
                                                                <tr>
                                                                    <td>' . $row['equipment_code'] . '</td>
                                                                    <td>' . $row['equipment_name'] . '</td>
                                                                    <td>' . $row['sport'] . '</td>
                                                                    <td>' . $row['quantity'] . '</td>
                                                                    <td>' . $row['quantity_available']. '</td>
                                                                </tr>';
                        }
                    }

                                            ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Page end  -->
            </div>
            <!-- Modal Edit -->
            <div class="modal fade" id="edit-note" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="popup text-left">
                                <div class="media align-items-top justify-content-between">
                                    <h3 class="mb-3">Equipment</h3>
                                    <div class="btn-cancel p-0" data-dismiss="modal"><i class="las la-times"></i></div>
                                </div>
                                <div class="content edit-notes">
                                    <div class="card card-transparent card-block card-stretch event-note mb-0">
                                        <div class="card-body px-0 bukmark">
                                            <div
                                                class="d-flex align-items-center justify-content-between pb-2 mb-3 border-bottom">
                                                <div class="quill-tool">
                                                </div>
                                            </div>

                                        </div>
                                        <div class="card-footer border-0">
                                            <div class="d-flex flex-wrap align-items-ceter justify-content-end">
                                                <div class="btn btn-danger mr-3" data-dismiss="modal">Cancel</div>
                                                <div class="btn btn-outline-primary" data-dismiss="modal">Save</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Wrapper End-->

    <!-- Backend Bundle JavaScript -->
    <?php
    require("../../includes/scripts.php");
    ?>
</body>

</html>