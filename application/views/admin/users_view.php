<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">User</h1>
    <p class="mb-4">This page show information about users.</p>

    <!-- Content Row Count-->
    <div class="row">

        <!-- User count -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">User All</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $users_count . "+" . ($users_admin + $users_staff + $users_teacher); ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- cs count -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-org shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-org text-uppercase mb-1">Computer Science</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $users_cs ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- it count -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-purple shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-purple text-uppercase mb-1">Technology Information</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $users_it ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- admin-staff count -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Admin-Staff-Teacher</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $users_admin . " - " . $users_staff . " - " . $users_teacher; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- Content Row Count -->

    <!-- Table Student -->
    <!-- Content Row Card -->
    <div class="row">

        <!-- Table col 8 -->
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table Student</h6>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <div class="float-right">
                            <button type="button" class="btn btn-success ml-3" data-toggle="modal" data-target="#addUserNisit">ADD Student</button>
                        </div>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Password</th>
                                    <th>Major</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($users as $user) {
                                    $i++;
                                ?>
                                    <tr>
                                        <td style="width: 2%; text-align: center;"><?= $i; ?></td>
                                        <td><?php echo $user['st_id']; ?></td>
                                        <td><?php echo $user['st_title'] . $user['st_name'] . " " . $user['st_surname']; ?></td>
                                        <td><?php echo $user['st_pwd']; ?></td>
                                        <td><?php echo ($user['maj_id'] == 10007) ? "วิทยาการคอมพิวเตอร์" : "เทคโนโลยีสารสนเทศ"; ?></td>
                                        <td style="width:  8.33%">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                                <button class="dropdown-item" id="editUserBtn" data-id="<?= $user['st_id']; ?>" data-pass="<?= $user['st_pwd']; ?>" data-title="<?= $user['st_title']; ?>" data-name="<?= $user['st_name']; ?>" data-surname="<?= $user['st_surname']; ?>" data-sex="<?= $user['st_sex']; ?>" data-nickname="<?= $user['st_nickname']; ?>" data-major="<?= $user['maj_id']; ?>" data-tel="<?= $user['st_tel']; ?>" data-email="<?= $user['st_email']; ?>" data-toggle="modal" data-target="#editUserNisit">Edit</button>
                                                <a class="dropdown-item" href="#" data-href="<?php echo base_url('admin/removeUserNisit/') . $user['st_id'] ?>" data-toggle="modal" data-target="#confirm-delete">Remove</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } //end for
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Table -->

    </div>
    <!-- ./ Content Row Card -->

    <!-- Table Teacher -->
    <!-- Content Row Card -->
    <div class="row">

        <!-- Table col 8 -->
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table Teacher</h6>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <div class="float-right">
                            <button type="button" class="btn btn-success ml-3" data-toggle="modal" data-target="#addUserTeacher">ADD Teacher</button>
                        </div>
                        <table class="table table-bordered" id="tableTeacher" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID</th>
                                    <th>Password</th>
                                    <th>Name Thai</th>
                                    <th>Name Eng</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $i = 0;

                                foreach ($users_teacher_arr as $tc) {
                                    $i++;
                                ?>
                                    <tr>
                                        <td style="width: 2%; text-align: center;"><?= $i; ?></td>
                                        <td><?php echo $tc['tc_id']; ?></td>
                                        <td><?php echo $tc['tc_pwd']; ?></td>
                                        <td><?php echo $tc['tc_name_thai']; ?></td>
                                        <td><?php echo $tc['tc_name_eng']; ?></td>
                                        <td style="width:  8.33%">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                                <button class="dropdown-item" id="editUserBtn" data-toggle="modal" data-id="<?= $tc['tc_id']; ?>" data-namethai="<?= $tc['tc_name_thai']; ?>" data-nameeng="<?= $tc['tc_name_eng']; ?>" data-pwd="<?= $tc['tc_pwd']; ?>" data-target="#editUserTeacher">Edit</button>
                                                <a class="dropdown-item" href="#" data-href="<?php echo base_url('admin/removeUserTeacher/') . $tc['tc_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Remove</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } //end for

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Table -->

    </div>
    <!-- ./ Content Row Card -->

    <!-- Table Staff -->
    <!-- Content Row Card -->
    <div class="row">

        <!-- Table col 8 -->
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Table Staff</h6>
                </div>

                <div class="card-body">

                    <div class="table-responsive">
                        <div class="float-right">
                            <button type="button" class="btn btn-success ml-3" data-toggle="modal" data-target="#addUserStaff">ADD Staff</button>
                        </div>
                        <table class="table table-bordered" id="tableStaff" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Name</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                foreach ($users_staff_arr as $st) {
                                    $i++;
                                ?>
                                    <tr>
                                        <td style="width: 2%; text-align: center;"><?= $i; ?></td>
                                        <td><?php echo $st['staff_id']; ?></td>
                                        <td><?php echo $st['staff_pwd']; ?></td>
                                        <td><?php echo $st['staff_title'] . $st['staff_name'] . " " . $st['staff_surname']; ?></td>
                                        <td style="width:  8.33%">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                                <button class="dropdown-item" id="editUserBtn" data-toggle="modal" data-id="<?= $st['staff_id']; ?>" data-title="<?= $st['staff_title']; ?>" data-name="<?= $st['staff_name']; ?>" data-surname="<?= $st['staff_surname']; ?>" data-pwd="<?= $st['staff_pwd']; ?>" data-target="#editUserStaff">Edit</button>
                                                <a class="dropdown-item" href="#" data-href="<?php echo base_url($this->session->userdata('status') . '/removeUserStaff/') . $st['staff_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Remove</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } //end for

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Table -->

    </div>
    <!-- ./ Content Row Card -->

    <?php
    if ($this->session->userdata('status') == "admin") { ?>
        <!-- Table admin -->
        <!-- Content Row Card -->
        <div class="row">

            <!-- Table col 8 -->
            <div class="col-lg-12">
                <!-- DataTales -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Table Admin</h6>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <div class="float-right">
                                <button type="button" class="btn btn-success ml-3" data-toggle="modal" data-target="#addUserAdmin">ADD Admin</button>
                            </div>
                            <table class="table table-bordered" id="tableAdmin" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Name</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    foreach ($users_admin_arr as $st) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td style="width: 2%; text-align: center;"><?= $i; ?></td>
                                            <td><?php echo $st['admin_username']; ?></td>
                                            <td><?php echo $st['admin_pwd']; ?></td>
                                            <td><?php echo $st['admin_title'] . $st['admin_name'] . " " . $st['admin_surname']; ?></td>
                                            <td style="width:  8.33%">
                                                <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Action
                                                </button>
                                                <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                                    <button class="dropdown-item" id="editUserBtn" data-toggle="modal" data-id="<?= $st['admin_id']; ?>" data-username="<?= $st['admin_username']; ?>" data-title="<?= $st['admin_title']; ?>" data-name="<?= $st['admin_name']; ?>" data-surname="<?= $st['admin_surname']; ?>" data-pwd="<?= $st['admin_pwd']; ?>" data-target="#editUserAdmin">Edit</button>
                                                    <a class="dropdown-item" href="#" data-href="<?php echo base_url($this->session->userdata('status') . '/removeUserAdmin/') . $st['admin_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Remove</a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } //end for

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Table -->

        </div>
        <!-- ./ Content Row Card -->
    <?php
    } ?>
</div>
<!-- /.container-fluid -->



<!-- MODEL -->

<!-- Modal Remove User-->
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeLabel">Remove User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <p class="debug-url"></p>
                    <p>Are you remove this user?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">CANCEL</button>
                <a class="btn btn-danger btn-ok">Remove</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal EDIT USER Student-->
<div class="modal fade" id="editUserNisit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="<?php echo base_url('admin/editUserNisit'); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="id-edit">ID Student</label>
                                <input type="text" class="form-control" name="id-edit" id="id-edit" placeholder="Enter ID" required readonly>
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="pass">New Password</label>
                                <input type="password" name="password-old" id="password-old" value="" hidden>
                                <input type="password" class="form-control" name="password-edit" id="pass" placeholder="Enter new Password">
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="repass">Re-New Password</label>
                                <input type="password" class="form-control" name="repassword-edit" id="repass" placeholder="Enter Re-Password">
                                <div class="" id="validate-status2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="title-edit">คำนำหน้า</label>
                                <select class="form-control" name="title-edit" id="title-edit" required>
                                    <option disabled>-- เลือก --</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="name-edit">ชื่อจริง</label>
                                <input type="text" class="form-control" name="name-edit" id="name-edit" placeholder="Enter name" required>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="surname-edit">นามสกุล</label>
                                <input type="text" class="form-control" name="surname-edit" id="surname-edit" placeholder="Enter surname" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="sex-edit">เพศ</label>
                                <select class="form-control" name="sex-edit" id="sex-edit" required>
                                    <option selected disabled>-- เลือก --</option>
                                    <option value="1">ชาย</option>
                                    <option value="2">หญิง</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="nickname-edit">ชื่อเล่น</label>
                                <input type="text" class="form-control" name="nickname-edit" id="nickname-edit" placeholder="Enter nickname">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="lv-edit">ชั้นปี</label>
                                <select class="form-control" name="lv" id="lv-edit" required>
                                    <option selected disabled>-- เลือก --</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="fac-edit">คณะ</label>
                                <input type="text" class="form-control" name="fac-edit" id="fac-edit" value="วิทยาศาสตร์" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="major-edit">สาขา</label>
                                <select class="form-control" name="major-edit" id="major-edit" required>
                                    <option selected disabled>-- เลือก --</option>
                                    <option value="10007">วิทยาการคอมพิวเตอร์</option>
                                    <option value="10008">เทคโนโลยีสารสนเทศ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="tel-edit">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" name="tel-edit" id="tel-edit" placeholder="Enter Telephone number">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email-edit">E-mail</label>
                                <input type="email" class="form-control" name="email-edit" id="email-edit" placeholder="Enter Email">
                            </div>
                        </div>
                    </div>

                    <input type="text" name="status-edit" value="nisit" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-success float-right" type="submit" id="btnSubmitEdit">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Add USER Student-->
<div class="modal fade" id="addUserNisit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLongTitle">Add Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="<?php echo base_url('admin/addUserNisit'); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="id">ID Student</label>
                                <input type="text" class="form-control" name="id" id="id" placeholder="Enter ID" required>
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required>
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="repassword">Re-New Password</label>
                                <input type="password" class="form-control" name="repassword" id="repassword" placeholder="Enter Re-Password" required>
                                <div class="" id="validate-status2"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="title">คำนำหน้า</label>
                                <select class="form-control" name="title" id="title" required>
                                    <option selected disabled>-- เลือก --</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="name">ชื่อจริง</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" required>
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="surname">นามสกุล</label>
                                <input type="text" class="form-control" name="surname" id="surname" placeholder="Enter surname" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="sex">เพศ</label>
                                <select class="form-control" name="sex" id="sex" required>
                                    <option selected disabled>-- เลือก --</option>
                                    <option value="1">ชาย</option>
                                    <option value="2">หญิง</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="nickname">ชื่อเล่น</label>
                                <input type="text" class="form-control" name="nickname" id="nickname" placeholder="Enter nickname">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="lv">ชั้นปี</label>
                                <select class="form-control" name="lv" id="lv" required>
                                    <option selected disabled>-- เลือก --</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="fac">คณะ</label>
                                <input type="text" class="form-control" name="fac" id="fac" value="วิทยาศาสตร์" readonly>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="major">สาขา</label>
                                <select class="form-control" name="major" id="major" required>
                                    <option selected disabled>-- เลือก --</option>
                                    <option value="10007">วิทยาการคอมพิวเตอร์</option>
                                    <option value="10008">เทคโนโลยีสารสนเทศ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="tel">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" name="tel" id="tel" placeholder="Enter Telephone number">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email">
                            </div>
                        </div>
                    </div>

                    <input type="text" name="status" value="nisit" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right" type="submit" id="btnSubmitAdd">Add Student</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Add USER Teacher-->
<div class="modal fade" id="addUserTeacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLongTitle">Add Teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="<?php echo base_url('admin/addUserTeacher'); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id-teacher">ID Teacher</label>
                                <input type="text" class="form-control" name="id-teacher" id="id-teacher" placeholder="Enter ID" required>
                            </div>

                            <div class="form-group">
                                <label for="password-tea">Password</label>
                                <input type="password " class="form-control password4" name="password-tea" id="password-tea" placeholder="Enter Password" required>
                            </div>

                            <div class="form-group">
                                <label for="repassword-tea">Re-Password</label>
                                <input type="password " class="form-control repassword4" name="repassword-tea" id="repassword-tea" placeholder="Enter Re-Password" required>
                                <div class="" id="validate-status22"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name-thai">Name thai</label>
                                <input type="text" class="form-control" name="name-thai" id="name-thai" placeholder="Enter Name thai" required>
                            </div>
                            <div class="form-group">
                                <label for="name-eng">Name Eng</label>
                                <input type="text" class="form-control" name="name-eng" id="name-eng" placeholder="Enter Name Eng" required>
                            </div>
                        </div>
                    </div>

                    <input type="text" name="status" value="teacher" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right btn-submit-ok" type="submit" id="btnSubmitAdd2">Add Teacher</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Edit USER Teacher-->
<div class="modal fade" id="editUserTeacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Edit Teacher</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="<?php echo base_url('admin/editUserTeacher'); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id-teacher-edit">ID Teacher</label>
                                <input type="text" name="id-teacher-old-edit" hidden>
                                <input type="text" class="form-control" name="id-teacher-edit" id="id-teacher-edit" placeholder="Enter ID" required>
                            </div>

                            <div class="form-group">
                                <label for="password-tea-edit">Password</label>
                                <input type="text" name="password-old-tea-edit" hidden>
                                <input type="password" class="form-control password4" name="password-tea-edit" id="password-tea-edit" placeholder="Enter New Password">
                            </div>

                            <div class="form-group">
                                <label for="repassword-tea-edit">Re-New Password</label>
                                <input type="password" class="form-control repassword4" name="repassword-tea-edit" id="repassword-tea-edit" placeholder="Enter New Re-Password">
                                <div class="" id="validate-status224"></div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name-thai-edit">Name thai</label>
                                <input type="text" class="form-control" name="name-thai-edit" id="name-thai-edit" placeholder="Enter Name thai" required>
                            </div>
                            <div class="form-group">
                                <label for="name-eng-edit">Name Eng</label>
                                <input type="text" class="form-control" name="name-eng-edit" id="name-eng-edit" placeholder="Enter Name Eng" required>
                            </div>
                        </div>
                    </div>

                    <input type="text" name="status-tc-edit" value="teacher" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-success float-right btn-submit-ok" type="submit" id="btnSubmitAdd3">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Add USER Staff-->
<div class="modal fade" id="addUserStaff" tabindex="-1" role="dialog" aria-labelledby="xxx" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="xxx">Add Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="<?php echo base_url('admin/addUserStaff'); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id-staff">ID Staff</label>
                                <input type="text" class="form-control" name="id-staff" id="id-staff" placeholder="Enter ID" required>
                            </div>

                            <div class="form-group">
                                <label for="password-staff">Password</label>
                                <input type="password" class="form-control password" name="password-staff" id="password-staff" placeholder="Enter Password" required>
                            </div>

                            <div class="form-group">
                                <label for="repassword-staff">Re-Password</label>
                                <input type="password" class="form-control repassword" name="repassword-staff" id="repassword-staff" placeholder="Enter Re-Password" required>
                                <div class="" id="validate-status2"></div>
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="form-group">
                                <label for="title-staff">คำนำหน้า</label>
                                <select class="custom-select" id="title-staff" name="title-staff" required>
                                    <option value="" selected>-- เลือก --</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name-staff">ชื่อ</label>
                                <input type="text" class="form-control" name="name-staff" id="name-staff" placeholder="Enter Name" required>
                            </div>


                            <div class="form-group">
                                <label for="surname-staff">นามสกุล</label>
                                <input type="text" class="form-control" name="surname-staff" id="surname-staff" placeholder="Enter Surname" required>
                            </div>
                        </div>
                    </div>

                    <input type="text" name="status" value="staff" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right btn-submit-ok" type="submit">Add Staff</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Edit USER Staff-->
<div class="modal fade" id="editUserStaff" tabindex="-1" role="dialog" aria-labelledby="xxx" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black" id="xxx">Edit Staff</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="<?php echo base_url('admin/editUserStaff'); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="id-staff-edit">ID Staff</label>
                                <input type="text" name="id-staff-old" hidden>
                                <input type="text" class="form-control" name="id-staff-edit" id="id-staff-edit" placeholder="Enter ID" required>
                            </div>

                            <div class="form-group">
                                <label for="password-staff-edit">Password</label>
                                <input type="password" name="password-staff-old" hidden>
                                <input type="password" class="form-control password" name="password-staff-edit" id="password-staff-edit" placeholder="Enter Password">
                            </div>

                            <div class="form-group">
                                <label for="repassword-staff-edit">Re-Password</label>
                                <input type="password" class="form-control repassword" name="repassword-staff-edit" id="repassword-staff-edit" placeholder="Enter Re-Password">
                                <div class="" id="validate-status2"></div>
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="form-group">
                                <label for="title-staff-edit">คำนำหน้า</label>
                                <select class="custom-select" id="title-staff-edit" name="title-staff-edit">
                                    <option value="" selected>-- เลือก --</option>
                                    <option value="นาย">นาย</option>
                                    <option value="นาง">นาง</option>
                                    <option value="นางสาว">นางสาว</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="name-staff-edit">ชื่อ</label>
                                <input type="text" class="form-control" name="name-staff-edit" id="name-staff-edit" placeholder="Enter Name" required>
                            </div>


                            <div class="form-group">
                                <label for="surname-staff-edit">นามสกุล</label>
                                <input type="text" class="form-control" name="surname-staff-edit" id="surname-staff-edit" placeholder="Enter Surname" required>
                            </div>
                        </div>
                    </div>

                    <input type="text" name="status" value="staff" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-success float-right btn-submit-ok" type="submit">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Add USER Admin-->
<div class="modal fade" id="addUserAdmin" tabindex="-1" role="dialog" aria-labelledby="xxx" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="xxx">Add Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="<?php echo base_url('admin/addUserAdmin'); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="username-admin">Username</label>
                                <input type="text" class="form-control" name="username-admin" id="username-admin" placeholder="Enter Username" required>
                            </div>

                            <div class="form-group">
                                <label for="password-admin">Password</label>
                                <input type="password" class="form-control password2" name="password-admin" id="password-admin" placeholder="Enter Password" required>
                            </div>

                            <div class="form-group">
                                <label for="repassword-admin">Re-Password</label>
                                <input type="password" class="form-control repassword2" name="repassword-admin" id="repassword-admin" placeholder="Enter Re-Password" required>
                                <div class="" id="validate-status22"></div>
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="form-group">
                                <label for="title-admin">คำนำหน้า</label>
                                <input type="text" class="form-control" id="title-admin" name="title-admin" placeholder="Enter title" required>

                            </div>

                            <div class="form-group">
                                <label for="name-admin">ชื่อ</label>
                                <input type="text" class="form-control" name="name-admin" id="name-admin" placeholder="Enter Name" required>
                            </div>


                            <div class="form-group">
                                <label for="surname-admin">นามสกุล</label>
                                <input type="text" class="form-control" name="surname-admin" id="surname-admin" placeholder="Enter Surname" required>
                            </div>
                        </div>
                    </div>

                    <input type="text" name="status-admin" value="admin" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary float-right btn-submit-ok" type="submit">Add Admin</button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- Modal Edit USER Admin-->
<div class="modal fade" id="editUserAdmin" tabindex="-1" role="dialog" aria-labelledby="xxx" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-black" id="xxx">Edit Admin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="<?php echo base_url('admin/editUserAdmin'); ?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="username-admin-edit">Username</label>
                                <input type="text" name="id-admin" hidden>
                                <input type="text" class="form-control" name="username-admin-edit" id="username-admin-edit" placeholder="Enter Username" required>
                            </div>

                            <div class="form-group">
                                <label for="password-admin-edit">Password</label>
                                <input type="password" name="password-admin-old" hidden>
                                <input type="password" class="form-control password3" name="password-admin-edit" id="password-admin-edit" placeholder="Enter Password">
                            </div>

                            <div class="form-group">
                                <label for="repassword-admin-edit">Re-Password</label>
                                <input type="password" class="form-control repassword3" name="repassword-admin-edit" id="repassword-admin-edit" placeholder="Enter Re-Password">
                                <div class="" id="validate-status3"></div>
                            </div>
                        </div>
                        <div class="col-6">

                            <div class="form-group">
                                <label for="title-admin-edit">คำนำหน้า</label>
                                <input type="text" class="form-control" id="title-admin-edit" name="title-admin-edit" placeholder="Enter title" required>
                            </div>

                            <div class="form-group">
                                <label for="name-admin-edit">ชื่อ</label>
                                <input type="text" class="form-control" name="name-admin-edit" id="name-admin-edit" placeholder="Enter Name" required>
                            </div>


                            <div class="form-group">
                                <label for="surname-admin-edit">นามสกุล</label>
                                <input type="text" class="form-control" name="surname-admin-edit" id="surname-admin-edit" placeholder="Enter Surname" required>
                            </div>
                        </div>
                    </div>

                    <input type="text" name="status-admin-edit" value="staff" hidden>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-success float-right btn-submit-ok" type="submit">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>