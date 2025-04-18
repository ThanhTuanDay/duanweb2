<?php include dirname(__DIR__) . "/layout/header-admin.php"; ?>

<div class="d-flex">
    <?php include dirname(__DIR__) . "/layout/sidebar-admin.php"; ?>

    <div class="main-content" id="main-content">
        <?php include dirname(__DIR__) . "/layout/topbar-admin.php"; ?>
        <?php
        if (isset($content) && file_exists($content)) {
            include $content;
        } else {
            echo "<h3 class='text-danger'>Trang không tồn tại!</h3>";
        }
        ?>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script src="/duanweb2/public/js/sidebar.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script src="/duanweb2/public/js/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

<?php
$folder = basename(dirname($content));
if (!empty($folder)) {
    echo "<script src='/duanweb2/public/js/$folder.js'></script>";
}

?>


</body>

</html>