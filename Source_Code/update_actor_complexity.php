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
		$sql = "Select * from actor_complexity WHERE serial_no='$id'";
		$result = $conn->query($sql);
		$rows = $result->fetch_assoc();
		
		if($id == 0)
			$op = 1;
		else
			$op =0;
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$serial_no = $_POST["serial_no"];
			$type = $_POST["type"];
			$min = $_POST["min_value"];
			$max = $_POST["max_value"];
			$weight = $_POST["weight"];
			if ( $op==0)
				$sql ="update actor_complexity SET type='".$type."', min_value='".$min."', max_value='".$max."', weight ='".$weight."' where serial_no='".$serial_no."'";
			else
				$sql ="insert into actor_complexity(type,min_value,max_value,weight) values('".$type."',".$min.",".$max.",".$weight.")";
			$update = $conn->query($sql);
			if($result){
				header("location:index.php?id=6");
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
	<td align="center"><strong>Type</strong></td>
	<td align="center"><strong>Min. Value</strong></td>
	<td align="center"><strong>Max. Value</strong></td>
	<td align="center"><strong>Weight</strong></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td align="center"><input name="serial_no" type="hidden" id="serial_no" value="<?php echo $rows['serial_no']; ?>"></td>
	<td align="center"><input name="type" type="text" id="type" value="<?php echo $rows['type']; ?>" size="15"></td>
	<td align="center"><input name="min_value" type="text" id="min_value" value="<?php echo $rows['min_value']; ?>" size="15"></td>
	<td align="center"><input name="max_value" type="text" id="max_value" value="<?php echo $rows['max_value']; ?>" size="15"></td>
	<td align="center"><input name="weight" type="text" id="weight" value="<?php echo $rows['weight']; ?>" size="15"></td>
	</tr>
	<tr>
	<td align="center">
	<?php if( $op == 0){?>
		<input type="submit" name="Submit" value="Update"><?php }?>
	<?php if( $op == 1){?>
		<input type="submit" name="add" value="ADD"><?php }?>
	</td>
	</tr>
	</table>
	</td>
	</form>
	</tr>
	</table>


	
	</body>
</html>