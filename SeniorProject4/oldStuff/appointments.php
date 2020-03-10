<?php include_once('db.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Appointments</title>
</head>
<body>

<?php

$time = null;
$service = null;
$practitioner = null;
$firstName = null;
$lastName = null;
$email = null;
$phone = null;

$fail = false;

if(isset($_POST['time'])) $time = $_POST['time'];
else $fail = true;
if(isset($_POST['service'])) $service = $_POST['service'];
else $fail = true;
if(isset($_POST['practitioner'])) $practitioner = $_POST['practitioner'];
else $fail = true;
if(isset($_POST['firstName'])) $firstName = $_POST['firstName'];
else $fail = true;
if(isset($_POST['lastName'])) $lastName = $_POST['lastName'];
else $fail = true;
if(isset($_POST['email'])) $email = $_POST['email'];
else $fail = true;
if(isset($_POST['phone'])) $phone = $_POST['phone'];
else $fail = true;

if($fail == false)
{
	$sql = "SELECT * FROM clients WHERE email = ?";
	$sql = $db->prepare($sql);
	$sql->bind_Param("s", $email);
	$sql->execute();

	//TODO: Validate before adding appointment to DB
	$client = null;

	$res = $sql->get_result();

	if($res->num_rows != 0)
	{
		$client = $res->fetch_assoc()['clientID'];
	}
	else
	{
		$sql = "INSERT INTO clients (firstName, lastName, email, phone) VALUES (?, ?, ?, ?)";
		$sql = $db->prepare($sql);
		$sql->bind_Param("ssss", $firstName, $lastName, $email, $phone);
		$sql->execute();
		
		$sql = "SELECT * FROM clients WHERE email=?";
		$sql = $db->prepare($sql);
		$sql->bind_Param('s', $email);
		$sql->execute();

		$res = $sql->get_result();
		$client = $res->fetch_assoc()['clientID'];
	}

	$date = $_POST['year']."-".$_POST['month']."-".$_POST['day'];
	echo $date;
	$sql = "INSERT INTO appointments (date, time, serviceID, clientID, practitionerID) VALUES (?, ?, ?, ?, ?)";
	$sql = $db->prepare($sql);
	$sql->bind_Param("ssiii", $date, $time, $service, $client, $practitioner);
	$sql->execute();
}

?>

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

		$_POST['year'] = $year;
		$_POST['month'] = $month;
		$_POST['day'] = $day;

		$date = date('Y-m-d', strtotime("$year-$month-$day"));
		$query = "SELECT * FROM appointments WHERE date = '$date'";

		$response = $db->query($query);

		if ($response)
		{
			while($row = $response->fetch_assoc())
			{
				$clientQuery = "SELECT * FROM clients WHERE clientID = $row[clientID]";
				$practitionerQuery = "SELECT * FROM practitioners WHERE practitionerID = $row[practitionerID]";
				$serviceQuery = "SELECT * FROM services WHERE serviceID = $row[serviceID]";

				$clientResponse = @$db->query($clientQuery);
				$practitionerResponse = @$db->query($practitionerQuery);
				$serviceResponse = @$db->query($serviceQuery);

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
<form method="POST" enctype=”multipart/form-data>
	<label for="time">Time </label>
	<input type="time" id="time" name="time">
	<br>
	<label for="service">Service </label>
	<select id="service" name="service">
	<?php

		$query = "SELECT serviceID, serviceName FROM services";
		$response = $db->query($query);
		
		foreach($response->fetch_all() as $data)
		{
			echo "<option value='$data[0]'>$data[1]</option>";
		}
	?>
	</select>
	<br>
	<label for="practitioner">Practitioner </label>
	<select id="practitioner" name="practitioner">
	<?php

		$query = "SELECT practitionerID, firstName, lastName FROM practitioners";
		$response = $db->query($query);
		
		foreach($response->fetch_all() as $data)
		{
			echo "<option value='$data[0]'>$data[1] $data[2]</option>";
		}
	?>
	</select>
	<br>
	<input type="hidden" name="year" value=<?php echo $_POST['year'] ?>>
	<input type="hidden" name="month" value=<?php echo $_POST['month'] ?>>
	<input type="hidden" name="day" value=<?php echo $_POST['day'] ?>>
	<label for="firstName">Client First Name </label>
	<input type="text" id="firstName" name="firstName">
	<br>
	<label for="lastName">Client Last Name </label>
	<input type="text" id="lastName" name="lastName">
	<br>
	<label for="email">Client Email </label>
	<input type="text" id="email" name="email">
	<br>
	<label for="phone">Client Phone </label>
	<input type="text" id="phone" name="phone">
	<br>
	<button type="submit">Submit</button>
</form>
</body>
</html>