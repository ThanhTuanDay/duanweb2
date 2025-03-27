<?php
if (!isset($content)) {
    die("Error: Content file not set.");
}
include dirname(__DIR__) . "/layout/header-admin.php";
?>
<main>
    <?php include $content; ?>
</main>

<?php include dirname(__DIR__) . "/layout/footer-admin.php"; ?>