<!-- Footer -->
<footer class="text-center text-white" style="background-color: #22231d;">
    <!-- Grid container -->
    <div class="container p-4">
        <div class="d-flex justify-content-center">
            <img src="<?php echo base_url('uploads/footer.jpg') ?>" style="min-width: 300px;">
        </div>
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        © 2022 Copyright:
        <a class="text-white" href="#!"><?php echo $title ?></a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->



<!-- Bootstrap core JavaScript-->

<script src="<?= base_url('asset/sb_admin2/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('asset/sb_admin2/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('asset/sb_admin2/'); ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?= base_url('asset/sb_admin2/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('asset/sb_admin2/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="<?= base_url('asset/sb_admin2/'); ?>js/demo/datatables-demo.js"></script>
<script src="<?= base_url('asset/sb_admin2/'); ?>js/base.js"></script>
<script src="<?= base_url('asset/admin/'); ?>js/base.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        var post = <?php echo json_encode($_POST); ?>;
        var obj = $('#content');
        $.each(post, function(index, value) {
            obj.find('[name=' + index + ']').val(value);
        });
    });
</script>