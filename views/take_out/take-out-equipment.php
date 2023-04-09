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
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Take Out Equipment</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="../../controllers/take-out/take-out-equipment.php"
                                data-toggle="validator">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name of Equipment *</label>
                                            <?php
                                            $sql = "SELECT `equipment_name`, `quantity` 
                                            FROM `equipment` 
                                            WHERE `quantity` > 0";

                                            //result
                                            $result = mysqli_query($conn, $sql);

                                            $equipment_names = array();

                                            // Loop through the query results and add the equipment names to the array
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            $equipment_names[] = $row['equipment_name'];
                                            }
                                            ?>
                                            <select id="equipment" name="equipment" class="selectpicker form-control"
                                                data-style="py-0">
                                                <?php foreach ($equipment_names as $name): ?>
                                                <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sport *</label>
                                            <select name="sport" class="selectpicker form-control" data-style="py-0">
                                                <option value="RB01">Rugby</option>
                                                <option value="SC01">Soccer</option>
                                                <option value="Basketball">Basketball</option>
                                                <option value="VolleyBall">VolleyBall</option>
                                                <option value="Swimming">Swimming</option>
                                                <option value="Cricket">Cricket</option>
                                                <option value="Hockey">Hockey</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quantity *</label>
                                            <input type="text" name="quantity" class="form-control" placeholder="Enter Number"
                                                data-errors="Please Enter Code." required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary mr-2">Take Equipment</button>
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
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                                <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="mr-1">
                                <script>
                                document.write(new Date().getFullYear())
                                </script>©
                            </span> <a href="#" class="">POS Dash</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Backend Bundle JavaScript -->
    <?php
    require("../../includes/scripts.php");
    ?>
</body>

</html>