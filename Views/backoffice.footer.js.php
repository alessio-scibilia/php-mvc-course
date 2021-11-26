<?php $v = "1.1"; // TODO: update at every javascript change ?>
<script src="/js/bootstrap.js"></script>
<script src="/js/jquery.min.js"></script>
<script src="/js/popper.js"></script>
<script src="/vendor/global/global.min.js"></script>
<script src="/vendor/chart.js/Chart.bundle.min.js"></script>

<script src="/js/main.js?v=<?php echo $v; ?>"></script>
<script src="/vendor/summernote/js/summernote.min.js"></script>
<!-- Summernote init -->
<script src="/js/plugins-init/summernote-init.js"></script>

<script src="/js/custom.min.js?v=<?php echo $v; ?>"></script>

<!-- Datatable -->
<script src="/vendor/datatables/js/jquery.dataTables.min.js"></script>


<?php include 'Views/backoffice.datatable.js.php'; ?>
<script src="/js/backoffice.upload.images.js?v=<?php echo $v; ?>"></script>
<script src="/js/geolocator.js?v=<?php echo $v; ?>"></script>
<script src="/js/multilanguage.textbox.js?v=<?php echo $v; ?>"></script>
<script src="/js/summernote.events.js?v=<?php echo $v; ?>"></script>