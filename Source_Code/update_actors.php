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
		$sql = "Select * from actors WHERE actor_id='$id'";
		$result = $conn->query($sql);
		$rows = $result->fetch_assoc();
		
		if($id == 0)
			$op = 1;
		else
			$op =0;
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$actor_name = $_POST["actor_name"];
			$actor_id = $_POST["actor_id"];
			if ( $op==0)
				$sql ="update actors SET actor_name='".$actor_name."' WHERE actor_id='".$actor_id."'";
			else
				$sql ="insert into actors values(".$actor_id.",'".$actor_name."')";
			$update = $conn->query($sql);
			if($result){
				header("location:index.php?id=4");
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
	<td align="center"><strong>Actor Id</strong></td>
	<td align="center"><strong>Actor Name</strong></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td align="center"><input name="actor_id" type="text" id="actor_id" value="<?php echo ($rows['actor_id']); ?>"></td>
	<td align="center"><input name="actor_name" type="text" id="actor_name" value="<?php echo $rows['actor_name']; ?>" size="15"></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td>
	<input name="id" type="hidden" id="actor_id" value="<? echo $rows['actor_id']; ?>">
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