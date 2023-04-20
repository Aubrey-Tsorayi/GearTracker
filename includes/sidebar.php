      <div class="iq-sidebar  sidebar-default ">
          <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
              <?php  
          if($_SESSION['access_level'] == 3){
              echo '<a href="../dashboard/main-dash.php" class="header-logo">
                  <img src="../../assets/images/favicon.png" class="img-fluid rounded-normal light-logo" alt="logo">
                  <h5 class="logo-title light-logo ml-3">GearTracker</h5>
              </a>';
          }else{
            echo '<a href="../equipment/list-equipment.php" class="header-logo">
                  <img src="../../assets/images/favicon.png" class="img-fluid rounded-normal light-logo" alt="logo">
                  <h5 class="logo-title light-logo ml-3">GearTracker</h5>
              </a>';
          }
          ?>
              <div class="iq-menu-bt-sidebar ml-0">
                  <i class="las la-bars wrapper-menu"></i>
              </div>
          </div>
          <div class="data-scrollbar" data-scroll="1">
              <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                      <?php if($_SESSION['access_level'] == '3'){
                       echo '<li class="">
                          <a href="../dashboard/main-dash.php" class="svg-icon">
                              <svg class="svg-icon" id="p-dash1" width="20" height="20"
                                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path
                                      d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z">
                                  </path>
                                  <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                  <line x1="12" y1="22.08" x2="12" y2="12"></line>
                              </svg>
                              <span class="ml-4">Dashboards</span>
                          </a>
                      </li>';
                    }
                      ?>
                      <li class=" ">
                          <a href="../equipment/list-equipment.php" class=" ">
                              <svg class="svg-icon" id="p-dash2" width="20" height="20"
                                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <circle cx="9" cy="21" r="1"></circle>
                                  <circle cx="20" cy="21" r="1"></circle>
                                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                              </svg>
                              <span class="ml-4">Equipment</span>
                          </a>
                      </li>
                      <li class=" ">
                          <a href="../take_out/equipment-taken.php" class=" ">
                              <svg class="svg-icon" id="p-dash3" width="20" height="20"
                                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                  <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                              </svg>
                              <span class="ml-4">Take out</span>
                          </a>
                      </li>
                      <?php
                      if($_SESSION['access_level'] == 3 || $_SESSION['access_level'] == 2){
                      echo '<li class=" ">
                          <a href="../returns/list-returns.php" class=" ">
                              <svg class="svg-icon" id="p-dash6" width="20" height="20"
                                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <polyline points="4 14 10 14 10 20"></polyline>
                                  <polyline points="20 10 14 10 14 4"></polyline>
                                  <line x1="14" y1="10" x2="21" y2="3"></line>
                                  <line x1="3" y1="21" x2="10" y2="14"></line>
                              </svg>
                              <span class="ml-4">Returns</span>
                          </a>
                      </li>';
                      }
                      ?>
                      <?php if($_SESSION['access_level'] == '3'){
                      echo '<li class=" ">
                          <a href="../users/list-users.php" class=" ">
                              <svg class="svg-icon" id="p-dash8" width="20" height="20"
                                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                  stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                  <circle cx="9" cy="7" r="4"></circle>
                                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                              </svg>
                              <span class="ml-4">Users</span>
                          </a>
                      </li>';
                      }
                      ?>
                      <?php if($_SESSION['access_level'] == '3'){
                      echo '<li class=" ">
                          <a href="../logs/user_logs.php" class=" ">
                          <svg class="svg-icon" id="p-dash7" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline>
                      </svg>
                              <span class="ml-4">Logs</span>
                          </a>
                      </li>';
                      }
                      ?>
                  </ul>
              </nav>
          </div>
      </div>