<?php include('api/db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin - View All Bookings</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
	<style>
		body { font-family: 'Poppins', sans-serif; background: #f4f4f4; padding: 40px; }
		.admin-table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.1); }
		.admin-table th { background: #e67e22; color: white; padding: 15px; }
		.admin-table td { padding: 15px; border-bottom: 1px solid #eee; text-align: center; }
		.header { text-align: center; margin-bottom: 30px; }
		h1 { color: #333; }
		.contact-links a { text-decoration: none; margin: 0 5px; font-size: 18px; }
	</style>
</head>
<body>

	<div class="header">
		<h1>Admin Control Panel</h1>
		<p>Dashboard se aayi hui saari bookings yahan dikhengi</p>
	</div>

	<table class="admin-table">
		<thead>
			<tr>
				<th>Booking ID</th>
				<th>User Details</th> <th>Destination Name</th>
				<th>Travel Date</th>
				<th>Members</th>
				<th>Contact</th> <th>Booking Status</th>
			</tr>
		</thead>
		<tbody>
			<?php
			// JOIN query: select user fullname/mobile if available
			$sql = "SELECT bookings.*, users.fullname AS user_fullname, users.mobile AS user_mobile
					FROM bookings
					LEFT JOIN users ON bookings.user_id = users.id
					ORDER BY bookings.id DESC";

			$fetch = mysqli_query($conn, $sql);

			if($fetch && mysqli_num_rows($fetch) > 0) {
				while($row = mysqli_fetch_assoc($fetch)) {
					// Handle different possible column names
					$dest = !empty($row['destination']) ? $row['destination'] : 'N/A';
					$members = !empty($row['travelers']) ? $row['travelers'] : (!empty($row['no_of_travelers']) ? $row['no_of_travelers'] : '1');

					$u_name = !empty($row['user_fullname']) ? $row['user_fullname'] : (!empty($row['fullname']) ? $row['fullname'] : (!empty($row['name']) ? $row['name'] : 'Guest'));
					$u_mobile = !empty($row['user_mobile']) ? $row['user_mobile'] : (!empty($row['mobile']) ? $row['mobile'] : '');

					echo "<tr>
						<td>#00".htmlspecialchars($row['id'])."</td>
						<td><b>".htmlspecialchars($u_name)."</b></td>
						<td><b>".htmlspecialchars($dest)."</b></td>
						<td>".(!empty($row['travel_date']) ? date('d M, Y', strtotime($row['travel_date'])) : 'N/A')."</td>
						<td>".htmlspecialchars($members)."</td>
						<td class='contact-links'>";

						if(!empty($u_mobile)) {
							echo "<a href='tel:".htmlspecialchars($u_mobile)."' style='color:#3498db;'><i class='fas fa-phone'></i></a>";
							echo "<a href='https://wa.me/91".htmlspecialchars($u_mobile)."' style='color:#2ecc71;' target='_blank'><i class='fab fa-whatsapp'></i></a>";
						} else {
							echo "No Contact";
						}

					echo "</td>
						<td style='color:green; font-weight:bold;'>New Request</td>
					</tr>";
				}
			} else {
				echo "<tr><td colspan='7'>Abhi tak koi booking nahi aayi hai.</td></tr>";
			}
			?>
		</tbody>
	</table>

</body>
</html>