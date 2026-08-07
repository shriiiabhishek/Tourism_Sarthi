<?php 
// API folder se database connection le rahe hain
include('api/db.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | View Bookings</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root { --primary: #e67e22; --dark: #2c3e50; --bg: #f4f7f6; }
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background-color: var(--bg); color: #333; }
        .top-bar { background: #fff; padding: 20px 5%; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 15px rgba(0,0,0,0.1); }
        .top-bar h2 { font-family: 'Montserrat'; color: var(--dark); font-size: 24px; }
        .top-bar h2 span { color: var(--primary); }
        .back-btn { text-decoration: none; color: #fff; background: var(--dark); padding: 10px 20px; border-radius: 8px; font-size: 14px; font-weight: 600; transition: 0.3s; }
        .back-btn:hover { background: #000; }
        .stats-container { padding: 30px 5%; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; }
        .stat-card { background: #fff; padding: 20px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); text-align: center; border-left: 5px solid var(--primary); }
        .stat-card i { font-size: 30px; color: var(--primary); margin-bottom: 10px; }
        .stat-card h4 { font-size: 14px; color: #777; }
        .stat-card h2 { font-size: 28px; color: var(--dark); }
        .table-section { padding: 0 5% 50px 5%; }
        .table-container { background: #fff; padding: 20px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.08); overflow-x: auto; }
        .table-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding: 0 10px; }
        .refresh-btn { background: #27ae60; color: #fff; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer; font-size: 13px; }
        table { width: 100%; border-collapse: collapse; min-width: 800px; }
        table th { background: #f8f9fa; color: #555; padding: 15px; text-align: left; font-weight: 600; font-size: 14px; border-bottom: 2px solid #eee; }
        table td { padding: 15px; border-bottom: 1px solid #f1f1f1; font-size: 14px; color: #444; }
        .destination-name { font-weight: 600; color: var(--dark); }
        .badge-confirmed { background: #eafaf1; color: #27ae60; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 700; }
    </style>
</head>
<body>

    <div class="top-bar">
        <h2>MP Tourism <span>Admin</span></h2>
        <a href="dashboard.php" class="back-btn"><i class="fas fa-arrow-left"></i> Back to Home</a>
    </div>

    <div class="stats-container">
        <div class="stat-card">
            <i class="fas fa-map-marked-alt"></i>
            <h4>Total Destinations</h4>
            <h2>20+</h2>
        </div>
        <div class="stat-card">
            <i class="fas fa-ticket-alt"></i>
            <h4>Total Bookings</h4>
            <h2>
                <?php 
                $count = mysqli_query($conn, "SELECT id FROM bookings");
                echo ($count) ? mysqli_num_rows($count) : 0; 
                ?>
            </h2>
        </div>
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <h4>Active Users</h4>
            <h2>
                <?php 
                $users = mysqli_query($conn, "SELECT id FROM users");
                echo ($users) ? mysqli_num_rows($users) : 0; 
                ?>
            </h2>
        </div>
    </div>

    <div class="table-section">
        <div class="table-container">
            <div class="table-header">
                <h3><i class="fas fa-list"></i> Recent Booking Requests</h3>
                <button onclick="location.reload();" class="refresh-btn"><i class="fas fa-sync-alt"></i> Refresh List</button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Destination</th>
                        <th>Travel Date</th>
                        <th>Travelers</th>
                        <th>Booking Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query uses new SQL table names
                    $sql = "SELECT * FROM bookings ORDER BY id DESC";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Formatting status for the badge
                            $status = isset($row['status']) ? $row['status'] : 'Confirmed';
                            
                            echo "<tr>";
                            echo "<td>#" . sprintf("%03d", $row['id']) . "</td>";
                            echo "<td class='destination-name'>" . (isset($row['destination']) ? $row['destination'] : 'N/A') . "</td>";
                            echo "<td>" . date('d M, Y', strtotime($row['travel_date'])) . "</td>";
                            echo "<td><i class='fas fa-users'></i> " . (isset($row['no_of_travelers' ]) ? $row['no_of_travelers'] : '0') . "</td>";
                            // Fix: Added <td> tag for Booking Time
                            echo "<td>" . (isset($row['booking_time']) ? date('d M, Y H:i', strtotime($row['booking_time'])) : 'N/A') . "</td>";
                            echo "<td><span class='badge-confirmed'>" . $status . "</span></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center; padding:50px; color:#999;'>Abhi tak koi booking nahi aayi hai.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>