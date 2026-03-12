<?php
$csvFile = 'contacts.csv';

if (!file_exists($csvFile)) {
  echo "<p>No contact data found.</p>";
  return;
}

echo '<table class="spec-table">';
echo '<thead><tr><th>Name</th><th>Email</th><th>Company</th><th>Status</th></tr></thead><tbody>';

$rows = file($csvFile);
foreach ($rows as $row) {
  $data = str_getcsv($row);
  if (count($data) >= 4) {
    [$name, $email, $company, $status] = $data;
    echo "<tr><td>$name</td><td>$email</td><td>$company</td><td>$status</td></tr>";
  }
}

echo '</tbody></table>';
?>
