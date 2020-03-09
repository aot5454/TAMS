<?php
defined('BASEPATH') or exit('No direct script access allowed');
// print_r($_SESSION)
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= "TAMS | " . $title; ?></title>

    <link rel="icon" type="image/png" href="https://image.flaticon.com/icons/png/512/1157/1157034.png" />
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('resources/assets/admin_panal/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css?family=Prompt:200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap&subset=thai" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('resources/assets/admin_panal/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="<?php echo base_url('resources/assets/admin_panal/vendor/datatables/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('resources/assets/snack/snack.css'); ?>" rel="stylesheet">
    <link href="<?php echo base_url('resources/assets/snack/chackbox.css'); ?>" rel="stylesheet">

    <style>
        body {
            font-family: 'Prompt', sans-serif;
        }

        .border-left-org {
            border-left: .25rem solid #FF7F50 !important;
        }

        .text-org {
            color: #FF7F50 !important;
        }

        .border-left-purple {
            border-left: .25rem solid #800080 !important;
        }

        .text-purple {
            color: #800080 !important;
        }
    </style>

    <div id="snackbar"><?php echo $_SESSION['message']; ?></div>

    <?php if (isset($_SESSION['message'])) { ?>
        <?php echo "<script>
            var x = document.getElementById('snackbar');
            x.className = 'show';
            setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);
          </script>"; ?>
    <?php unset($_SESSION['message']);
    } ?>
</head>

<body id="page-top">

    <!-- <div class="container"> -->
    <div class="">
        <!-- Page Wrapper -->
        <div id="wrapper">

            <!-- Slide bar -->
            <?php
            $user = $this->session->userdata('status');
            if ($user == "admin") {
                include_once 'slidebar/slidebar_admin.php';
            } elseif ($user == "staff") {
                include_once 'slidebar/slidebar_staff.php';
            } elseif ($user == "teacher") {
                include_once 'slidebar/slidebar_teacher.php';
            } elseif ($user == "nisit") {
                include_once 'slidebar/slidebar_nisit.php';
            }
            ?>

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <!-- Main Content -->
                <div id="content">

                    <!-- Topbar -->
                    <?php include_once 'topbar.php'; ?>