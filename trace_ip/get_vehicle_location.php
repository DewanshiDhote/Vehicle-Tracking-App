<?php
$vehicle_id = $_GET['id'];

$conn = new mysqli("localhost", "root", "", "ip_address_trace");
$result = $conn->query("SELECT * FROM vehicle_locations WHERE vehicle_id = $vehicle_id ORDER BY recorded_at DESC LIMIT 1");
$location = $result->fetch_assoc();

header('Content-Type: application/json');
echo json_encode([
    'latitude' => $location['latitude'],
    'longitude' => $location['longitude']
]);
?>
