<?php
require 'csv_handler.php';

function calculateForecasts($filename = 'opportunities.csv') {
    $opportunities = readCSV($filename);
    $results = [];

    foreach ($opportunities as $opp) {
        $value = floatval($opp['value']);
        $probability = floatval($opp['probability']);
        $forecast = round($value * ($probability / 100), 2);

        $results[] = [
            'id' => $opp['id'],
            'contact_id' => $opp['contact_id'],
            'stage' => $opp['stage'],
            'value' => $value,
            'forecast' => $forecast
        ];
    }

    return $results;
}
?>
