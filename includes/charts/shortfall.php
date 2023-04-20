<div class="col-lg-6">
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
                                while ($row = $result->fetch_assoc()) {
                                    array_push($dates, $row["take_out_id"]);
                                    array_push($shortfalls, $row["shortfall"]);
                                }
                            } else {
                                echo "0 results";
                            }


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
                                        categories: [" . implode(", ", array_map(function ($date) {
                                return "
                                            '" . $date . "'
                                            ";
                            }, $dates)) . "
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