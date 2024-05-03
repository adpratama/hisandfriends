    <!-- jquery -->
    <script src="<?= base_url() ?>assets/frontend/js/jquery-1.11.3.min.js"></script>
    <!-- bootstrap -->
    <script src="<?= base_url() ?>assets/frontend/bootstrap/js/bootstrap.min.js"></script>
    <!-- count down -->
    <script src="<?= base_url() ?>assets/frontend/js/jquery.countdown.js"></script>
    <!-- isotope -->
    <script src="<?= base_url() ?>assets/frontend/js/jquery.isotope-3.0.6.min.js"></script>
    <!-- waypoints -->
    <script src="<?= base_url() ?>assets/frontend/js/waypoints.js"></script>
    <!-- owl carousel -->
    <script src="<?= base_url() ?>assets/frontend/js/owl.carousel.min.js"></script>
    <!-- magnific popup -->
    <script src="<?= base_url() ?>assets/frontend/js/jquery.magnific-popup.min.js"></script>
    <!-- mean menu -->
    <script src="<?= base_url() ?>assets/frontend/js/jquery.meanmenu.min.js"></script>
    <!-- sticker js -->
    <script src="<?= base_url() ?>assets/frontend/js/sticker.js"></script>
    <!-- main js -->
    <script src="<?= base_url() ?>assets/frontend/js/main.js"></script>
    <!-- Toastr -->
    <script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
    <script>
        const flashdata = $(".flash-data").data("flashdata");
        if (flashdata) {
            toastr.success(flashdata)
        }

        const flashdata_error = $(".flash-data-error").data("flashdata");
        if (flashdata_error) {
            toastr.error('Error adding to cart')
        }
    </script>