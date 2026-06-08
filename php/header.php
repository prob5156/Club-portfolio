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
    <link rel="stylesheet" href="/Dhrupodi/css/global.css">
    <link rel="stylesheet" href="/Dhrupodi/css/navbar.css">
    <link rel="stylesheet" href="/Dhrupodi/css/footer.css">
</head>
<body>
