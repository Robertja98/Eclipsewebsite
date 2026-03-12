<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Collect form data
$name = htmlspecialchars(trim($_POST['name']));
$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
$company = htmlspecialchars(trim($_POST['company']));
$phone = htmlspecialchars(trim($_POST['phone']));
$notes = htmlspecialchars(trim($_POST['notes']));

// Validate required fields
if (empty($name) || empty($email)) {
    echo "Name and email are required.";
    exit;
}

// Define CSV path
$csvFile = $_SERVER['DOCUMENT_ROOT'] . '/crm-data.csv';
$headers = ['Name', 'Email', 'Company', 'Phone', 'Notes', 'Timestamp'];
$data = [$name, $email, $company, $phone, $notes, date('Y-m-d H:i:s')];

// Save to CSV
$fileExists = file_exists($csvFile);
$file = fopen($csvFile, 'a');
if ($file) {
    if (!$fileExists) {
        fputcsv($file, $headers);
    }
    fputcsv($file, $data);
    fclose($file);
    header("Location: /thank-you.html");
    exit;
} else {
    echo "Unable to save customer data.";
}
?>
