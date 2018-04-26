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
		$sql = "Select * from technical_and_environmental_factors where factor_id='".$id."'";
		$result = $conn->query($sql);
		$rows = $result->fetch_assoc();
		
		if($id == 0)
			$op = 1;
		else
			$op = 0;
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$factor_id = $_POST["factor_id"];
			$factor_name = $_POST["factor_name"];
			$description = $_POST["description"];
			$weight = $_POST["weight"];
			if ( $op==0)
				$sql ="update technical_and_environmental_factors SET factor_name='".$factor_name."', description='".$description."',weight='".$weight."' where factor_id='".$factor_id."'";
			else
				$sql ="insert into technical_and_environmental_factors (factor_name,description,weight) values('".$factor_name."','".$description."',".$weight.")";
			$update = $conn->query($sql);
			if($result){
				header("location:index.php?id=13");
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
	<td align="center">&nbsp;</td>
	<td align="center"><strong>Factor Name</strong></td>
	<td align="center"><strong>Description</strong></td>
	<td align="center"><strong>Weight</strong></td>

	</tr>
	<tr>
	<td>&nbsp;</td>
	<td align="center"><input name="factor_id" type="hidden" id="factor_id" value="<?php echo ($rows['factor_id']); ?>"></td>
	<td align="center"><input name="factor_name" type="text" id="factor_name" value="<?php echo ($rows['factor_name']); ?>"></td>
	<td align="center"><input name="description" type="text" id="description" value="<?php echo $rows['description']; ?>" size="15"></td>
	<td align="center"><input name="weight" type="text" id="weight" value="<?php echo ($rows['weight']); ?>"></td>
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