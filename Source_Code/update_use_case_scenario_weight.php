<html>
	<head>
		<title>Update Page</title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="bootstrap.min.css">
		<script src="bootstrap.min.js"></script>
	</head>
	<body>
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "softwaretesting";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error)
		{
			die("Connection failed: " . $conn->connect_error);
		}
		
		$id=$_GET['id'];
		$sql = "Select * from use_case_scenario_weight WHERE serial_no='$id'";
		$result = $conn->query($sql);
		$rows = $result->fetch_assoc();
		
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$serial_no = $_POST["serial_no"];
			$type_of_scenario = $_POST["type_of_scenario"];
			$weight = $_POST["weight"];
			
			if ( $op==0)
				$sql ="update use_case_scenario_weight SET type_of_scenario='".$type_of_scenario."',weight='".$weight."' where serial_no='".$serial_no."'";
			$update = $conn->query($sql);
			if($result){
				header("location:index.php?id=11");
			}

			else {
				echo "ERROR";
			}
		}
		
	?>
	<table class="table table-striped" style="width: 100%">
	<form name="form1" method="post" action="">

	<tr>
	<td align="center">&nbsp;</td>
	<td align="center"><strong>&nbsp;</strong></td>
	<td align="center"><strong>Type of Scenario</strong></td>
	<td align="center"><strong>Weight</strong></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td align="center"><input name="serial_no" type="hidden" id="serial_no" value="<?php echo ($rows['serial_no']); ?>"></td>
	<td align="center"><input name="type_of_scenario" type="text" id="type_of_scenario" value="<?php echo $rows['type_of_scenario']; ?>" size="15"></td>
	<td align="center"><input name="weight" type="text" id="weight" value="<?php echo ($rows['weight']); ?>"></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td>
	<input name="id" type="hidden" id="ucd_id" value="<? echo $rows['ucd_id']; ?>">
	</td>
	<td align="center">
	<input type="submit" name="Submit" value="Update">
	</td>
	</tr>
	</table>
	</td>
	</form>
	</tr>
	</table>


	
	</body>
</html>