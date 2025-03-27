<?php
if (isset($params)) {
    extract($params); // Convert array keys into variables
}
$image = $image ?? 'public/images/default.jpg'; // Use a default image if not set
?>

    <div class="bg-box">
        <img src="<?php echo htmlspecialchars($image); ?>" alt="Hero Background">
    </div>
