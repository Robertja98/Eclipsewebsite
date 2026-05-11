<?php
// header.php - Shared site header for Eclipse Water Technologies
// Basic error logging setup (logs to error_log in project root)
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error_log');
// Optionally, hide errors from users in production
ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html lang="en-CA">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) : 'Eclipse Water Technologies'; ?></title>
    <meta name="description" content="<?php echo isset($pageDescription) ? htmlspecialchars($pageDescription) : 'High-purity water systems, DI service, and technical support across Canada.'; ?>">
    <link rel="icon" href="/Eclipselogo2026.png" type="image/png">
    <link rel="stylesheet" href="/styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <?php if (isset($pageExtraHead)) echo $pageExtraHead; ?>
</head>
<body>
<a class="skip-link" href="#main-content">Skip to main content</a>
<?php include 'navbar.php'; ?>
<main id="main-content">
