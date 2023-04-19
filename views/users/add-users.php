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
    <div class="modal fade" id="new-order" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="popup text-left">
                        <h4 class="mb-3">New Order</h4>
                        <div class="content create-workform bg-body">
                            <div class="pb-3">
                                <label class="mb-2">Email</label>
                                <input type="text" class="form-control" placeholder="Enter Name or Email">
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-wrap align-items-ceter justify-content-center">
                                    <div class="btn btn-danger mr-4" data-dismiss="modal">Cancel</div>
                                    <div class="btn btn-outline-primary" data-dismiss="modal">Create</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-page">
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Add Users</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="../../controllers/users/add-users.php" data-toggle="validator" onsubmit="return confirm('Do you really want to submit the form?');">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name *</label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter Name"
                                                required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone Number *</label>
                                            <input type="text" name="number" class="form-control"
                                                placeholder="Enter Phone No" pattern="[07][0-9]{9}" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>School Email *</label>
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Enter Email" onkeyup="check_email()" required>
                                                <span id="validationResult"></span>
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
                                            <label>Return Admin</label>
                                            <select name="return" class="selectpicker form-control"
                                                data-style="py-0">
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</optio>
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>User ID *</label>
                                            <input type="text" name="id" class="form-control"
                                                placeholder="Enter User Name" required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Enter Password" onkeyup='check();' required>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="password" id="confirm_password" class="form-control"
                                                placeholder="Enter Confirm Password" onkeyup='check();' required>
                                                <span id='message'></span>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" name="submit" class="btn btn-danger mr-2">Add User</button>
                                <button type="reset" class="btn btn-danger">Clear</button>
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
    <script>
    var check = function() {
        if (document.getElementById('password').value ==
            document.getElementById('confirm_password').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'Not matching';
        }
    }
    </script>
    <script>
        var check_email = function(){
            const email = document.querySelector('#email').value;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailRegex.test(email)) {
          if (email.endsWith('@africau.edu')) {
            validationResult.textContent = 'Email is valid and ends with africau.edu';
          } else {
            validationResult.textContent = 'Email is valid but does not end with africau.edu';
          }
        } else {
          validationResult.textContent = 'Email is not valid';
        }
        }
    </script>
    <!-- Backend Bundle JavaScript -->
    <?php
    require("../../includes/scripts.php");
    ?>
</body>

</html>