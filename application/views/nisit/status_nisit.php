<?php
defined('BASEPATH') or exit('No direct script access allowed');

// print_r($reg_info[0]['status']);
// $post = $this->Post_model->fetch_post($data['reg_info'][0]['id_post']); //fetch all post in id_user
// $subject = $this->Subject_model->fetch_subject($post[0]['id_subject']);
// $teacher = $this->Teacher_model->fetch_teacher($post[0]['id_teacher']);
?>

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">สถานะ การสมัครเป็นนิสิตช่วยสอน</h1>
    <p class="mb-4">แสดงสถานะ การสมัครเป็นนิสิตช่วยสอนในรายวิชาต่างๆ</p>
    <!-- ./ Page Heading -->

    <!-- Flex box -->
    <div style="display: flex; flex-wrap: wrap; align-items: flex-start;">
        <?php
        foreach ($reg_info as $reg) {
            $post = $this->Post_model->fetch_post_join($reg['post_id']); //fetch all post in id_user
            //$subject = $this->Subject_model->fetch_subject($post[0]['id_subject']);
            //$teacher = $this->Teacher_model->fetch_teacher($post[0]['id_teacher']);


            // WAIT
            if ($reg['reg_status'] == 'wait') {
        ?>
                <!-- Status WAIT -->

                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <div class="h2 font-weight-bold text-primary mr-4"><?= $post[0]['sj_id']; ?></div>
                                    <div class="h5 text-primary mr-4">
                                        <div><?= $post[0]['sj_name_eng']; ?></div>
                                        <div><?= $post[0]['sj_name_thai']; ?></div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="h5 font-weight-bold text-center text-light bg-warning" style="position: relative; border-radius: 50%; width:100px; height:100px;">
                                        <div style="margin: 0; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);">
                                            รอ<br>พิจารณา
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./ Status WAIT -->


            <?php
            } elseif ($reg['reg_status'] == 'allow') { ?>

                <!-- Status Allow -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <div class="h2 font-weight-bold text-primary mr-4"><?= $post[0]['sj_id']; ?></div>
                                    <div class="h5 text-primary mr-4">
                                        <div><?= $post[0]['sj_name_eng']; ?></div>
                                        <div><?= $post[0]['sj_name_thai']; ?></div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="h4 font-weight-bold text-center text-light bg-success" style="position: relative; border-radius: 50%; width:100px; height:100px;">
                                        <div style="margin: 0; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);">
                                            ผ่าน
                                            <hr class="m-0 p-0 bg-light">
                                            <small><a href="<?= base_url('nisit/print/') . $reg['post_id'] ?>" target="_blank" class="text-gray-100 m-0 p-0">Print</a></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./ Status Allow -->
            <?php
            } elseif ($reg['reg_status'] == 'deny') { ?>
                <!--  Status Deny -->
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col">
                                    <div class="h2 font-weight-bold text-primary mr-4"><?= $post[0]['sj_id']; ?></div>
                                    <div class="h5 text-primary mr-4">
                                        <div><?= $post[0]['sj_name_eng']; ?></div>
                                        <div><?= $post[0]['sj_name_thai']; ?></div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <div class="h5 font-weight-bold text-center text-light bg-danger" style="position: relative; border-radius: 50%; width:100px; height:100px;">
                                        <div style="margin: 0; position: absolute; top: 50%; left: 50%; margin-right: -50%; transform: translate(-50%, -50%);">
                                            ไม่ผ่าน<br>การคัดเลือก
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ./ Status Deny -->

        <?php
            } //end if else
        } //end for
        ?>
    </div>
    <!-- ./ flex box -->

    <?php
    if ($reg_info == null) {
    ?>
        <div class="text-center">
            <h1 class="mt-5 pt-3 text-primary">คุณยังไม่ได้ลงทะเบียน</h1>
            <a href="<?= base_url('nisit') ?>"><button class="btn btn-primary btn-lg mt-2">ลงทะเบียนเลย</button></a>
        </div>
    <?php
    }
    ?>
</div>
<!-- ./ Page Content -->