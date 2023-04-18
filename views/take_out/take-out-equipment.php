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
                                            if($_SESSION['access_level'] == 3){
                                                $sql = "SELECT `equipment_name`, `quantity`, `equipment_code` 
                                                FROM `equipment` 
                                                WHERE `quantity_available` > 0";
                                                
                                            }else{
                                                $sql = "SELECT `equipment_name`, `quantity`, `equipment_code` 
                                                FROM `equipment` 
                                                WHERE `quantity_available` > 0 && `sport` = '$_SESSION[sport]'";

                                            }
                                            
                                            //result
                                            $result = mysqli_query($conn, $sql);

                                            $equipment_names = array();
                                            $equipment_codes = array();

                                            // Loop through the query results and add the equipment names to the array
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            $equipment_names[] = $row['equipment_name'];
                                            $equipment_codes[] = $row['equipment_code'];
                                            }
                                            
                                            echo '<select id="equipment" name="equipment" class="selectpicker form-control"
                                                data-style="py-0">';
                                                for($i=0; $i < count($equipment_names); $i++){
                                                echo '<option value="' . $equipment_codes[$i]. '">' .$equipment_names[$i]. '</option>';
                                                }
                                            echo '</select>';
                                            ?>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sport *</label>
                                            <?php
                                            $sql = "SELECT `sport` 
                                            FROM `sports`
                                            WHERE `sport` = '$_SESSION[sport]'";

                                            //result
                                            $result = mysqli_query($conn, $sql);

                                            $sport_names = array();

                                            // Loop through the query results and add the equipment names to the array
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            $sport_names[] = $row['sport'];
                                            }
                                            ?>
                                                <?php foreach ($sport_names as $name): ?>
                                                    <input type="text" id="equipment" name="sport" class="form-control"
                                                data-style="py-0" value="<?php echo $name; ?>" readonly>
                                                <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Quantity *</label>
                                            <input type="text" name="quantity" class="form-control"
                                                placeholder="Enter Number" data-errors="Please Enter Code." required>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-danger mr-2">Take Equipment</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>
    </div>
    </div>
    <!-- Backend Bundle JavaScript -->
    <?php
    require("../../includes/scripts.php");
    ?>
</body>

</html>