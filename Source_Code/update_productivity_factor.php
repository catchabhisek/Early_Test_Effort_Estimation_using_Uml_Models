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
		$sql = "Select * from productivity_factor WHERE pid='$id'";
		$result = $conn->query($sql);
		$rows = $result->fetch_assoc();
		
		if($id == 0)
			$op = 1;
		else
			$op =0;
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$productivity_factor = $_POST["productivity_factor"];
			$pid = $_POST["pid"];
			if ( $op==0)
				$sql ="update productivity_factor SET productivity_factor='".$productivity_factor."' WHERE pid='".$pid."'";
			else
				$sql ="insert into productivity_factor values(".$pid.",".$productivity_factor.")";
			$update = $conn->query($sql);
			if($result){
				header("location:index.php?id=15");
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
	<td><strong>Project Name</strong></td>
	<td><strong>Productivity Factor</strong></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td>
	<select name = "pid"><?php
		$select = $conn->query("Select * from projects");
		if($select->num_rows > 0){?>
			<option value = "<?php echo $rows['pid']; ?>" ><?php foreach($select as $row1)
							if($rows["pid"] == $row1["pid"]){
								echo ($row1["name"]);
								break;}?></option><?php
			foreach($select as $row){?>
				<option value = "<?php echo $row["pid"]?>"><?php echo $row["name"]?></option><?php
			}
		}?>
	</td>
	<td><input name="productivity_factor" type="text" id="productivity_factor" value="<?php echo $rows['productivity_factor']; ?>" size="15"></td>
	</tr>
	<tr>
	<td>
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