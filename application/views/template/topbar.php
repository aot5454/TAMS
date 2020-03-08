 <?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
 <!-- Topbar -->
 <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

     <!-- Sidebar Toggle (Topbar) -->
     <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
         <i class="fa fa-bars"></i>
     </button>


     <!-- Topbar Navbar -->
     <ul class="navbar-nav ml-auto">

         <div class="topbar-divider d-none d-sm-block"></div>

         <!-- Nav Item - User Information -->
         <li class="nav-item dropdown no-arrow">
             <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                 <?php
                    $id = $this->session->userdata('login_id');
                    $status = $this->session->userdata('status');
                    $photo = 'https://source.unsplash.com/QAB-WJcbgJk/60x60';
                    if ($status == "nisit") {
                        $user = $this->User_model->fetch_user_id_st_print($id);
                        $name = $user[0]['st_title'] . $user[0]['st_name'] . " " . $user[0]['st_surname'];
                    } elseif ($status == "teacher") {
                        $user = $this->User_model->fetch_user_id_teacher($id);
                        $name = $user[0]['tc_name_thai'];
                    } elseif ($status == "staff") {
                        $user = $this->User_model->fetch_user_id_staff($id);
                        $name = $user[0]['staff_title'] . $user[0]['staff_name'] . " " . $user[0]['staff_surname'];
                    } elseif ($status == "admin") {
                        $user = $this->User_model->fetch_user_id_admin($id);
                        $name = $user[0]['admin_title'] . $user[0]['admin_name'] . " " . $user[0]['admin_surname'];
                        $photo = 'https://i.pinimg.com/originals/a7/61/f7/a761f73afe73b71f039a4c605b4eeba8.jpg';
                    }

                    ?>
                 <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $name; ?></span>
                 <img class="img-profile rounded-circle" src="<?= $photo; ?>">


             </a>
             <!-- Dropdown - User Information -->
             <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                 <a class="dropdown-item" href="#profile" data-toggle="modal" data-target="#profile">
                     <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                     Profile
                 </a>
                 <!-- <a class="dropdown-item" href="#">
                     <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                     Settings
                 </a>
                 <a class="dropdown-item" href="#">
                     <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                     Activity Log
                 </a> -->
                 <div class="dropdown-divider"></div>
                 <a class="dropdown-item" href="#logout" data-toggle="modal" data-target="#logoutModal">
                     <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                     Logout
                 </a>
             </div>
         </li>

     </ul>

 </nav>
 <!-- End of Topbar -->