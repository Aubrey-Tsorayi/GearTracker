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
                                        <span class="bg-danger iq-progress progress-1"
                                            data-percent="<?php echo ($sum/$total)*100;?>">
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
                                        <span class="bg-success iq-progress progress-1"
                                            data-percent="<?php echo ($short/$quantity)*100;?>">
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
                            <?php
                            $sql = "SELECT * FROM `take_out`";
                            $result = mysqli_query($conn, $sql);
                            $data = array();

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data[] = array(
                                    'x' => $row['date'],
                                    'y' => $row['quantity']
                                );

                            }
                            $data = json_encode($data);
                            ?>
                            <div id="layout1-chart12"></div>
                            <script>
                            var options = {
                                chart: {
                                    type: 'area',
                                    height: 350
                                },
                                series: [{
                                    data: <?php echo $data; ?>
                                }],
                                xaxis: {
                                    type: 'datetime'
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#layout1-chart12"), options);
                            chart.render();
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Total Equipment vs Avaliable Equipment</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                                $sql2 = "SELECT `quantity`, `quantity_available`, `equipment_name` FROM `equipment`";
                                $result2 = mysqli_query($conn, $sql2);
                                $data2 = array();

                                if ($result2->num_rows > 0) {
                                    while ($row = $result2->fetch_assoc()) {
                                        $data2[] = array(
                                            "quantity" => $row["quantity"],
                                            "quantity_available" => $row["quantity_available"],
                                            "equipment_name" => $row["equipment_name"]
                                        );
                                    }
                                }
                                $data_json2 = json_encode($data2);
                            ?>
                            <div id="layout1-chart-21"></div>
                            <script>
                            var options = {
                                series: [{
                                        name: "Quantity",
                                        data: <?php echo $data_json2; ?>.map(item => item.quantity)
                                    },
                                    {
                                        name: "Quantity Available",
                                        data: <?php echo $data_json2; ?>.map(item => item.quantity_available)
                                    }
                                ],
                                chart: {
                                    height: 350,
                                    type: "bar",
                                    stacked: false
                                },
                                dataLabels: {
                                    enabled: false
                                },
                                stroke: {
                                    width: [2, 2],
                                    curve: "smooth"
                                },
                                xaxis: {
                                    categories: <?php echo $data_json2; ?>.map(item => item.equipment_name),
                                },
                                yaxis: [{
                                        axisTicks: {
                                            show: true,
                                        },
                                        axisBorder: {
                                            show: true,
                                            color: "#008FFB"
                                        },
                                        labels: {
                                            style: {
                                                colors: "#008FFB"
                                            }
                                        },
                                        title: {
                                            text: "Quantity",
                                            style: {
                                                color: "#008FFB"
                                            }
                                        }
                                    },
                                    {
                                        opposite: true,
                                        axisTicks: {
                                            show: true,
                                        },
                                        axisBorder: {
                                            show: true,
                                            color: "#00E396"
                                        },
                                        labels: {
                                            style: {
                                                colors: "#00E396"
                                            }
                                        },
                                        title: {
                                            text: "Quantity Available",
                                            style: {
                                                color: "#00E396"
                                            }
                                        }
                                    }
                                ],
                                tooltip: {
                                    shared: true,
                                    intersect: false,
                                    y: {
                                        formatter: function(y) {
                                            if (typeof y !== "undefined") {
                                                return y.toFixed(0) + " units";
                                            }
                                            return y;
                                        }
                                    }
                                },
                                legend: {
                                    horizontalAlign: "left",
                                    offsetX: 40
                                }
                            };

                            var chart = new ApexCharts(document.querySelector("#layout1-chart-21"), options);
                            chart.render();
                            </script>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card card-block card-stretch card-height-helf">
                        <div class="card-body">
                            <div class="d-flex align-items-top justify-content-between">
                                <div class="">
                                    <h5>Shortfalls</h5>
                                </div>
                                <div class="card-header-toolbar d-flex align-items-center">
                                </div>
                            </div>
                            <?php
                            $sql = "SELECT `take_out_id`, `shortfall` FROM `returns`";
                            $result = $conn->query($sql);

                            // Create arrays for chart data
                            $dates = array();
                            $shortfalls = array();

                            if ($result->num_rows > 0) {
                            // Output data of each row
                            while($row = $result->fetch_assoc()) {
                            array_push($dates, $row["take_out_id"]);
                            array_push($shortfalls, $row["shortfall"]);
                            }
                            } else {
                            echo "0 results";
                            }

                            $conn->close();

                            // Generate ApexCharts line chart
                            echo "<html>

                            <head>
                                <script src='https://cdn.jsdelivr.net/npm/apexcharts'></script>
                            </head>

                            <body>

                                <div id='chart'></div>

                                <script>
                                var options = {
                                    series: [{
                                        name: 'Shortfall',
                                        data: [" . implode(", ", $shortfalls) . "]
                                    }],
                                    colors: ['#FF4560'],
      chart: {
      height: 150,
      type: 'line',
      zoom: {
        enabled: false
      },
      dropShadow: {
        enabled: true,
        color: '#000',
        top: 12,
        left: 1,
        blur: 2,
        opacity: 0.2
      },
      toolbar: {
        show: false
      },
      sparkline: {
        enabled: true,
      }
    },
    dataLabels: {
      enabled: false
    },
    stroke: {
      curve: 'smooth',
      width: 3
    },
    title: {
      text: '',
      align: 'left'
    },
    grid: {
      row: {
        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        opacity: 0.5
      },
    },
                                    xaxis: {
                                        categories: [" . implode(", ", array_map(function($date) { return "
                                            '" . $date . "'
                                            "; }, $dates)) . "
                                        ]
                                    }
                                };

                                var chart = new ApexCharts(document.querySelector('#chart'), options);

                                chart.render();
                                </script>

                            </body>

                            </html>";
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card card-block card-stretch card-height">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Take Outs Vs Returns</h4>
                            </div>
                            <div class="card-header-toolbar d-flex align-items-center">
                            </div>
                        </div>
                        <div class="card-body pb-2">
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