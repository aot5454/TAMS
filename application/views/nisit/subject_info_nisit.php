<?php
defined('BASEPATH') or exit('No direct script access allowed');

$url = $post[0]['poif_url'];
if ($post[0]['poif_url'] == null or $post[0]['poif_url'] == "-") {
    $url = "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80";
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="card">
        <img class="card-img-top" alt="<?= $post[0]['sj_name_thai']; ?>" height="200" width="100%" style="object-fit: cover;" src="<?= $url; ?>">

        <div class="card-body">
            <!-- Head Title -->
            <div>
                <i class="fas fa-laptop-code text-primary mr-3" style="font-size: 2em;"></i>
                <h2 class="d-inline card-title font-weight-bold text-primary mb-1 mr-3"><?= $post[0]['sj_id']; ?></h2>
                <h3 class="d-inline card-title font-weight-bold text-primary mb-1"><?= $post[0]['sj_name_thai']; ?></h3>
            </div>

            <div class="mt-4">
                <h4 class="text-primary">คำอธิบายรายวิชา</h4>
                <div class="p-2" style="background-color: #ddd;">
                    <p class="card-text text-dark">
                        &emsp;&emsp;&emsp;<?= $post[0]['sj_des_thai']; ?><br><br>
                        &emsp;&emsp;&emsp;<?= $post[0]['sj_des_eng']; ?>
                    </p>
                </div>
            </div>
            <!-- ./Head Title -->

            <!-- รายละเอียดวิชา -->
            <div class="mt-4">
                <h4 class="text-primary">รายละเอียดวิชา</h4>
                <div class="p-0" style="background-color: #ddd;">
                    <table class="table mb-0">
                        <tbody class="card-text text-dark">
                            <tr>
                                <th class="table-active">ชื่อวิชา</th>
                                <td class=""><?= $post[0]['sj_name_thai']; ?> (<?= $post[0]['sj_name_eng']; ?>)</td>
                            </tr>
                            <tr>
                                <th class="table-active">หน่วยกิต</th>
                                <td class=""><?= $post[0]['sj_credit']; ?></td>
                            </tr>
                            <tr>
                                <th class="table-active">กลุ่มเรียน</th>
                                <td class=""><?= $post[0]['poif_section']; ?></td>
                            </tr>
                            <tr>
                                <th class="table-active">ภาคเรียน</th>
                                <td class=""><?= $post[0]['poif_term']; ?></td>
                            </tr>
                            <tr>
                                <th class="table-active">ปีการศึกษา</th>
                                <td class=""><?= $post[0]['poif_years']; ?></td>
                            </tr>
                            <tr>
                                <th class="table-active">อาจารย์ผู้สอน</th>
                                <td class=""><?= $post[0]['tc_name_thai']; ?></td>
                            </tr>
                            <tr>
                                <th class="table-active">วันและเวลาสอน</th>
                                <td class="">
                                    <?= day_conv($post[0]['poif_daywork']); ?> เวลา : <?= $post[0]['poif_timework_start'] . " - " . $post[0]['poif_timework_end'] . " น."; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="table-active">วันเริ่ม-สิ้นสุด</th>
                                <td class="">

                                    <?= convDate($post[0]['poif_work_start']) . " ถึง " . convDate($post[0]['poif_work_end']); ?>

                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ./รายละเอียดวิชา -->

            <!-- คุณสมบัติ -->
            <div class="mt-4">
                <h4 class="text-primary">คุณสมบัติผู้สมัคร</h4>
                <div class="p-2" style="background-color: #ddd;">
                    <p class="card-text text-dark">
                        - นิสิตต้องเป็นผู้ที่เคยเรียนรายวิชา <?= $post[0]['sj_name_thai']; ?> มาแล้ว <br>
                        - GPA ไม่น้อยกว่า 2.00 <br>
                        - ผลการเรียนในรายวิชานี้ต้องไม่น้อยกว่า B+ <br>
                        <?php if ($post[0]['post_qualification'] == "" or $post[0]['post_qualification'] == "-") {
                        } else {
                            echo "- " . $post[0]['post_qualification'];
                        } ?>
                    </p>
                </div>
            </div>
            <!-- ./คุณสมบัติ -->

            <!-- ยืนยัน -->
            <div class="mt-4" style="text-align: center">
                <label class="label">
                    <input class="label__checkbox" type="checkbox" id="submitReg" name="submitReg" />
                    <span class="label__text">
                        <span class="label__check">
                            <i class="fa fa-check icon" style="font-size: 16px;"></i>
                        </span>
                    </span>
                </label>
                <label for="submitReg">ยอมรับเงื่อนไขการสมัคร</label>
            </div>

            <div class="mt-4" style="text-align: center">
                <a href="#modelReg"><button class="btn btn-primary btn-lg" id="btnSubmitReg" data-toggle="modal" data-target="#chackReg">สมัครเป็นนิสิตช่วยสอน</button></a>
            </div>
            <!-- ./ยืนยัน -->

        </div>
        <!-- /.card-body -->

    </div>
    <!-- /.card -->

</div>
<!-- /.container-fluid -->


<!-- SubmitReg Model -->
<div class="modal fade" id="chackReg" tabindex="-1" role="dialog" aria-labelledby="pro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pro">ยืนยันการสมัครนิสิตช่วยสอน</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="<?= base_url('nisit/reg_ta') ?>">
                <div class="modal-body">
                    <input type="hidden" name="post_id" value="<?= $post[0]['post_id']; ?>">
                    <input type="hidden" name="user_id" value="<?= $this->session->userdata('login_id'); ?>">
                    <div class="form-group">
                        <label for="gradeSubject">ผลการเรียนในรายวิชานี้</label>
                        <input type="text" class="form-control" name="gradeSubject" id="gradeSubject" placeholder="A-F" style="text-transform:uppercase" maxlength="2" required>
                        <small>ผลการเรียนนี้ จะนำไปพิจารณาในการคัดเลือกนิสิตช่วยสอนต่อไป <br></small>
                        <small>Tip : เมื่อยืนยันการสมัครแล้ว สามารถดูสถานะการสมัครได้ที่เมนู "สถานะการสมัคร"</small>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">ย้อนกลับ</button>
                    <button class="btn btn-primary float-right" type="submit" id="btnSubmitEdit">ยืนยัน</button>
                </div>
            </form>

        </div>
    </div>
</div>



<?php
function convDate($date)
{
    list($m, $d, $y) = explode("/", "$date");
    $y = ((int) $y) + 543;

    if ($m == "1") {
        $date = "$d มกราคม $y";
    } elseif ($m == "2") {
        $date = "$d กุมภาพันธ์ $y";
    } elseif ($m == "3") {
        $date = "$d มีนาคม $y";
    } elseif ($m == "4") {
        $date = "$d เมษายน $y";
    } elseif ($m == "5") {
        $date = "$d พฤษภาคม $y";
    } elseif ($m == "6") {
        $date = "$d มิถุนายน $y";
    } elseif ($m == "7") {
        $date = "$d กรกฎาคม $y";
    } elseif ($m == "8") {
        $date = "$d สิงหาคม $y";
    } elseif ($m == "9") {
        $date = "$d กันยายน $y";
    } elseif ($m == "10") {
        $date = "$d ตุลาคม $y";
    } elseif ($m == "11") {
        $date = "$d พฤศจิกายน $y";
    } else {
        $date = "$d ธันวาคม $y";
    }
    return "$date";
}

function day_conv($str)
{
    switch ($str) {
        case "Monday":
            return "วันจันทร์";
        case "Tuesday":
            return "วันอังคาร";
        case "Wednesday":
            return "วันพุธ";
        case "Thursday":
            return "วันพฤหัสบ่ดี";
        case "Friday":
            return "วันศุกร์";
        case "Satuday":
            return "วันเสาร์";
        case "Sunday":
            return "วันอาทิตย์";
        default:
            return "ไม่ทราบ";
    }
}

?>