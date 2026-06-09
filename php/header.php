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
    <!-- Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/Dhrupodi/css/global.css">
    <link rel="stylesheet" href="/Dhrupodi/css/navbar.css">
    <link rel="stylesheet" href="/Dhrupodi/css/footer.css">
    <?php if (isset($pageStylesheets) && is_array($pageStylesheets)): ?>
    <?php foreach ($pageStylesheets as $stylesheet): ?>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($stylesheet); ?>">
    <?php endforeach; ?>
    <?php elseif (isset($pageStylesheet)): ?>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($pageStylesheet); ?>">
    <?php endif; ?>
</head>
<body>
