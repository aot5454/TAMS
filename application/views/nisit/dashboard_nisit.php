<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Flex box -->
    <div style="display: flex; flex-wrap: wrap; align-items: flex-start;">

        <?php
        // echo count($posts);
        // print_r('<pre>');
        // print_r($posts);
        // print_r('</pre>');
        foreach ($posts as $post) {
            $url = $post['poif_url'];
            if ($post['poif_url'] == null or $post['poif_url'] == "-") {
                $url = "https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1050&q=80";
            }
        ?>

            <!-- Card Post -->
            <div class="col-md-4 mt-3 mb-3">
                <div class="card text-left">
                    <img class="card-img-top" height="200" width="100%" style="object-fit: cover;" alt="<?= $post['sj_name_thai']; ?>" src="<?= $url; ?>">

                    <div class="card-body" id="card">
                        <div>
                            <h5 class="card-title font-weight-bold text-primary mb-1 mr-3"><?= $post['sj_id']; ?></h5>
                            <h5 class="card-title font-weight-bold text-primary mb-1"><?= $post['sj_name_thai']; ?></h5>
                        </div>

                        <div>
                            <div class="row ">
                                <div class="col-auto ">
                                    <p class="card-title card-text mb-2"><b>กลุ่มเรียน</b> : <?= $post['poif_section']; ?></p>
                                </div>
                                <div class="col-auto">
                                    <p class="card-title card-text mb-2"><b>ภาคเรียน</b> : <?= $post['poif_term'] . "/" . $post['poif_years']; ?></p>
                                </div>
                            </div>
                            <p class="card-title card-text mb-2"><b>ผู้สอน</b> : <?= $post['tc_name_thai']; ?></p>



                            <p class="card-text">
                                &emsp;&emsp;&emsp;<?= $post['sj_des_thai']; ?>
                            </p>

                            <p class="card-text mb-1 font-weight-bold">วัน/เวลา</p>
                            <p class="card-text mb-0">
                                <?= day_conv($post['poif_daywork']); ?> : <?= $post['poif_timework_start'] . " - " . $post['poif_timework_end'] . " น."; ?>
                            </p>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <a class="btn btn-sm btn-light btn-block" href="<?= base_url('nisit/subject/') . $post['post_id']; ?>">Read More</a>
                    </div>
                </div>
            </div>
            <!-- ./Card Post -->

        <?php } //end for 
        ?>

    </div>
    <!-- /.Flex box -->

</div>
<!-- /.container-fluid -->

<?php
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