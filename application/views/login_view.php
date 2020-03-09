<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>TAMS | Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="https://image.flaticon.com/icons/png/512/1157/1157034.png" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "resources/assets/login/"; ?>vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "resources/assets/login/"; ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "resources/assets/login/"; ?>fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "resources/assets/login/"; ?>vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "resources/assets/login/"; ?>vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "resources/assets/login/"; ?>vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "resources/assets/login/"; ?>vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "resources/assets/login/"; ?>vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "resources/assets/login/"; ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() . "resources/assets/login/"; ?>css/main.css">
    <!--===============================================================================================-->
    <link href="https://fonts.googleapis.com/css?family=Prompt&display=swap" rel="stylesheet">
    <link href="<?php echo base_url('resources/assets/snack/snack.css'); ?>" rel="stylesheet">

    <style>
        * {
            font-family: 'Prompt', sans-serif;
        }

        body {
            font-family: 'Prompt', sans-serif;
        }
    </style>

</head>

<body>
    <?php //echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
    ?>
    <div id="snackbar"><?php echo $_SESSION['message']; ?></div>

    <?php if (isset($_SESSION['message'])) { ?>
        <?php echo "<script>
                        var x = document.getElementById('snackbar');
                        x.className = 'show';
                        setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);
                     </script>"; ?>
    <?php unset($_SESSION['message']);
    } ?>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('https://images.unsplash.com/photo-1521079299535-94854b0a7b27?ixlib=rb-1.2.1&auto=format&fit=crop&w=1053&q=80');">
            <div class="wrap-login100 p-t-30 p-b-50">
                <span class="login100-form-title p-b-41">
                    Teacher Assistant Management System
                </span>
                <form class="login100-form validate-form p-b-33 p-t-5" method="post" action="<?php echo base_url('login/validlogin') ?>" autocomplete="on">

                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <input class="input100" type="text" name="username" id="username" placeholder="User name">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100" type="password" name="password" id="password" placeholder="Password">
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                    </div>

                    <div class="container-login100-form-btn m-t-32">
                        <button class="login100-form-btn" type="submit">
                            Login
                        </button>
                    </div>

                </form>
            </div>
            <div class="container my-auto m-0">
                <div class="copyright text-center my-auto text-white">
                    <h6><span>Copyright &copy; 2019 - <?= date('Y'); ?> #ตามสัญญา. All rights reserved.</span></h6>
                </div>
            </div>
        </div>
    </div>

    <!--===============================================================================================-->
    <script src="<?php echo base_url() . "resources/assets/login/"; ?>vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url() . "resources/assets/login/"; ?>vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url() . "resources/assets/login/"; ?>vendor/bootstrap/js/popper.js"></script>
    <script src="<?php echo base_url() . "resources/assets/login/"; ?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url() . "resources/assets/login/"; ?>vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url() . "resources/assets/login/"; ?>vendor/daterangepicker/moment.min.js"></script>
    <script src="<?php echo base_url() . "resources/assets/login/"; ?>vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url() . "resources/assets/login/"; ?>vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="<?php echo base_url() . "resources/assets/login/"; ?>js/main.js"></script>


</body>

</html>