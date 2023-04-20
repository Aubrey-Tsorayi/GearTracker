<!doctype html>

<?php
require('../../includes/validations/geart_validation.php');
require("../../config/db-config.php");
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-transparent card-block card-stretch card-height border-none">
                        <div class="card-body p-0 mt-lg-2 mt-0">
                            <h3 class="mb-3">Hi
                                <?php echo $_SESSION['user_name']; ?>
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-info-light">
                                            <img src="../../assets/images/product/1.png" class="img-fluid" alt="image">
                                        </div>
                                        <?php
                                        $sql = "SELECT SUM(`quantity`) AS total FROM `equipment`";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $total = $row['total'];
                                        ?>
                                        <div>
                                            <p class="mb-2">Total Equipment</p>
                                            <h2>
                                                <?php echo $total; ?>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-danger-light">
                                            <img src="../../assets/images/product/2.png" class="img-fluid" alt="image">
                                        </div>
                                        <?php
                                        $sql = "SELECT SUM(`quantity_available`) AS sum FROM `equipment` WHERE `quantity_available` > 0";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $sum = $row['sum'];
                                        ?>
                                        <div>
                                            <p class="mb-2">Avaliable Equipment</p>
                                            <h4>
                                                <?php echo $sum; ?>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="iq-progress-bar mt-2">
                                        <span class="bg-danger iq-progress progress-1"
                                            data-percent="<?php echo ($sum / $total) * 100; ?>">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card card-block card-stretch card-height">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-4 card-total-sale">
                                        <div class="icon iq-icon-box-2 bg-success-light">
                                            <img src="../../assets/images/product/3.png" class="img-fluid" alt="image">
                                        </div>
                                        <?php
                                        $sql = "SELECT SUM(`shortfall`) AS short FROM `returns`";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $short = $row['short'];

                                        $sql = "SELECT SUM(`quantity`) AS quantity FROM `take_out`";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_fetch_assoc($result);
                                        $quantity = $row['quantity'];
                                        ?>
                                        <div>
                                            <p class="mb-2">Shortfall Equipment</p>
                                            <h4>
                                                <?php echo $short; ?>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="iq-progress-bar mt-2">
                                        <span class="bg-success iq-progress progress-1"
                                            data-percent="<?php echo ($short / $quantity) * 100; ?>">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                // dashboard charts
                require("../../includes/charts/takeouts.php");
                require("../../includes/charts/shortfall.php");
                require("../../includes/charts/equipment.php");
                ?>


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