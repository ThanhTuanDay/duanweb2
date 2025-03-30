<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feane Admin - Categories</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/duanweb2/public/css/sidebar.css" rel="stylesheet">
    <link href="/duanweb2/public/css/admin.style.css" rel="stylesheet">
    <link href="/duanweb2/public/css/admin.responsive.css" rel="stylesheet">
    <?php
    $folder = basename(dirname($content));
    if (!empty($folder)) {
        echo '<link rel="stylesheet" href="/duanweb2/public/css/' . $folder . '.css">';
    }

    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
