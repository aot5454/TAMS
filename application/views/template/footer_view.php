<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

</div>
<!-- End of Main Content -->

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; 2019 - <?= date('Y'); ?> #ตามสัญญา.</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Profile Model -->
<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="pro" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pro">Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?php
            if ($this->session->userdata('status') == "nisit") {
                $id = $this->session->userdata('login_id');
                $info_nisit = $this->User_model->fetch_user_id_st_print($id);
            ?>

                <form method="POST" action="<?php echo base_url('Nisit/editUserNisit'); ?>">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="id-edit">ID Student</label>
                                    <input type="text" class="form-control" name="id-edit" id="id-edit" value="<?= $info_nisit[0]['st_id']; ?>" required readonly>
                                </div>

                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="pass">New Password</label>
                                    <input type="password" name="password-old" id="password-old" value="<?= $info_nisit[0]['st_pwd']; ?>" hidden>
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
                                        <option selected disabled>-- เลือก --</option>
                                        <option value="นาย" <?= ($info_nisit[0]['st_title'] == "นาย") ? "selected" : ""; ?>>นาย</option>
                                        <option value="นาง" <?= ($info_nisit[0]['st_title'] == "นาง") ? "selected" : ""; ?>>นาง</option>
                                        <option value="นางสาว" <?= ($info_nisit[0]['st_title'] == "นางสาว") ? "selected" : ""; ?>>นางสาว</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="name-edit">ชื่อจริง</label>
                                    <input type="text" class="form-control" name="name-edit" id="name-edit" placeholder="Enter name" value="<?= $info_nisit[0]['st_name']; ?>" required>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="surname-edit">นามสกุล</label>
                                    <input type="text" class="form-control" name="surname-edit" id="surname-edit" placeholder="Enter surname" value="<?= $info_nisit[0]['st_surname']; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="sex-edit">เพศ</label>
                                    <select class="form-control" name="sex-edit" id="sex-edit" required>
                                        <option selected disabled>-- เลือก --</option>
                                        <option value="1" <?= ($info_nisit[0]['st_sex'] == 1) ? "selected" : ""; ?>>ชาย</option>
                                        <option value="2" <?= ($info_nisit[0]['st_sex'] == 2) ? "selected" : ""; ?>>หญิง</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="nickname-edit">ชื่อเล่น</label>
                                    <input type="text" class="form-control" name="nickname-edit" id="nickname-edit" placeholder="Enter nickname" value="<?= $info_nisit[0]['st_nickname']; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="tel-edit">เบอร์โทรศัพท์</label>
                                    <input type="text" class="form-control" name="tel-edit" id="tel-edit" placeholder="Enter Telephone number" value="<?= $info_nisit[0]['st_tel']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="fac-edit">คณะ</label>
                                    <input type="text" class="form-control" name="fac" id="fac-edit" value="วิทยาศาสตร์" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="major-edit">สาขา</label>
                                    <select class="form-control" name="major-edit" id="major-edit" required>
                                        <option selected disabled>-- เลือก --</option>
                                        <option value="10007" <?= ($info_nisit[0]['maj_id'] == "10007") ? "selected" : ""; ?>>วิทยาการคอมพิวเตอร์</option>
                                        <option value="10008" <?= ($info_nisit[0]['maj_id'] == "10008") ? "selected" : ""; ?>>เทคโนโลยีสารสนเทศ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="gpax-edit">GPAX</label>
                                    <input type="text" class="form-control" name="gpax-edit" id="gpax-edit" placeholder="Enter GPAX" value="<?= $info_nisit[0]['st_gpax']; ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email-edit">E-mail</label>
                                    <input type="text" class="form-control" name="email-edit" id="email-edit" placeholder="Enter Email" value="<?= $info_nisit[0]['st_email']; ?>">
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
            <?php
            } ?>
        </div>
    </div>
</div>

<?php
$stu = $this->session->userdata('status');
if ($stu == "nisit") { ?>
    <!-- GPAX Modal -->
    <div class="modal fade" id="chack-gpax" tabindex="-1" role="dialog" aria-labelledby="gpax" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="gpax">โปรดกรอกผลการเรียนเฉลี่ย GPAX</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('nisit/editGPAX') ?>" method="post">
                    <div class="modal-body">
                        <div>
                            <p>*เนื่องจากในการคัดเลือกนิสิตช่วยสอนในรายวิชาต่างๆ ผลการเรียนเฉลี่ยมีผลในการตัดสิน*</p>
                        </div>
                        <div class="form-group">
                            <label for="gpaxx">GPAX</label>
                            <input type="text" name="id-gpaxx" value="<?= $this->session->userdata('login_id'); ?>" hidden>
                            <input type="text" class="form-control" id="gpaxx" name="gpaxx" placeholder="4.00" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
} ?>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url() . $this->session->userdata('status') . '/logout' ?>">Logout</a>
            </div>
        </div>
    </div>
</div>
</body>


<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url() . "resources/assets/admin_panal/vendor/jquery/jquery.min.js"; ?>"></script>
<script src="<?php echo base_url() . "resources/assets/admin_panal/vendor/bootstrap/js/bootstrap.bundle.min.js"; ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url() . "resources/assets/admin_panal/vendor/jquery-easing/jquery.easing.min.js"; ?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url() . "resources/assets/admin_panal/js/sb-admin-2.min.js"; ?>"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url('resources/assets/admin_panal/vendor/datatables/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('resources/assets/admin_panal/vendor/datatables/dataTables.bootstrap4.min.js') ?>"></script>

<!-- Page level custom scripts -->
<script src="<?php echo base_url('resources/assets/admin_panal/js/demo/datatables-demo.js') ?>"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>

<!-- custom Chack -->
<script src="<?php echo base_url('resources/assets/admin_panal/js/chack.js') ?>"></script>
<script src="<?php echo base_url('resources/assets/admin_panal/js/model.js') ?>"></script>


<script>
    function myFunction() {
        // Get the snackbar DIV
        var x = document.getElementById("snackbar");

        // Add the "show" class to DIV
        x.className = "show";

        // After 3 seconds, remove the show class from DIV
        setTimeout(function() {
            x.className = x.className.replace("show", "");
        }, 3000);
    }
</script>

<?php
if ($this->session->userdata('status') == "nisit") {
    $id = $this->session->userdata('login_id');
    $gpax_nisit = $this->User_model->get_gpax($id);
    //print_r($gpax_nisit);
    if ($gpax_nisit[0]['st_gpax'] == 0) {
        echo "
        <script>
            $('#chack-gpax').modal('show')
        </script>
        ";
    }
}
?>
</body>

</html>