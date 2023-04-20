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