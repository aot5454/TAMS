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
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="pro">Profile</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form autocomplete="off" method="POST" action="#">
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="<?= $this->session->userdata('login_id'); ?>">
                    <div class="form-group">
                        <label for="nisitID">รหัสนิสิต</label>
                        <input type="text" class="form-control" name="nisitID" id="nisitID" value="<?= $this->session->userdata('login_id'); ?>" readonly>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="grade">คำนำหน้า</label>
                            <select class="form-control" name="uts" id="uts" required>
                                <option value="">-- เลือกคำนำ --</option>
                                <option value="male">นาย</option>
                                <option value="female">นางสาว</option>
                            </select>

                        </div>
                        <div class="form-group col-md-8">
                            <label for="name">ชื่อ-สกุล</label>
                            <input type="text" class="form-control" name="name" id="name" value="<?= $this->session->userdata('username'); ?>" readonly>
                        </div>
                    </div>


                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="uts">ระดับปริญญา</label>
                            <select class="form-control" name="uts" id="uts" required>
                                <option value="">-- เลือกระดับปริญญา --</option>
                                <option value="tre">ตรี</option>
                                <option value="to">โท</option>
                                <option value="ake">เอก</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="faculty">คณะ</label>
                            <input type="text" class="form-control" id="faculty" value="วิทยาศาสตร์" readonly>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="major">สาขาวิชา</label>
                            <select class="form-control" name="major" id="major" required>
                                <option value="">-- เลือกสาขาวิชา --</option>
                                <option value="com">วิทยาการคอมพิวเตอร์</option>
                                <option value="it">เทคโนโลยีสารสนเทศ</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="years">ชั้นปี</label>
                            <select class="form-control" name="years" id="years" required>
                                <option value="">-- เลือกชั้นปี --</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="grade">เกรดเฉลี่ย GPA</label>
                            <input type="number" step="any" min="0.00" max="4.00" class="form-control" id="grade" name="grade" placeholder="เกรดเฉลี่ย" required>
                        </div>
                        <div class="form-group col-md-8">
                            <label for="tel">เบอร์โทรศัพท์</label>
                            <input type="tel" pattern="[0-9]*" minlength="10" maxlength="10" class="form-control" id="tel" name="tel" placeholder="โปรดกรอก เบอร์โทรศัพท์" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email">E-Mail</label>
                        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="form-control" id="email" placeholder="โปรดกรอก Email" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-success float-right" type="submit" id="btnSubmitEdit">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

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
</body>

</html>