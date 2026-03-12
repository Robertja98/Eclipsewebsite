<?php
date_default_timezone_set('America/Toronto');

// Sanitize and validate input
$name = htmlspecialchars(trim($_POST['name']));
$email = filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL);
$company = htmlspecialchars(trim($_POST['company']));
$message = htmlspecialchars(trim($_POST['message']));
$submittedAt = date('Y-m-d H:i:s');

// Check for required fields
if (empty($name) || empty($email) || empty($message)) {
    echo json_encode(['error' => 'Please fill in all required fields']);
    exit;
}

// Create a unique filename
$timestamp = date('Ymd_His');
$filename = "submissions/contact_$timestamp.csv";

// Ensure the submissions directory exists
if (!is_dir('submissions')) {
    mkdir('submissions', 0755, true);
}

// Prepare CSV content
$data = [
    ['Name', 'Email', 'Company', 'Message', 'Submitted At'],
    [$name, $email, $company, $message, $submittedAt]
];

// Write to CSV
$fp = fopen($filename, 'w');
foreach ($data as $row) {
    fputcsv($fp, $row);
}
fclose($fp);

echo json_encode(['message' => 'Submission saved to CSV']);
?>
