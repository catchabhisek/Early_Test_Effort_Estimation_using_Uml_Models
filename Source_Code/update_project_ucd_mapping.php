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
		$sql = "Select * from project_ucd_mapping WHERE serial_no='$id'";
		$result = $conn->query($sql);
		$rows = $result->fetch_assoc();
		
		if($id == 0)
			$op = 1;
		else
			$op = 0;
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$pid = $_POST["pid"];
			$ucd_id = $_POST["ucd_id"];
			$serial_no = $_POST["serial_no"];
			if ( $op==0)
				$sql ="update project_ucd_mapping SET pid='".$pid."', ucd_id='".$ucd_id."' where serial_no='".$serial_no."'";
			else
				$sql ="insert into project_ucd_mapping(pid,ucd_id) values(".$pid.",'".$ucd_id."')";
			$update = $conn->query($sql);
			if($result){
				header("location:index.php?id=3");
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
	<td><strong>UCD Name</strong></td>
	</tr>
	<tr>
	<td>&nbsp;</td><td>
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
	<td>
		<select name = "ucd_id"><?php
		$select = $conn->query("Select * from use_case_diagrams");
		if($select->num_rows > 0){?>
			<option value = "<?php echo $rows['ucd_id']?>" ><?php foreach($select as $row1)
							if($rows["ucd_id"] == $row1["ucd_id"]){
								echo ($row1["name"]);
								break;}?></option><?php
			foreach($select as $row){?>
				<option value = "<?php echo $row["ucd_id"]?>"><?php echo $row["name"]?></option><?php
			}
		}?>
	</td>
	<td>
	<input name="serial_no" type="hidden" id="serial_no" value="<?php echo $rows['serial_no']; ?>">
	</td>
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