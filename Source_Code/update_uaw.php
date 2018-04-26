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
		$sql = "Select * from uaw where serial_no='".$id."'";
		$sql_ac = "Select * from actor_complexity";
		$result = $conn->query($sql);
		$rows = $result->fetch_assoc();
		$result_ac = $conn->query($sql_ac);
		$rows_ac = $result_ac->fetch_assoc();
		
		if($id == 0)
			$op = 1;
		else
			$op = 0;
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$serial_no = $_POST["serial_no"];
			$actor_id = $_POST["actor_id"];
			$number_of_interaction = $_POST["number_of_interaction"];
			
			foreach($result_ac as $rows_ac){
				if ($rows_ac["min_value"]<=$number_of_interaction && $rows_ac["max_value"]>=$number_of_interaction){
					$actor_complexity = $rows_ac["type"];
					$multiplying_factor = $rows_ac["weight"];
					$uaw = $multiplying_factor * $number_of_interaction;
					break;
				}
			}
			if ( $op==0)
				$sql ="update uaw SET actor_id='".$actor_id."',number_of_interaction='".$number_of_interaction."', actor_complexity='".$actor_complexity."',multiplying_factor='".$multiplying_factor."' ,uaw='".$uaw."' where serial_no='".$serial_no."'";
			else
				$sql ="insert into uaw(actor_id,number_of_interaction) values(".$actor_id.",".$number_of_interaction.")";
			$update = $conn->query($sql);
			if($result){
				header("location:index.php?id=7");
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
	<td><strong>Actor name</strong></td>
	<td><strong>Number of interaction</strong></td>
	</tr>
	<tr>
	<td><input name="serial_no" type="hidden" id="serial_no" value="<?php echo ($rows['serial_no']); ?>"></td>
	<td>
	<select name = "actor_id"><?php
	$select = $conn->query("Select * from actors");
	if($select->num_rows > 0){?>
		<option value = "<?php echo $rows["actor_id"]?>" ><?php foreach($select as $row1)
							if($rows["actor_id"] == $row1["actor_id"]){
								echo ($row1["actor_name"]);
								break;}?></option><?php
		foreach($select as $row){?>
			<option value = "<?php echo $row["actor_id"]?>"><?php echo $row["actor_name"]?></option><?php
		}
	}?>
	</td>
	<td><input name="number_of_interaction" type="text" id="number_of_interaction" value="<?php echo ($rows['number_of_interaction']); ?>"></td>
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