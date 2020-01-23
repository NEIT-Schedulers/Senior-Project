<?php include_once('db.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Appointments</title>
</head>
<body>

<table>
	<thead>
		<tr>
			<th>Time</th>
			<th>Service</th>
			<th>Client</th>
			<th>Practitioner</th>
		</tr>
	</thead>
	<tbody>
	<?php  
		$year = null;
		$month = null;
		$day = null;
		if (isset($_GET['setYear'])) $year = $_GET['setYear'];
		if (isset($_GET['setMonth'])) $month = $_GET['setMonth'];
		if (isset($_GET['setDay'])) $day = $_GET['setDay'];

		$date = date('Y-m-d', strtotime("$year-$month-$day"));
		$query = "SELECT * FROM appointments WHERE date = '$date'";

		$response = @mysqli_query($db, $query);

		if ($response)
		{
			while($row = mysqli_fetch_array($response))
			{
				$clientQuery = "SELECT * FROM clients WHERE clientID = $row[clientID]";
				$practitionerQuery = "SELECT * FROM practitioners WHERE practitionerID = $row[practitionerID]";
				$serviceQuery = "SELECT * FROM services WHERE serviceID = $row[serviceID]";

				$clientResponse = @mysqli_query($db, $clientQuery);
				$practitionerResponse = @mysqli_query($db, $practitionerQuery);
				$serviceResponse = @mysqli_query($db, $serviceQuery);

				echo "<tr><td>";
				echo $row['time'] . "</td><td>";
				echo mysqli_fetch_array($serviceResponse)['serviceName'] . "</td><td>";
				echo mysqli_fetch_array($clientResponse)['firstName'] . "</td><td>";
				echo mysqli_fetch_array($practitionerResponse)['firstName'] . "</td></tr>";
			}
		}
	?>
	</tbody>
</table>
</body>
</html>