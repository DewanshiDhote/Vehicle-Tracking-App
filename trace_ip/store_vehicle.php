<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicle_name = $_POST['vehicle_name'];
    $vehicle_number_plate = $_POST['vehicle_number_plate'];
    $user_ip_address = $_POST['user_ip_address'];

    $conn = new mysqli("localhost", "root", "", "ip_address_trace");

    $stmt = $conn->prepare("INSERT INTO vehicles (vehicle_name, vehicle_number_plate, user_ip_address) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $vehicle_name, $vehicle_number_plate, $user_ip_address);
    $stmt->execute();

    // Fetch IP geolocation
    $api_key = "4fa935f4c6e645499afcad18d8d579e4";
    $url = "https://api.ipgeolocation.io/ipgeo?apiKey={$api_key}&ip={$user_ip_address}";
    $location = json_decode(file_get_contents($url), true);
    $latitude = $location['latitude'];
    $longitude = $location['longitude'];

    // Store initial location
    $vehicle_id = $stmt->insert_id;
    $stmt = $conn->prepare("INSERT INTO vehicle_locations (vehicle_id, latitude, longitude) VALUES (?, ?, ?)");
    $stmt->bind_param("idd", $vehicle_id, $latitude, $longitude);
    $stmt->execute();

    header("Location: index.php");
}
?>
