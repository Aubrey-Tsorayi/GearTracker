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
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card card-transparent card-block card-stretch card-height border-none">
                        <div class="card-body p-0 mt-lg-2 mt-0">
                            <h3 class="mb-3">Hi <?php echo $_SESSION['user_name']; ?> </h3>
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
                                            <h2><?php echo $total;?></h2>
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
                                            <h4><?php echo $sum;?></h4>
                                        </div>
                                    </div>
                                    <div class="iq-progress-bar mt-2">
                                        <span class="bg-danger iq-progress progress-1" data-percent="<?php echo ($sum/$total)*100;?>">
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
                                            <h4><?php echo $short;?></h4>
                                        </div>
                                    </div>
                                    <div class="iq-progress-bar mt-2">
                                        <span class="bg-success iq-progress progress-1" data-percent="<?php echo ($short/$quantity)*100;?>">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Take Outs</h4>
                            </div>
                            <div class="card-header-toolbar d-flex align-items-center">
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="layout1-chart1"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Total Equipment vs Avaliable Equipment</h4>
                            </div>
                            <div class="card-header-toolbar d-flex align-items-center">
                                <div class="dropdown">
                                    <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton002"
                                        data-toggle="dropdown">
                                        This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right shadow-none"
                                        aria-labelledby="dropdownMenuButton002">
                                        <a class="dropdown-item" href="#">Yearly</a>
                                        <a class="dropdown-item" href="#">Monthly</a>
                                        <a class="dropdown-item" href="#">Weekly</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="layout1-chart-2" style="min-height: 360px;"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-block card-stretch card-height-helf">
                        <div class="card-body">
                            <div class="d-flex align-items-top justify-content-between">
                                <div class="">
                                    <p class="mb-0">Income</p>
                                    <h5>$ 98,7800 K</h5>
                                </div>
                                <div class="card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton003"
                                            data-toggle="dropdown">
                                            This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right shadow-none"
                                            aria-labelledby="dropdownMenuButton003">
                                            <a class="dropdown-item" href="#">Year</a>
                                            <a class="dropdown-item" href="#">Month</a>
                                            <a class="dropdown-item" href="#">Week</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="layout1-chart-3" class="layout-chart-1"></div>
                        </div>
                    </div>
                    <div class="card card-block card-stretch card-height-helf">
                        <div class="card-body">
                            <div class="d-flex align-items-top justify-content-between">
                                <div class="">
                                    <p class="mb-0">Expenses</p>
                                    <h5>$ 45,8956 K</h5>
                                </div>
                                <div class="card-header-toolbar d-flex align-items-center">
                                    <div class="dropdown">
                                        <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton004"
                                            data-toggle="dropdown">
                                            This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                        </span>
                                        <div class="dropdown-menu dropdown-menu-right shadow-none"
                                            aria-labelledby="dropdownMenuButton004">
                                            <a class="dropdown-item" href="#">Year</a>
                                            <a class="dropdown-item" href="#">Month</a>
                                            <a class="dropdown-item" href="#">Week</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="layout1-chart-4" class="layout-chart-2"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Order Summary</h4>
                            </div>
                            <div class="card-header-toolbar d-flex align-items-center">
                                <div class="dropdown">
                                    <span class="dropdown-toggle dropdown-bg btn" id="dropdownMenuButton005"
                                        data-toggle="dropdown">
                                        This Month<i class="ri-arrow-down-s-line ml-1"></i>
                                    </span>
                                    <div class="dropdown-menu dropdown-menu-right shadow-none"
                                        aria-labelledby="dropdownMenuButton005">
                                        <a class="dropdown-item" href="#">Year</a>
                                        <a class="dropdown-item" href="#">Month</a>
                                        <a class="dropdown-item" href="#">Week</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pb-2">
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="d-flex align-items-center progress-order-left">
                                    <div class="progress progress-round m-0 orange conversation-bar" data-percent="46">
                                        <span class="progress-left">
                                            <span class="progress-bar"></span>
                                        </span>
                                        <span class="progress-right">
                                            <span class="progress-bar"></span>
                                        </span>
                                        <div class="progress-value text-secondary">46%</div>
                                    </div>
                                    <div class="progress-value ml-3 pr-5 border-right">
                                        <h5>$12,6598</h5>
                                        <p class="mb-0">Average Orders</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center ml-5 progress-order-right">
                                    <div class="progress progress-round m-0 primary conversation-bar" data-percent="46">
                                        <span class="progress-left">
                                            <span class="progress-bar"></span>
                                        </span>
                                        <span class="progress-right">
                                            <span class="progress-bar"></span>
                                        </span>
                                        <div class="progress-value text-primary">46%</div>
                                    </div>
                                    <div class="progress-value ml-3">
                                        <h5>$59,8478</h5>
                                        <p class="mb-0">Top Orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div id="layout1-chart-5"></div>
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
    <script src="../../assets/js/backend-bundle.min.js"></script>

    <!-- Table Treeview JavaScript -->
    <script src="../../assets/js/table-treeview.js"></script>

    <!-- Chart Custom JavaScript -->
    <script src="../../assets/js/customizer.js"></script>

    <!-- Chart Custom JavaScript -->
    <script async src="../../assets/js/chart-custom.js"></script>

    <!-- app JavaScript -->
    <script src="../../assets/js/app.js"></script>
</body>

</html>