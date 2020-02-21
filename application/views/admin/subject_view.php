<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Subject</h1>
    <p class="mb-4">This page show information about Subject.</p>

    <!-- Content flex Count-->
    <div class="d-flex justify-content-between">

        <!-- User count -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Subjects</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $count_subject; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4" data-toggle="modal" data-target="#addSubject" style="cursor:pointer;">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="h5 mb-0 font-weight-bold text-gray-800">เพิ่มรายวิชา</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-plus-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ./ User count -->
    </div>
    <!-- Content flex Count -->


    <!-- Content Row Card -->
    <div class="row">

        <!-- Table col 12 -->
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Subject Table</h6>
                </div>

                <div class="card-body">
                    <div class="text-right mb-2">
                        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#addSubject"><i class="fas fa-plus-circle"></i> เพิ่มรายวิชา</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>รหัสวิชา</th>
                                    <th>ชื่อวิชา(ไทย)</th>
                                    <th>ชื่อวิชา(อังกฤษ)</th>
                                    <th>คำอธิบายรายวิชา(ไทย)</th>
                                    <th>คำอธิบายรายวิชา(อังกฤษ)</th>
                                    <th>หน่วยกิจ</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $subjects = $this->Subject_model->fetchAll_subject_arr();

                                $i = 1;
                                foreach ($subjects as $subject) {
                                ?>
                                    <tr>
                                        <td style="width: 2%; text-align: center;"><?= $i++; ?></td>
                                        <td><?php echo $subject['sj_id']; ?></td>
                                        <td><?php echo $subject['sj_name_thai']; ?></td>
                                        <td><?php echo $subject['sj_name_eng']; ?></td>
                                        <td><?php echo $subject['sj_des_thai']; ?></td>
                                        <td><?php echo $subject['sj_des_eng']; ?></td>
                                        <td><?php echo $subject['sj_credit']; ?></td>
                                        <td style="width:  8.33%">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Action
                                            </button>
                                            <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                                <button class="dropdown-item" id="editSubjectBtn" data-id="<?php echo $subject['sj_id']; ?>" data-idSubject="<?php echo $subject['sj_id']; ?>" data-nameThai="<?php echo $subject['sj_name_thai']; ?>" data-nameEng="<?php echo $subject['sj_name_eng']; ?>" data-desThai="<?php echo $subject['sj_des_thai']; ?>" data-desEng="<?php echo $subject['sj_des_eng']; ?>" data-credit="<?php echo $subject['sj_credit']; ?>" data-toggle="modal" data-target="#editSubject">Edit</button>
                                                <button class="dropdown-item" id="removeSubjectBtn" data-href="<?php echo base_url('admin/removeSubject/') . $subject['sj_id']; ?>" data-toggle="modal" data-target="#confirm-delete-subject">Remove</button>
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
</div>
<!-- /.container-fluid -->





<!-- MODEL -->

<!-- Modal Remove Subject-->
<div class="modal fade" id="confirm-delete-subject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

<!-- Modal EDIT Subject-->
<div class="modal fade" id="editSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">แก้ไขรายวิชา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="<?= base_url('admin/update_subject') ?>">
                <div class="modal-body">
                    <div class="form-row">
                        <input type="text" id="id_edit" name="id_edit" value="" hidden>
                        <div class="form-group col-md-6">
                            <label for="id_subject_edit">รหัสวิชา</label>
                            <input type="text" pattern="\d*" class="form-control" name="id_subject_edit" id="id_subject_edit" maxlength="6" required readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="credit_edit">หน่วยกิจ</label>
                            <input type="text" class="form-control" name="credit_edit" id="credit_edit" placeholder="3(2-2-5)" maxlength="8" required>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name_subject_thai_edit">ชื่อวิชา (ภาษาไทย)</label>
                            <input type="text" class="form-control" name="name_subject_thai_edit" id="name_subject_thai_edit" placeholder="การโปรแกรมมิ่งบนอินเทอร์เน็ต" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name_subject_eng_edit">ชื่อวิชา (ภาษาอังกฤษ)</label>
                            <input type="text" class="form-control" name="name_subject_eng_edit" id="name_subject_eng_edit" placeholder="Internet Programming" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="description_thai_edit">คำอธิบายรายวิชา (ภาษาไทย)</label>
                            <textarea type="text" class="form-control" name="description_thai_edit" id="description_thai_edit" rows="6" required></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="description_eng_edit">คำอธิบายรายวิชา (ภาษาอังกฤษ)</label>
                            <textarea type="text" class="form-control" name="description_eng_edit" id="description_eng_edit" rows="6" required></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                    <button class="btn btn-success float-right" type="submit" id="btnSubmitEditSubject">บันทึก</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- ./ Modal EDIT Subject-->

<!-- Modal ADD Subject -->
<div class="modal fade" id="addSubject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary" id="exampleModalLongTitle">เพิ่มรายวิชา</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="<?= base_url('admin/add_subject') ?>">
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="id_subject">รหัสวิชา</label>
                            <input type="text" pattern="\d*" class="form-control" name="id_subject" id="id_subject" placeholder="254xxx" maxlength="6" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="credit">หน่วยกิจ</label>
                            <input type="text" class="form-control" name="credit" id="credit" placeholder="3(2-2-5)" maxlength="8" required>
                        </div>

                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name_subject_thai">ชื่อวิชา (ภาษาไทย)</label>
                            <input type="text" class="form-control" name="name_subject_thai" id="name_subject_thai" placeholder="การโปรแกรมมิ่งบนอินเทอร์เน็ต" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name_subject_eng">ชื่อวิชา (ภาษาอังกฤษ)</label>
                            <input type="text" class="form-control" name="name_subject_eng" id="name_subject_eng" placeholder="Internet Programming" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="description_thai">คำอธิบายรายวิชา (ภาษาไทย)</label>
                            <textarea class="form-control" name="description_thai" id="description_thai" rows="6" required></textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="description_eng">คำอธิบายรายวิชา (ภาษาอังกฤษ)</label>
                            <textarea class="form-control" name="description_eng" id="description_eng" rows="6" required></textarea>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ปิด</button>
                    <button class="btn btn-success float-right" type="submit" id="btnSubmitAddSubject">เพิ่มรายวิชา</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- ./ Modal ADD Subject -->