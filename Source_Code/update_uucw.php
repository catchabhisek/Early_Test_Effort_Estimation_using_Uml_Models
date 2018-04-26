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
		$sql = "Select * from uucw where serial_no = '".$id."'";
		$sql_uc = "Select * from use_case_complexity";
		$sql_ucs = "Select * from use_case_scenario_weight";
		$result = $conn->query($sql);
		$rows = $result->fetch_assoc();
		$result_uc = $conn->query($sql_uc);
		$rows_uc = $result_uc->fetch_assoc();
		$result_ucs = $conn->query($sql_ucs);
		$rows_ucs = $result_ucs->fetch_assoc();
		
		if($id == 0)
			$op = 1;
		else
			$op = 0;
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			$serial_no = $_POST["serial_no"];
			$uc_id = $_POST["uc_id"];
			$normal_scenarios = $_POST["normal_scenarios"];
			$exceptional_scenarios = $_POST["exceptional_scenarios"];
			foreach($result_uc as $rows_uc){
				if ($rows_uc["min_value"]<=($normal_scenarios+$exceptional_scenarios) && $rows_uc["max_value"]>=($normal_scenarios+$exceptional_scenarios)){
					$complexity = $rows_uc["uc_complexity"];
					$multiplying_factor = $rows_uc["weight"];
					foreach($result_ucs as $rows_ucs){
						if($rows_ucs["serial_no"] == 1)
							$ns=$normal_scenarios*$rows_ucs["weight"];
						if($rows_ucs["serial_no"] == 2)
							$es=$exceptional_scenarios*$rows_ucs["weight"];
					}

					$uc_weight = ($ns+$es)*$multiplying_factor;
					break;
				}
			}
			if ( $op==0)
				$sql ="update uucw SET uc_id='".$uc_id."',normal_scenarios='".$normal_scenarios."', exceptional_scenarios='".$exceptional_scenarios."', complexity='".$complexity."', multiplying_factor='".$multiplying_factor."' , uc_weight='".$uc_weight."' where serial_no='".$serial_no."'";
			else
				$sql ="insert into uucw(uc_id,normal_scenarios,exceptional_scenarios, complexity, multiplying_factor, uc_weight) values(".$uc_id.",".$normal_scenarios.",".$exceptional_scenarios.", '".$complexity."', ".$multiplying_factor.", ".$uc_weight.")";
			$update = $conn->query($sql);
			if($result){
				header("location:index.php?id=12");
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
	<td align="center"><strong>Use Case name</strong></td>
	<td align="center"><strong>Normal Scenarios</strong></td>
	<td align="center"><strong>Exceptional Scenarios</strong></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td align="center"><input name="serial_no" type="hidden" id="serial_no" value="<?php echo ($rows['serial_no']); ?>"></td>
	<td>
	<select name = "uc_id"><?php
		$select = $conn->query("Select * from use_cases");
		$sel = $select->fetch_assoc();
		if($select->num_rows > 0){?>
			<option value = "<?php echo $rows['uc_id'] ?>" ><?php foreach($select as $row1)
							if($rows["uc_id"] == $row1["uc_id"]){
								echo ($row1["uc_name"]);
								break;}?></option><?php
			foreach($select as $row){?>
				<option value = "<?php echo $row["uc_id"]?>"><?php echo $row["uc_name"]?></option><?php
			}
		}?>
	</td>
	<td align="center"><input name="normal_scenarios" type="text" id="normal_scenarios" value="<?php echo ($rows['normal_scenarios']); ?>"></td>
	<td align="center"><input name="exceptional_scenarios" type="text" id="exceptional_scenarios" value="<?php echo ($rows['exceptional_scenarios']); ?>"></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
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