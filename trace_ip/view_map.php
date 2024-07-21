<?php
$vehicle_id = $_GET['id'];

$conn = new mysqli("localhost", "root", "", "ip_address_trace");
$result = $conn->query("SELECT * FROM vehicle_locations WHERE vehicle_id = $vehicle_id ORDER BY recorded_at DESC LIMIT 1");
$location = $result->fetch_assoc();

$latitude = $location['latitude'];
$longitude = $location['longitude'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Live Location</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <style>
        #map { height: 400px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Vehicle Live Location</h2>
        <div id="map"></div>
    </div>

    <script>
        var map = L.map('map').setView([<?php echo $latitude; ?>, <?php echo $longitude; ?>], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker = L.marker([<?php echo $latitude; ?>, <?php echo $longitude; ?>]).addTo(map)
            .bindPopup('Vehicle Location')
            .openPopup();

        function updateLocation() {
            fetch('get_vehicle_location.php?id=<?php echo $vehicle_id; ?>')
                .then(response => response.json())
                .then(data => {
                    var newLatLng = new L.LatLng(data.latitude, data.longitude);
                    marker.setLatLng(newLatLng);
                    map.setView(newLatLng);
                });
        }

        setInterval(updateLocation, 5000); // Update location every 5 seconds
    </script>
</body>
</html>
