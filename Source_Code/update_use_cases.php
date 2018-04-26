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
		$sql = "Select * from use_cases WHERE uc_id='$id'";
		$result = $conn->query($sql);
		$rows = $result->fetch_assoc();
		
		if($id == 0)
			$op = 1;
		else
			$op =0;
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$uc_name = $_POST["uc_name"];
			$uc_id = $_POST["uc_id"];
			if ( $op==0)
				$sql ="update use_cases SET uc_name='".$uc_name."' WHERE uc_id='".$uc_id."'";
			else
				$sql ="insert into use_cases(uc_name) values('".$uc_name."')";
			$update = $conn->query($sql);
			if($result){
				header("location:index.php?id=8");
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
	<td align="center"><strong>UC id</strong></td>
	<td align="center"><strong>UC Name</strong></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td align="center"><input name="uc_id" type="text" id="uc_id" value="<?php echo ($rows['uc_id']); ?>"></td>
	<td align="center"><input name="uc_name" type="text" id="uc_name" value="<?php echo $rows['uc_name']; ?>" size="15"></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td>
	<input name="id" type="hidden" id="uc_id" value="<? echo $rows['uc_id']; ?>">
	</td>
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