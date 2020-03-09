<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<style>
    .cc {
        opacity: 1;
    }

    .cc:hover {
        opacity: 0.8;
        cursor: pointer;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">รายวิชา</h1>
    <p class="mb-4">หน้านี้แสดงรายอะเอียดการรับสมัครนิสิตช่วยสอน</p>

    <!-- Flex box -->
    <div style="display: flex; flex-wrap: wrap; align-items: flex-start;">

        <!-- Card Post -->
        <div class="col-md-4 mt-3 cc" data-toggle="modal" data-target="#addPost">
            <div class="card text-left pt-5 pb-5">
                <div class="card-body" id="card">
                    <div class="text-center">
                        <i class="card-title text-primary mb-2 mt-3 fas fa-plus-circle" style="font-size: 50px;"></i>
                        <h5 class="card-title font-weight-bold text-primary ">เพิ่มรายวิชา</h5>
                        <h5 class="card-title font-weight-bold text-primary mb-5">ที่รับสมัคร</h5>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./ Card Post -->

        <?php

        // print_r('<pre>');
        // print_r($posts);
        // print_r('</pre>');
        foreach ($posts as $post) {
            $url = $post['poif_url'];
            if ($post['poif_url'] == "-" or $post['poif_url'] == null) {
                $url = "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80";
            }
        ?>
            <!-- Card Subject -->
            <div class="col-md-4 mt-3">
                <div class="card text-left">
                    <img class="card-img-top" height="100" width="100%" style="object-fit: cover;" alt="<?= $post['sj_name_thai']; ?>" src="<?= $url; ?>">

                    <div class="card-body" id="card">
                        <div>
                            <h5 class="card-title font-weight-bold text-primary mb-1 mr-3"><?= $post['sj_id']; ?></h5>
                            <h5 class="card-title font-weight-bold text-primary mb-1"><?= $post['sj_name_thai']; ?></h5>
                        </div>

                        <div>
                            <!-- <p class="card-title card-text mb-2"><b>ผู้สอน</b> : <?= $post['tc_name_thai']; ?></p> -->
                            <div class="row">
                                <p class="card-title card-text mb-2 col-auto"><b>กลุ่มเรียน</b> : <?= $post['poif_section']; ?></p>
                                <p class="card-title card-text mb-2 col-auto"><b>ภาคเรียน</b> : <?= $post['poif_term'] . "/" . $post['poif_years']; ?></p>
                                <p class="card-title card-text mb-2 col-auto"><b>จำนวนนิสิต</b> : <?= $post['poif_num_st']; ?> คน</p>

                            </div>


                        </div>

                        <div>
                            <p class="card-title card-text mb-0 text-right">
                                <b>status</b> :
                                <?= ($post['post_status'] == "on") ? '<span class="badge badge-pill badge-success">Online</span>' : '<span class="badge badge-pill badge-danger">Offline</span>';
                                ?>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-4 text-left">
                                <?php
                                $count_reg_ta = $this->RegTa_model->chack_reg_count($post['post_id']);
                                if ($count_reg_ta) {
                                ?>
                                    <a class="btn btn-sm btn-info text-left" href="<?= base_url($this->session->userdata('status') . '/registeration/') . $post['post_id']; ?>">ดูรายชื่อ</a>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-8 text-right">
                                <?php
                                if ($post['post_status'] == "on") {
                                ?>
                                    <a class="btn btn-sm text-white btn-danger" href="#on" data-href="<?= base_url($this->session->userdata('status') . '/change_status_post/') . $post['post_id'] . "/off"; ?>" data-toggle="modal" data-target="#confirmOnOff">off</a>
                                <?php
                                } else {
                                ?>
                                    <a class="btn btn-sm text-white btn-success" href="#off" data-href="<?= base_url($this->session->userdata('status') . '/change_status_post/') . $post['post_id'] . "/on"; ?>" data-toggle="modal" data-target="#confirmOnOff">on</a>
                                <?php
                                }
                                ?>
                                <a class="btn btn-sm btn-warning" href="#edit" data-idpost="<?= $post['post_id']; ?>" data-idsubinfo="<?= $post['poif_id']; ?>" data-idsubject="<?= $post['sj_id']; ?>" data-sec="<?= $post['poif_section']; ?>" data-term="<?= $post['poif_term']; ?>" data-years="<?= $post['poif_years']; ?>" data-teacherid="<?= $post['tc_id']; ?>" data-daywork="<?= $post['poif_daywork']; ?>" data-timeworkstart="<?= $post['poif_timework_start']; ?>" data-timeworkend="<?= $post['poif_timework_end']; ?>" data-workstart="<?= $post['poif_work_start']; ?>" data-workend="<?= $post['poif_work_end']; ?>" data-nisitnum="<?= $post['poif_num_st']; ?>" data-url="<?= $post['poif_url']; ?>" data-quali="<?= $post['post_qualification']; ?>" data-status="<?= $post['post_status']; ?>" data-toggle="modal" data-target="#updatePost"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-sm btn-danger" href="#remove" data-href="<?= base_url($this->session->userdata('status') . '/remove_post/') . $post['post_id'] . "/" . $post['poif_id']; ?>" data-toggle="modal" data-target="#confirm-delete-post"><i class="fas fa-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./Card Subject -->
        <?php
        } //end for
        ?>

    </div>
    <!-- ./Flex box -->

    <!-- Content Row Card -->
    <div class="row mt-4 m-1">
        <!-- Table col 8 -->
        <div class="col-lg-12">
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">รายวิชาที่รับสมัคร</h6>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="text-center">
                                    <th>ID</th>
                                    <th>รหัสวิชา</th>
                                    <th class="text-left">ชื่อวิชา</th>
                                    <th>กลุ่มเรียน</th>
                                    <th>ภาคเรียน</th>
                                    <th>สถานะ</th>
                                    <th>ผู้สมัคร</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;

                                foreach ($posts as $post) {

                                ?>
                                    <tr class="text-center">
                                        <td style="width: 2%; text-align: center;"><?= $i++; ?></td>
                                        <td><?php echo $post['sj_id']; ?></td>
                                        <td class="text-left"><?php echo $post['sj_name_thai']; ?></td>
                                        <td><?php echo $post['poif_section']; ?></td>
                                        <td><?php echo $post['poif_term'] . "/" . $post['poif_years']; ?></td>
                                        <td><?php echo $post['post_status']; ?>line</td>
                                        <td class="text-left">
                                            <?php
                                            $id_nisit_reg = $this->RegTa_model->fatch_idNisit($post['post_id']);
                                            if (empty($id_nisit_reg)) {
                                                echo "-";
                                            } else {
                                                echo "<ul style='padding-left: 15px;'>";
                                                foreach ($id_nisit_reg as $idNisit) {
                                                    $user = $this->User_model->fetch_user_id_st($idNisit['st_id']);
                                                    echo "<li>" . $user[0]['st_title'] . $user[0]['st_name'] . $user[0]['st_surname'] . "<br>";
                                                }
                                                echo "</ul>";
                                            }
                                            ?>

                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Table -->
    </div>
    <!-- ./Content Row Card -->


</div>
<!-- ./Begin Page Content -->


<!-- Modal ADD Subject -->
<div class="modal fade" id="addPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLongTitle">เพิ่มรายวิชาที่รับสมัคร</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="<?= base_url('teacher/add_post') ?>">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_subject">รายวิชา</label>
                            <select class="form-control" name="id_subject" id="id_subject" required>
                                <option value="" disabled selected>-- เลือกรายวิชา --</option>
                                <?php
                                $subjects = $this->Subject_model->fetchAll_subject_arr();
                                foreach ($subjects as $subject) { ?>
                                    <option value="<?= $subject['sj_id']; ?>"> <?= $subject['sj_id'] . ' - ' . $subject['sj_name_thai']; ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="sec">กลุ่มเรียน</label>
                            <select class="form-control" name="sec" id="sec" required>
                                <option value="" disabled selected>เลือก</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="term">ภาคเรียน</label>
                            <select class="form-control" name="term" id="term" required>
                                <option value="" disabled selected>เลือก</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="years">ปีการศึกษา</label>
                            <select class="form-control" name="years" id="years" required>
                                <option value="" disabled selected>เลือก</option>
                                <?php
                                $year =  (date("Y") + 543) - 2;
                                for ($x = 0; $x <= 5; $x++) { ?>
                                    <option value="<?= $year + $x; ?>"><?= $year + $x; ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_teacher">ผู้สอน</label>
                            <select class="form-control" required disabled="true">
                                <option value="" disabled>-- เลือกผู้สอน --</option>
                                <?php
                                $teachers = $this->Teacher_model->fetchAll_teacher_arr();
                                foreach ($teachers as $teacher) { ?>
                                    <option value="<?= $teacher['tc_id']; ?>" <?= ($this->session->userdata('login_id') == $teacher['tc_id']) ? "selected" : ""; ?>> <?= $teacher['tc_id'] . ' - ' . $teacher['tc_name_thai']; ?></option>
                                <?php
                                } ?>
                            </select>
                            <input type="text" name="id_teacher" id="id_teacher" value="<?= $this->session->userdata('login_id'); ?>" hidden>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name_subject_thai">วันที่ปฏิบัติงาน</label>
                            <div class="form-check form-check-inline mb-2">
                                <div class="custom-control custom-checkbox mr-sm-2 ml-sm-1">
                                    <input type="radio" class="custom-control-input" id="check_list_mon" name="check_list" value="Monday" required checked>
                                    <label class="custom-control-label" for="check_list_mon">จันทร์</label>
                                    </input>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2 ml-2">
                                    <input type="radio" class="custom-control-input" id="check_list_tues" name="check_list" value="Tuesday">
                                    <label class="custom-control-label" for="check_list_tues">อังคาร</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2 ml-2">
                                    <input type="radio" class="custom-control-input" id="check_list_wed" name="check_list" value="Wednesday">
                                    <label class="custom-control-label" for="check_list_wed">พุธ</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2 ml-2">
                                    <input type="radio" class="custom-control-input" id="check_list_thurs" name="check_list" value="Thursday">
                                    <label class="custom-control-label" for="check_list_thurs">พฤหัสบ่ดี</label>
                                </div>
                            </div>


                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-checkbox mr-sm-2 ml-sm-1">
                                    <input type="radio" class="custom-control-input" id="check_list_fri" name="check_list" value="Friday">
                                    <label class="custom-control-label" for="check_list_fri">ศุกร์</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2 ml-2">
                                    <input type="radio" class="custom-control-input" id="check_list_sat" name="check_list" value="Saturday">
                                    <label class="custom-control-label" for="check_list_sat">เสาร์</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2 ml-2">
                                    <input type="radio" class="custom-control-input" id="check_list_sun" name="check_list" value="Sunday">
                                    <label class="custom-control-label" for="check_list_sun">อาทิตย์</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="time-work-start">เวลาเริ่มต้นในการปฏิบัติงาน</label>

                            <div class="input-group date" id="time-start" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="time-work-start" id="time-work-start" data-target="#time-start" required />
                                <div class="input-group-append" data-target="#time-start" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="time-work-end">เวลาสิ้นสุดในการปฏิบัติงาน</label>

                            <div class="input-group date" id="time-end" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="time-work-end" id="time-work-end" data-target="#time-end" required />
                                <div class="input-group-append" data-target="#time-end" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="work-start">ระยะเวลาเริ่มต้นในการปฏิบัติงาน</label>
                            <div class="input-group date" id="work-st" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="work-start" id="work-start" data-target="#work-st" required />
                                <div class="input-group-append" data-target="#work-st" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="work-end">ระยะเวลาสิ้นสุดในการปฏิบัติงาน</label>
                            <div class="input-group date" id="work-en" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="work-end" id="work-end" data-target="#work-en" required />
                                <div class="input-group-append" data-target="#work-en" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="num-nisit">จำนวนนิสิต</label>
                                <input type="number" class="form-control" name="num-nisit" id="num-nisit" placeholder="จำนวนนิสิตที่ลงทะเบียน" required>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="url">Url รูปภาพที่ต้องการแสดง</label>
                                <input type="text" class="form-control" name="url" id="url" placeholder="Url รูปภาพ">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="qualification">คุณสมบัติเพิ่มเติม</label>
                        <textarea type="text" class="form-control" name="qualification" id="qualification" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="status">สถานะ</label>
                        <select class="form-control" name="status" id="status">
                            <option value="on" selected>ONLINE</option>
                            <option value="off">OFFLINE</option>
                        </select>
                    </div>
                </div>
                <!-- End content -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                    <button class="btn btn-success float-right" type="submit" id="btnSubmitAddSubject">เพิ่มรายวิชา</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- ./ Modal ADD Subject -->



<!-- Modal UPDATE Subject -->
<div class="modal fade" id="updatePost" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLongTitle">แก้ไขรายวิชาที่รับสมัคร</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="<?= base_url('teacher/update_post') ?>">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_subject_update">รายวิชา</label>
                            <input type="text" name="id_post_update" hidden>
                            <input type="text" name="id_subinfo_update" hidden>

                            <select class="form-control" name="id_subject_update" id="id_subject_update" required>
                                <option value="" disabled selected>-- เลือกรายวิชา --</option>
                                <?php
                                $subjects = $this->Subject_model->fetchAll_subject_arr();
                                foreach ($subjects as $subject) { ?>
                                    <option value="<?= $subject['sj_id']; ?>"> <?= $subject['sj_id'] . ' - ' . $subject['sj_name_thai']; ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="sec_update">กลุ่มเรียน</label>
                            <select class="form-control" name="sec_update" id="sec_update" required>
                                <option value="" disabled selected>เลือก</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="term_update">ภาคเรียน</label>
                            <select class="form-control" name="term_update" id="term_update" required>
                                <option value="" disabled selected>เลือก</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="years_update">ปีการศึกษา</label>
                            <select class="form-control" name="years_update" id="years_update" required>
                                <option value="" disabled selected>เลือก</option>
                                <?php
                                $year =  (date("Y") + 543) - 2;
                                for ($x = 0; $x <= 5; $x++) { ?>
                                    <option value="<?= $year + $x; ?>"><?= $year + $x; ?></option>
                                <?php
                                } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_teacher_update">ผู้สอน</label>
                            <select class="form-control" required disabled="true">
                                <option value="" disabled selected>-- เลือกผู้สอน --</option>
                                <?php
                                $teachers = $this->Teacher_model->fetchAll_teacher_arr();
                                foreach ($teachers as $teacher) { ?>
                                    <option value="<?= $teacher['tc_id']; ?>" <?= ($this->session->userdata('login_id') == $teacher['tc_id']) ? "selected" : ""; ?>> <?= $teacher['tc_id'] . ' - ' . $teacher['tc_name_thai']; ?></option>
                                <?php
                                } ?>
                            </select>
                            <input type="text" name="id_teacher_update" id="id_teacher_update" value="<?= $this->session->userdata('login_id'); ?>" hidden>

                        </div>

                        <div class="form-group col-md-6">
                            <label for="check_list_update">วันที่ปฏิบัติงาน</label>
                            <div class="form-check form-check-inline mb-2">
                                <div class="custom-control custom-checkbox mr-sm-2 ml-sm-1">
                                    <input type="radio" class="custom-control-input" id="check_list_mon" name="check_list_update" value="Monday" required>
                                    <label class="custom-control-label" for="check_list_mon">จันทร์</label>
                                    </input>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2 ml-2">
                                    <input type="radio" class="custom-control-input" id="check_list_tues" name="check_list_update" value="Tuesday">
                                    <label class="custom-control-label" for="check_list_tues">อังคาร</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2 ml-2">
                                    <input type="radio" class="custom-control-input" id="check_list_wed" name="check_list_update" value="Wednesday">
                                    <label class="custom-control-label" for="check_list_wed">พุธ</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2 ml-2">
                                    <input type="radio" class="custom-control-input" id="check_list_thurs" name="check_list_update" value="Thursday">
                                    <label class="custom-control-label" for="check_list_thurs">พฤหัสบ่ดี</label>
                                </div>
                            </div>


                            <div class="form-check form-check-inline">
                                <div class="custom-control custom-checkbox mr-sm-2 ml-sm-1">
                                    <input type="radio" class="custom-control-input" id="check_list_fri" name="check_list_update" value="Friday">
                                    <label class="custom-control-label" for="check_list_fri">ศุกร์</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2 ml-2">
                                    <input type="radio" class="custom-control-input" id="check_list_sat" name="check_list_update" value="Saturday">
                                    <label class="custom-control-label" for="check_list_sat">เสาร์</label>
                                </div>
                                <div class="custom-control custom-checkbox mr-sm-2 ml-2">
                                    <input type="radio" class="custom-control-input" id="check_list_sun" name="check_list_update" value="Sunday">
                                    <label class="custom-control-label" for="check_list_sun">อาทิตย์</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="time-work-start-update">เวลาเริ่มต้นในการปฏิบัติงาน</label>

                            <div class="input-group date" id="time-start-update" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="time-work-start-update" id="time-work-start-update" data-target="#time-start" required />
                                <div class="input-group-append" data-target="#time-start-update" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="time-work-end-update">เวลาสิ้นสุดในการปฏิบัติงาน</label>

                            <div class="input-group date" id="time-end-update" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="time-work-end-update" id="time-work-end-update" data-target="#time-end" required />
                                <div class="input-group-append" data-target="#time-end-update" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fas fa-clock"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="work-start-update">ระยะเวลาเริ่มต้นในการปฏิบัติงาน</label>
                            <div class="input-group date" id="work-st-update" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="work-start-update" id="work-start-update" data-target="#work-st" required />
                                <div class="input-group-append" data-target="#work-st-update" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="work-end-update">ระยะเวลาสิ้นสุดในการปฏิบัติงาน</label>
                            <div class="input-group date" id="work-en-update" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" name="work-end-update" id="work-end-update" data-target="#work-en" required />
                                <div class="input-group-append" data-target="#work-en-update" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="num-nisit-update">จำนวนนิสิต</label>
                                <input type="number" class="form-control" name="num-nisit-update" id="num-nisit-update" placeholder="จำนวนนิสิตที่ลงทะเบียน" required>
                            </div>
                        </div>
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="url-update">Url รูปภาพที่ต้องการแสดง</label>
                                <input type="text" class="form-control" name="url-update" id="url-update" placeholder="Url รูปภาพ">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="qualification-update">คุณสมบัติเพิ่มเติม</label>
                        <textarea type="text" class="form-control" name="qualification-update" id="qualification-update" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="status-update">สถานะ</label>
                        <select class="form-control" name="status-update" id="status-update">
                            <option value="on" selected>ONLINE</option>
                            <option value="off">OFFLINE</option>
                        </select>
                    </div>
                </div>
                <!-- End content -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                    <button class="btn btn-success float-right" type="submit">บันทึก</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- ./ Modal UPDATE Subject -->



<!-- Modal confirm change on-off -->
<div class="modal fade" id="confirmOnOff" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeLabel">Change status subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <p class="debug-url"></p>
                    <p>Are you change status this subject?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                <a class="btn btn-success text-white btn-ok">Yes, Change.</a>
            </div>
        </div>
    </div>
</div>
<!-- ./ Modal confirm change on-off -->

<!-- Modal Remove Post -->
<div class="modal fade" id="confirm-delete-post" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeLabel">ลบรายวิชา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <p class="debug-url"></p>
                    <p>คุณต้องการที่จะลบรายวิชานี้ใช่หรือไม่?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                <a class="btn btn-danger btn-ok text-white">ใช่, ลบเลย</a>
            </div>
        </div>
    </div>
</div>
<!-- ./ Modal Remove Post -->