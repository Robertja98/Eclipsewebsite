<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Collect form data
$name = htmlspecialchars(trim($_POST['name']));
$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
$company = htmlspecialchars(trim($_POST['company']));
$message = htmlspecialchars(trim($_POST['message']));

// Validate required fields
if (empty($name) || empty($email) || empty($message)) {
    echo "Please fill in all required fields.";
    exit;
}

// Define CSV path in root directory
$csvFile = $_SERVER['DOCUMENT_ROOT'] . '/contacts.csv';
$headers = ['Name', 'Email', 'Company', 'Message', 'Timestamp'];
$data = [$name, $email, $company, $message, date('Y-m-d H:i:s')];

// Create or append to CSV
$fileExists = file_exists($csvFile);
$file = fopen($csvFile, 'a');
if ($file) {
    if (!$fileExists) {
        fputcsv($file, $headers); // Add headers only once
    }
    fputcsv($file, $data);
    fclose($file);
 header("Location: /thank-you.html");
exit;
}
?>
