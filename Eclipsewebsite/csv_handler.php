function readCSV($filename) {
    $rows = [];
    if (($handle = fopen($filename, 'r')) !== false) {
        $headers = fgetcsv($handle);
        while (($data = fgetcsv($handle)) !== false) {
            $rows[] = array_combine($headers, $data);
        }
        fclose($handle);
    }
    return $rows;
}

function writeCSV($filename, $rows) {
    if (empty($rows)) return false;
    $handle = fopen($filename, 'w');
    fputcsv($handle, array_keys($rows[0]));
    foreach ($rows as $row) {
        fputcsv($handle, $row);
    }
    fclose($handle);
    return true;
}
