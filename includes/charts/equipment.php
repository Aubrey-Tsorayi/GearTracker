<div class="col-lg-12">
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