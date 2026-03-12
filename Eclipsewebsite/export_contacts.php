<?php
require 'csv_handler.php';
require 'csv_export.php';

$filename = 'contacts.csv';
$contacts = readCSV($filename);

$filters = [];
if (!empty($_GET['company'])) {
    $filters['company'] = $_GET['company'];
}
if (!empty($_GET['tag'])) {
    $filters['tag'] = $_GET['tag'];
}

$exported = exportCSVFiltered($filename, $contacts, $filters);
echo $exported ? "Export complete." : "No matching contacts.";
?>
