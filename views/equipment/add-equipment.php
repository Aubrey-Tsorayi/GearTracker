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
    <div class="content-page">
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Add Equipment</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="../../controllers/equipment/add-equipment.php" data-toggle="validator" onsubmit="return confirm('Are all the details correct?');">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Equipment Name *</label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter Name"
                                                data-errors="Please Enter Name." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Code *</label>
                                            <input type="text" name="code" class="form-control" placeholder="Enter Code"
                                                data-errors="Please Enter Code." required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sport *</label>
                                            <?php
                                            $sql = "SELECT `sport`, `code` 
                                            FROM `sports`";

                                            //result
                                            $result = mysqli_query($conn, $sql);

                                            $sport_names = array();

                                            // Loop through the query results and add the equipment names to the array
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            $sport_names[] = $row['sport'];
                                            }
                                            ?>
                                            <select id="equipment" name="sport" class="selectpicker form-control"
                                                data-style="py-0">
                                                <?php foreach ($sport_names as $name): ?>
                                                <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quantity *</label>
                                            <input type="text" name="equipment" class="form-control"
                                                placeholder="Enter Quantity" data-errors="Please Enter Code." required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label> Equipment Description</label>
                                            <input type="text" name="description" class="form-control" placeholder="Description">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-danger mr-2">Add Equipment</button>
                                <button type="reset" class="btn btn-warning">Reset</button>
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