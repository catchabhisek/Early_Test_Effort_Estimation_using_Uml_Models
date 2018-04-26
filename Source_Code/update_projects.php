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
		$sql = "Select * from projects WHERE pid='$id'";
		$result = $conn->query($sql);
		$rows = $result->fetch_assoc();
		
		if($id == 0)
			$op = 1;
		else
			$op =0;
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$pname = $_POST["name"];
			$pid = $_POST["pid"];
			if ( $op==0)
				$sql ="update projects SET name='".$pname."' WHERE pid='".$pid."'";
			else
				$sql ="insert into projects(pid,pname) values(".$pid.",'".$pname."')";
			$update = $conn->query($sql);
			if($result){
				header("location:index.php?id=1");
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
	<td align="center"><strong>Project id</strong></td>
	<td align="center"><strong>Project Name</strong></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td align="center"><input name="pid" type="text" id="pid" value="<?php echo ($rows['pid']); ?>"></td>
	<td align="center"><input name="name" type="text" id="name" value="<?php echo $rows['name']; ?>" size="15"></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td>
	<input name="id" type="hidden" id="pid" value="<? echo $rows['pid']; ?>">
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