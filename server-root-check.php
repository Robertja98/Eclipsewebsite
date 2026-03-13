<?php
header('Content-Type: text/plain; charset=UTF-8');

$files = [
    'index.html',
    'index.php',
    '.htaccess',
    'robots.txt',
    'sitemap.xml',
];

echo "Eclipse Server Root Check\n";
echo "=========================\n";
echo 'Timestamp: ' . gmdate('c') . "\n";
echo 'Script path: ' . __FILE__ . "\n";
echo 'Script dir: ' . __DIR__ . "\n";
echo 'Document root: ' . ($_SERVER['DOCUMENT_ROOT'] ?? 'unknown') . "\n";
echo 'Server software: ' . ($_SERVER['SERVER_SOFTWARE'] ?? 'unknown') . "\n";
echo 'Host: ' . ($_SERVER['HTTP_HOST'] ?? 'unknown') . "\n\n";

echo "File checks\n";
echo "-----------\n";
foreach ($files as $file) {
    $path = __DIR__ . DIRECTORY_SEPARATOR . $file;
    echo $file . ': ' . (file_exists($path) ? 'present' : 'missing') . "\n";
}

echo "\nDirectory listing snapshot\n";
echo "--------------------------\n";
$entries = @scandir(__DIR__);
if ($entries === false) {
    echo "Unable to read directory listing\n";
} else {
    foreach (array_slice($entries, 0, 40) as $entry) {
        echo $entry . "\n";
    }
}