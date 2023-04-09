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
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Add Return</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Reference No *</label>
                                        <input type="text" name="reference" class="form-control"
                                            placeholder="Enter Reference No" required>
                                        <div class="help-block with-errors"></div>
                                        <br>
                                        <button type="submit" name="search" class="btn btn-success">Search</button>
                                        <?php
                                            $name = "";
                                            $quantity = "";
                                            if (isset($_POST['search'])) {
                                                $ref_code = mysqli_real_escape_string($conn, $_POST['reference']);
                                              
                                                // Query database
                                                $query = "SELECT `take_out`.`user_id`, `take_out`.`quantity` , `users`.`user_name` 
                                                FROM `take_out` 
                                                INNER JOIN `users` ON `take_out`.`user_id` = `users`.`user_id`
                                                WHERE `take_out_id`='$ref_code'";

                                                $result = mysqli_query($conn, $query);
                                              
                                                if (mysqli_num_rows($result) > 0) {
                                                  $row = mysqli_fetch_assoc($result);
                                                  $name = $row['user_name'];
                                                  $quantity = $row['quantity'];
                                                }
                                              }
                                              
                                              mysqli_close($conn);
                                              ?>
                                    </div>
                                </div>
                            </form>
                            <form action="../../controllers/returns/add-return.php" method="post"
                                data-toggle="validator">
                                <div class="row">
                                    <input type="text" name="reference" class="form-control"
                                        value="<?php echo $ref_code; ?>" hidden>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>User </label>
                                            <input type="text" name="name" class="form-control"
                                                placeholder="<?php echo $_SESSION['user_name']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Returnee </label>
                                            <input type="text" name="returnee" class="form-control"
                                                value="<?php echo $name; ?>">
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Damaged </label>
                                            <select name="damaged" class="selectpicker form-control" data-style="py-0">
                                                <option value="N">No</option>
                                                <option value="Y">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quantity</label>
                                            <input type="text" name="quantity" class="form-control"
                                                placeholder="<?php echo $quantity?>">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description (optional)</label>
                                            <input type="text" name="description" class="form-control"
                                                placeholder="How is equipment damaged">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary mr-2">Add Returns</button>
                                <button type="reset" class="btn btn-danger">Reset</button>
                            </form>
                        </div>
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