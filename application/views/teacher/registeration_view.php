<?php
defined('BASEPATH') or exit('No direct script access allowed');

$post = $this->Post_model->fetch_post_join($reg_info[0]['post_id']); //fetch all post in id_user

// print_r('<pre>');
// print_r($post);
// print_r('</pre>');
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">ข้อมูลผู้สมัครเป็นนิสิตช่วยสอน</h1>
    <p class="mb-0">รหัสวิชา <?= $post[0]['sj_id']; ?></p>
    <p class="mb-0">ชื่อวิชา <?= $post[0]['sj_name_thai']; ?></p>
    <p class="mb-4">ผู้สอน <?= $post[0]['tc_name_thai']; ?></p>


    <!-- ./ Page Heading -->

    <!-- Flex box -->
    <div style="display: flex; flex-wrap: wrap; align-items: flex-start;">
        <?php
        $i = 1;
        foreach ($reg_info as $reg) {
            $nisit = $this->User_model->fetch_user_id_st($reg['st_id']);
            // print_r('<pre>');
            // print_r($nisit);
            // print_r('</pre>');
        ?>
            <!-- Nisit info -->
            <div class="col-xl-6 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto text-center mr-4">
                                <div class="h4 font-weight-bold text-center text-light bg-primary" style="position: relative; border-radius: 50%; width:50px; height:50px;">
                                    <div style="margin: 0; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);">
                                        <?= $i++; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="h2 font-weight-bold text-primary mr-4"><?= $nisit[0]['st_title'] . $nisit[0]['st_name'] . " " . $nisit[0]['st_surname']; ?></div>
                                <div class="h5 text-primary mr-4">
                                    <div>ชั้นปีที่ <?= (Date('Y') + 543) - $nisit[0]['st_year']; ?></div>
                                    <div>สาขา <?= $nisit[0]['maj_name']; ?></div>

                                    <div>เกรดในรายวิชา : <?= $reg['reg_grade']; ?></div>
                                    <div>เกรดเฉลี่ยรวม : <?= number_format($nisit[0]['st_gpax'], 2, '.', ''); ?></div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <?php
                                if ($reg['reg_status'] == "deny") { ?>
                                    <div class="m-1">
                                        <a class="btn btn-sm btn-success btn-circle btn-lg" data-tooltip="tooltip" data-placement="right" title="ยอมรับเป็นนิสิตช่วยสอน!" href="#correct" data-href="<?= base_url('teacher/change_status_reg/') . $reg['reg_id'] . "/allow/" . $reg['post_id']; ?>" data-toggle="modal" data-target="#confirmStatusNisitAllow">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    </div>
                                <?php
                                }

                                if ($reg['reg_status'] == "allow") { ?>
                                    <div class="m-1">
                                        <a class="btn btn-sm btn-success btn-circle" data-tooltip="tooltip" data-placement="right" title="ยอมรับเป็นนิสิตช่วยสอน!" href="#correct" data-href="<?= base_url('teacher/change_status_reg/') . $reg['reg_id'] . "/allow/" . $reg['post_id']; ?>" data-toggle="modal" data-target="#confirmStatusNisitAllow">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    </div>
                                    <div class="m-1">
                                        <a class="btn btn-sm btn-danger btn-circle" data-tooltip="tooltip" data-placement="right" title="ไม่ยอมรับเป็นนิสิตช่วยสอน!" href="#notcorrect" data-href="<?= base_url('teacher/change_status_reg/') . $reg['reg_id'] . "/deny/" . $reg['post_id']; ?>" data-toggle="modal" data-target="#confirmStatusNisitDeny">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                    <div class="m-1">
                                        <a class="btn btn-sm btn-info btn-circle" data-tooltip="tooltip" data-placement="right" title="ปริ้นใบสมัคร" target="_blank" href="<?= base_url('teacher/print/') . $reg['post_id']; ?>">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </div>
                                <?php
                                }
                                ?>

                                <?php
                                if ($reg['reg_status'] == "wait") { ?>
                                    <div class="m-1">
                                        <a class="btn btn-sm btn-success btn-circle btn-lg" data-tooltip="tooltip" data-placement="right" title="ยอมรับเป็นนิสิตช่วยสอน!" href="#correct" data-href="<?= base_url('teacher/change_status_reg/') . $reg['reg_id'] . "/allow/" . $reg['post_id']; ?>" data-toggle="modal" data-target="#confirmStatusNisitAllow">
                                            <i class="fas fa-check"></i>
                                        </a>
                                    </div>
                                    <div class="m-1">
                                        <a class="btn btn-sm btn-danger btn-circle btn-lg" data-tooltip="tooltip" data-placement="right" title="ไม่ยอมรับเป็นนิสิตช่วยสอน!" href="#notcorrect" data-href="<?= base_url('teacher/change_status_reg/') . $reg['reg_id'] . "/deny/" . $reg['post_id']; ?>" data-toggle="modal" data-target="#confirmStatusNisitDeny">
                                            <i class="fas fa-times"></i>
                                        </a>
                                    </div>
                                <?php
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./ Nisit info -->

        <?php
        } //end for
        ?>
    </div>
    <!-- ./ flex box -->

    <?php
    if ($reg_info == null) {
    ?>
        <div class="text-center">
            <h1 class="mt-5 pt-3 text-primary">ยังไม่มีการลงทะเบียน</h1>
        </div>
    <?php
    }
    ?>
</div>
<!-- ./ Page Content -->

<!-- Modal change status reg nisit -->
<div class="modal fade" id="confirmStatusNisitAllow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeLabel">ตรวจสอบความถูกต้อง</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <p class="debug-url"></p>
                    <p>คุณแน่ใจที่จะ "รับ" นิสิตรายนี้เป็นนิสิตช่วยสอนใช่หรือไม่?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ไม่</button>
                <a class="btn btn-success text-white btn-ok">ใช่, ฉันแน่ใจ</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal change status reg nisit -->
<div class="modal fade" id="confirmStatusNisitDeny" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeLabel">ตรวจสอบความถูกต้อง</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    <p class="debug-url"></p>
                    <p>คุณแน่ใจที่จะ "ไม่รับ" นิสิตรายนี้เป็นนิสิตช่วยสอนใช่หรือไม่?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">ไม่</button>
                <a class="btn btn-success text-white btn-ok">ใช่, ฉันแน่ใจ</a>
            </div>
        </div>
    </div>
</div>