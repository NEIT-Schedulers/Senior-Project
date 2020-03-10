<?php include_once('db.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Practitioners</title>
</head>
<body>
<?php

$name = null;
$first = null;
$last = null;
$email = null;
$phone = null;

if(isset($_POST['name']))
{
	$name = $_POST['name'];
	
	$sql = "DELETE FROM practitioners WHERE practitionerID = ?";
	$sql = $db->prepare($sql);
	$sql->bind_Param("i", $name);
	$sql->execute();
}
else if(isset($_POST['first']) &&
		isset($_POST['last']) &&
		isset($_POST['email']) &&
		isset($_POST['phone']))
{
	$first = $_POST['first'];
	$last = $_POST['last'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];

	$sql = "INSERT INTO practitioners (firstName, lastName, email, phone) VALUES (?, ?, ?, ?)";
		$sql = $db->prepare($sql);
		$sql->bind_Param("ssss", $first, $last, $email, $phone);
		$sql->execute();
}

?>

<form method="POST" enctype="multipart/form-data">
	<select id="name" name="name">
	<?php
		$query = "SELECT practitionerID, firstName, lastName FROM practitioners";
		$response = $db->query($query);
		
		foreach($response->fetch_all() as $data)
		{
			echo "<option value='$data[0]'>$data[1] $data[2]</option>";
		}
	?>
	</select>
	<button type="submit">Delete</button>
</form>
<br><br>
<form method="POST" enctype=”multipart/form-data>
	<input type="text" name="first" placeholder="First Name">
	<br><br>
	<input type="text" name="last" placeholder="Last Name">
	<br><br>
	<input type="text" name="email" placeholder="Email">
	<br><br>
	<input type="text" name="phone" placeholder="Phone">
	<br><br>
	<button type="submit">Add</button>
</form>
</body>
</html>