<nav class="navbar navbar-expand-lg navbar-light p-0">
    <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
        <i class="ri-menu-line wrapper-menu"></i>
        <a href="../dashboard/main-dash.php" class="header-logo">
            <img src="../../../assets/images/favicon.png" class="img-fluid rounded-normal" alt="logo">
            <h5 class="logo-title ml-3">GearTracker</h5>

        </a>
    </div>

    <div class="d-flex align-items-center" style="margin-left: auto;">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
            <i class="ri-menu-3-line"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-list align-items-center">
                <li class="nav-item nav-icon dropdown">
                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-bell">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                        <span class="bg-primary "></span>
                    </a>
                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="card shadow-none m-0">
                            <div class="card-body p-0 ">
                                <div class="cust-title p-3">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h5 class="mb-0">Notifications</h5>
                                    </div>
                                </div>
                                <div class="px-3 pt-0 pb-0 sub-card">
                                    <?php 
                                    $sql = "SELECT `date`, `title`, `message` FROM `notifications` ORDER BY date DESC LIMIT 5";
                                    $result = mysqli_query($conn, $sql);

                                    // output data of each row
                                    while($row = mysqli_fetch_assoc($result)) {
                                    echo '
                                    <div class="media align-items-center cust-card py-3 border-bottom">
                                        <div class="media-body ml-3">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h6 class="mb-0">'. $row["title"].'</h6>
                                                <small class="text-dark"><b>'. $row["date"].'</b></small>
                                            </div>
                                            <small class="mb-0">'. $row["message"].'</small>
                                        </div>
                                        </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                </li>
                <li class="nav-item nav-icon dropdown caption-content">
                    <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <img src="../../assets/images/user/1.png" class="img-fluid rounded" alt="user">
                    </a>
                    <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <div class="card shadow-none m-0">
                            <div class="card-body p-0 text-center">
                                <div class="p-3">
                                    <h5 class="mb-1"><?php echo $_SESSION['user_name']; ?></h5>
                                    <div class="d-flex align-items-center justify-content-center mt-3">

                                        <a href="../auth/logout.php" class="btn border">Sign Out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>