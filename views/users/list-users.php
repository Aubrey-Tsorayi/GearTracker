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
                                    <div class="btn btn-primary mr-4" data-dismiss="modal">Cancel</div>
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
                            <h4 class="mb-3">Users</h4>
                        </div>
                        <a href="add-users.php" class="btn btn-primary add-list"><i class="las la-plus mr-3"></i>Add
                            User</a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive rounded mb-3">
                        <table class="data-table table mb-0 tbl-server-info">
                            <thead class="bg-white text-uppercase">
                                <tr class="ligth ligth-data">
                                    <th>Student ID</th>
                                    <th>Name</th>
                                    <th>Phone Number</th>
                                    <th>Email</th>
                                    <th>Sport</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                                <?php
                                            //fetch data from db

                                            
                                            $sql = "SELECT `user_id`, `user_name`, `email`, `phone_number`, `sport`
                                            FROM users";

                                            //result
                                            $result = mysqli_query($conn, $sql);

                                            $resultCheck = mysqli_num_rows($result);

                                            if ($resultCheck > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                        echo '
                                                                <tr>
                                                                    <td>' . $row['user_id'] . '</td>
                                                                    <td>' . $row['user_name'] . '</td>
                                                                    <td>' . $row['phone_number'] . '</td>
                                                                    <td>' . $row['email'] . '</td>
                                                                    <td>' . $row['sport']. '</td>
                                                                    <td>
                                                                            <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"
                                                                                href="?delete_user=' . $row['user_id'] . '"><i class="ri-delete-bin-line mr-0"></i></a>
                                                                        </div>
                                                                    </td>
                                                                </tr>';
                        }
                    }
                                                                                // handle delete request
                                                                if (isset($_GET['delete_user'])) {
                                                                    $user_id = $_GET['delete_user'];
                                                                    $sql = "DELETE FROM users WHERE user_id = $user_id";
                                                                    // asks user to confirm delete
                                                                    mysqli_query($conn, $sql);
                                                                    echo '<script> window.location.href="../../views/users/list-users.php"; </script>';
                                                                    exit();
                                                                }
                                                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
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