<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Tracking System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body { padding: 20px; }
        .map-container { height: 400px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Vehicle Tracking System</h2>
        <form action="store_vehicle.php" method="POST">
            <div class="form-group">
                <label for="vehicle_name">Vehicle Name:</label>
                <input type="text" class="form-control" id="vehicle_name" name="vehicle_name" required>
            </div>
            <div class="form-group">
                <label for="vehicle_number_plate">Vehicle Number Plate:</label>
                <input type="text" class="form-control" id="vehicle_number_plate" name="vehicle_number_plate" required>
            </div>
            <div class="form-group">
                <label for="user_ip_address">User IP Address:</label>
                <input type="text" class="form-control" id="user_ip_address" name="user_ip_address" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        <h2 class="mt-5">Vehicles List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Vehicle ID</th>
                    <th>Vehicle Name</th>
                    <th>Vehicle Number Plate</th>
                    <th>Map</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetching vehicle data from database
                $conn = new mysqli("localhost", "root", "", "ip_address_trace");
                $result = $conn->query("SELECT * FROM vehicles");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['id']}</td>";
                    echo "<td>{$row['vehicle_name']}</td>";
                    echo "<td>{$row['vehicle_number_plate']}</td>";
                    echo "<td><a href='view_map.php?id={$row['id']}' class='btn btn-info'>View Map</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
