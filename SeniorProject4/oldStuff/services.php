<?php include_once('db.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Services</title>
</head>
<body>

<?php

$name = null;
$description = null;

if(isset($_POST['service']))
{
	$name = $_POST['service'];
	
	$sql = "DELETE FROM services WHERE serviceID = ?";
	$sql = $db->prepare($sql);
	$sql->bind_Param("i", $name);
	$sql->execute();
}
else if(isset($_POST['name']))
{
	$name = $_POST['name'];
	if(isset($_POST['description'])) $description = $_POST['description'];

	$sql = "INSERT INTO services (serviceName, description) VALUES (?, ?)";
		$sql = $db->prepare($sql);
		$sql->bind_Param("ss", $name, $description);
		$sql->execute();
}

?>

<form method="POST" enctype="multipart/form-data">
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
	<button type="submit">Delete</button>
</form>
<br><br>
<form method="POST" enctype=”multipart/form-data>
	<input type="text" id="name" name="name" placeholder="Service Name">
	<br><br>
	<textarea name="description">Service Description</textarea>
	<br><br>
	<button type="submit">Add</button>
</form>
</body>
</html>