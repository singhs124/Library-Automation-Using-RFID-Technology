<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include('includes/config.php');
// Get the period parameter from the GET request
$period = isset($_GET['period']) ? $_GET['period'] : 'today';

// Determine the time range based on the period
switch ($period) {
    case 'today':
        $startDate = date('Y-m-d 00:00:00');
        $endDate = date('Y-m-d 23:59:59');
        break;
    case 'week':
        $startDate = date('Y-m-d 00:00:00', strtotime('-7 days'));
        $endDate = date('Y-m-d 23:59:59', strtotime('-1 day'));
        break;
    case 'month':
        $startDate = date('Y-m-d 00:00:00', strtotime('-90 days'));
        $endDate = date('Y-m-d 23:59:59', strtotime('-8 days'));
        break;
    default:
        $startDate = date('Y-m-d 00:00:00');
        $endDate = date('Y-m-d 23:59:59');
}

// Fetch notifications based on the period
$sqlNo = "SELECT Description FROM Notifications WHERE timestamp BETWEEN :startDate AND :endDate ORDER BY timestamp DESC";
$queryNo = $dbh->prepare($sqlNo);
$queryNo->bindParam(':startDate', $startDate, PDO::PARAM_STR);
$queryNo->bindParam(':endDate', $endDate, PDO::PARAM_STR);
$queryNo->execute();
$resultsNo = $queryNo->fetchAll(PDO::FETCH_OBJ);

echo json_encode($resultsNo);
?>
