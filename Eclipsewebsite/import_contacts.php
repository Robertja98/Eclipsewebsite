<?php
require 'csv_handler.php';
require 'csv_import.php';
require 'validation.php';

$filename = 'contacts.csv';
$schema = ['id','first_name','last_name','company','address_1','address_2','city','postal_code','province','country','phone','email'];
$existing = readCSV($filename);

if (isset($_FILES['csv_file'])) {
    $imported = importCSVWithSchema($_FILES['csv_file']['tmp_name'], $schema, 'id', $existing);
    foreach ($imported as $row) {
        if (validateContact($row)) {
            $existing[] = $row;
        }
    }
    writeCSV($filename, $existing);
    echo "Contacts imported successfully.";
} else {
    echo "No file uploaded.";
}
?>
