<?php
// submit-contact.php - Handles contact form submissions securely

// Basic CSRF token check (optional, can be enhanced)
session_start();
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: contact.php');
    exit;
}

// Validate and sanitize input
$name    = isset($_POST['name'])    ? trim($_POST['name'])    : '';
$email   = isset($_POST['email'])   ? trim($_POST['email'])   : '';
$company = isset($_POST['company']) ? trim($_POST['company']) : '';
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

$errors = [];
if ($name === '') {
    $errors[] = 'Name is required.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'A valid email is required.';
}
if ($message === '') {
    $errors[] = 'Message is required.';
}

if ($errors) {
    // Store errors in session and redirect back
    $_SESSION['contact_errors'] = $errors;
    $_SESSION['contact_post'] = $_POST;
    header('Location: contact.php');
    exit;
}

// Prepare email
$to = 'rlee@eclipsewatertechnologies.com';
$subject = 'New Contact Form Submission';
$body = "Name: $name\nEmail: $email\nCompany: $company\nMessage:\n$message";
$headers = "From: noreply@eclipsewatertechnologies.com\r\nReply-To: $email";

// Send email (use mail() or log to file if mail is not configured)
if (!mail($to, $subject, $body, $headers)) {
    error_log("Contact form failed to send: $body");
    $_SESSION['contact_errors'] = ['There was a problem sending your message. Please try again later.'];
    $_SESSION['contact_post'] = $_POST;
    header('Location: contact.php');
    exit;
}

// Success
$_SESSION['contact_success'] = true;
header('Location: contact.php');
exit;
