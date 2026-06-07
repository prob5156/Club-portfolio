<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : "Dhrupodi Dancers' Association - KUET"; ?></title>
    <?php if (isset($pageDescription)): ?>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <?php else: ?>
    <meta name="description" content="Dhrupodi Dancers' Association of KUET - Celebrating the grace and tradition of classical dance at KUET.">
    <?php endif; ?>
    <link rel="stylesheet" href="/Dhrupodi/css/style.css?v=2">
    <style>
        /* Force background image to ensure it appears despite caching/paths */
        body {
            background-image: url('/Dhrupodi/images/Bg1.png') !important;
            background-size: cover !important;
            background-position: center center !important;
            background-attachment: fixed !important;
        }
    </style>
</head>
<body>
