<?php
require 'csv_handler.php';
require 'forecast_calc.php';

$contacts = readCSV('contacts.csv');
$opportunities = readCSV('opportunities.csv');
$forecasts = calculateForecasts();

$totalContacts = count($contacts);
$totalValue = array_sum(array_column($opportunities, 'value'));
$totalForecast = array_sum(array_column($forecasts, 'forecast'));

echo "<h2>CRM Dashboard</h2>";
echo "<div>Total Contacts: $totalContacts</div>";
echo "<div>Total Opportunity Value: $" . number_format($totalValue, 2) . "</div>";
echo "<div>Total Forecast Value: $" . number_format($totalForecast, 2) . "</div>";

// Pipeline breakdown
$stages = [];
foreach ($opportunities as $opp) {
    $stage = $opp['stage'];
    $value = floatval($opp['value']);
    if (!isset($stages[$stage])) {
        $stages[$stage] = ['count' => 0, 'value' => 0];
    }
    $stages[$stage]['count']++;
    $stages[$stage]