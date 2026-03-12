<?php
require 'csv_handler.php';
require 'validation.php';

$filename = 'contacts.csv';
$contacts = readCSV($filename);

// Create new contact from POST data
$newContact = [
    'id'          => uniqid(),
    'first_name'  => $_POST['first_name'] ?? '',
    'last_name'   => $_POST['last_name'] ?? '',
    'company'     => $_POST['company'] ?? '',
    'address_1'   => $_POST['address_1'] ?? '',
    'address_2'   => $_POST['address_2'] ?? '',
    'city'        => $_POST['city'] ?? '',
    'postal_code' => $_POST['postal_code'] ?? '',
    'province'    => $_POST['province'] ?? '',
    'country'     => $_POST['country'] ?? '',
    'phone'       => $_POST['phone'] ?? '',
    'email'       => $_POST['email'] ?? ''
];

// Validate and save
if (validateContact($newContact)) {
    $contacts[] = $newContact;
    writeCSV($filename, $contacts);
    echo "Contact saved successfully.";
} else {
    echo "Invalid contact data.";
}
?>