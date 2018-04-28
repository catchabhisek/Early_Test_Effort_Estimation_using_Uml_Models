<html>
	<head>
		<title>Software Testing</title>
		
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
        $effort_theor=0.0;
		$b0=50;
		$bsize=0.45;
		$kloc=0;

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error)
		{
			die("Connection failed: " . $conn->connect_error);
		}

		$tid = $_GET['id'];
		if($tid == 1)
			$sql = "Select * from projects order by pid";
		if($tid == 2)
			$sql = "Select * from use_case_diagrams";
		if($tid == 3)
			$sql = "Select * from project_ucd_mapping";
		if($tid == 4)
			$sql = "Select * from actors";
		if($tid == 5)
			$sql = "Select * from ucd_actor_mapping";
		if($tid == 6)
			$sql = "Select * from actor_complexity";
		if($tid == 7)
			$sql = "Select * from uaw";
		if($tid == 8)
			$sql = "Select * from use_cases";
		if($tid == 9)
			$sql = "Select * from uc_ucd_mapping";
		if($tid == 10)
			$sql = "Select * from use_case_complexity";
		if($tid == 11)
			$sql = "Select * from use_case_scenario_weight";
		if($tid == 12)
			$sql = "Select * from uucw";
		if($tid == 13)
			$sql = "Select * from technical_and_environmental_factors";
		if($tid == 14)
			$sql = "Select * from project_tef_mapping";
		if($tid == 15)
			$sql = "Select * from productivity_factor";
		if($tid == 16)
			$sql = "Select * from ucp_calculation";
		
		if($_SERVER["REQUEST_METHOD"] == "POST")
		{
			
			if($_POST['tblname'])
				$sql = "Select * from ".$_POST['tblname']." WHERE pid='".$_POST['spro']."'";
		}
		$result = $conn->query($sql);
		$select = $conn->query("Select * from projects order by pid");
		
		
	?>


	<div class="container" style="margin-top: 5%">
		<table style="width: 10%">
		<tr>
			<td><a class="btn btn-success" href="index.php?id=1" style="width: 100%" >Project</a></td>
			<td><a class="btn btn-success" href="index.php?id=2" style="width: 100%">Use Case Diagrams</a></td>
			<td><a class="btn btn-success" href="index.php?id=3"style="width: 100%">Project UCD Mapping</a></td>
			<td><a class="btn btn-success" href="index.php?id=4"style="width: 100%">Actors</a></td>
			</tr><tr>
			<td><a class="btn btn-success" href="index.php?id=5" style="width: 100%">UCD Actor Mapping</a></td>
			<td><a class="btn btn-success" href="index.php?id=6" style="width: 100%">Actor Complexity</a></td>
			<td><a class="btn btn-success" href="index.php?id=7" style="width: 100%">Unadjusted Actor Weight</a></td>
			<td><a class="btn btn-success" href="index.php?id=8" style="width: 100%">Use Cases</a></td>
			</tr><tr>
			<td><a class="btn btn-success" href="index.php?id=9" style="width: 100%">Use case diagrams - Use case Mapping</a></td>
			<td><a class="btn btn-success" href="index.php?id=10" style="width: 100%">Use Case Complexity</a></td>
			<td><a class="btn btn-success" href="index.php?id=11" style="width: 100%">Use Case Scenario weight</a></td>
			<td><a class="btn btn-success" href="index.php?id=12" style="width: 100%">Unadjusted Use Case Weight</a></td>
			</tr><tr>
			<td><a class="btn btn-success" href="index.php?id=13" style="width: 100%">Technical and Environmental Factors</a></td>
			<td><a class="btn btn-success" href="index.php?id=14" style="width: 100%">Project-TEF Mapping</a></td>
			<td><a class="btn btn-success" href="index.php?id=15" style="width: 100%">Productivity factor</a></td>
			<td><a class="btn btn-success" href="index.php?id=16" style="width: 100%">Use Case Point Calculation</a></td></tr>
			
		</table>
			
		<table class="table table-striped" style="width: 100%">
		<?php
			$tid = $_GET['id'];
			if($tid == 1){
				?><b>Project: </b><form method="post" action=""><select  name = "spro" id = "spro"><?php
				if($select->num_rows > 0){?>
					<option value = "" >Show All</option><?php
					foreach($select as $row){?>
						<option value = "<?php echo $row["pid"]?>"><?php echo $row["name"]?></option><?php
					}
				}?>
				<input name="tblname" type="hidden" id="tblname" value="projects">
				<input type="submit" name="sp"/>
				</select></form>
				<center><b>Project</b></center>
				<th>Project ID</th>
				<th>Project</th>
				<th>Update</th><?php
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						echo ($row["pid"]);
						echo '</td>';
						echo '<td>';
						echo ($row["name"]);
						echo '</td>';?>
						<td><a class="btn" href="update_projects.php?id=<?php echo ($row["pid"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td><a class="btn btn-success" href="update_projects.php?id=0">Add entry</a></td>';
			}
			else if($tid == 2){
				echo '<center><b>Use Case Diagrams</b>';
				echo '<th>UCD ID</th>';
				echo '<th>Name</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						echo ($row["ucd_id"]);
						echo '</td>';
						echo '<td>';
						echo ($row["name"]);
						echo '</td>';?>
						<td><a class="btn" href="update_ucd.php?id=<?php echo ($row["ucd_id"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td><a class="btn btn-success" href="update_ucd.php?id=0">Add entry</a></td>';
			}
			else if($tid == 3){
				?><b>Project: </b><form method="post" action=""><select name = "spro" id = "spro"><?php
				if($select->num_rows > 0){?>
					<option value = "" >Show All</option><?php
					foreach($select as $row){?>
						<option value = "<?php echo $row["pid"]?>"><?php echo $row["name"]?></option><?php
					}
				}?>
				<input name="tblname" type="hidden" id="tblname" value="project_ucd_mapping">
				<input type="submit" name="sp"/>
				</select></form><?php
				$result1 = $conn->query("Select * from projects");
				$result2 = $conn->query("Select * from use_case_diagrams");
				echo '<center><b>Project UCD Mapping</b>';
				echo '<th>Project Name</th>';
				echo '<th>UCD Name</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						foreach($result1 as $row1)
							if($row["pid"] == $row1["pid"]){
								echo ($row1["name"]);
								break;}
						echo '</td>';
						echo '<td>';
						foreach($result2 as $row2)
							if($row["ucd_id"] == $row2["ucd_id"]){
								echo ($row2["name"]);
								break;}
						echo '</td>';?>
						<td><a class="btn" href="update_project_ucd_mapping.php?id=<?php echo ($row["serial_no"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td><a class="btn btn-success" href="update_project_ucd_mapping.php?id=0">Add entry</a></td>';
			}
			else if($tid == 4){
				echo '<center><b>Actors</b>';
				echo '<th>Actor ID</th>';
				echo '<th>Name</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						echo ($row["actor_id"]);
						echo '</td>';
						echo '<td>';
						echo ($row["actor_name"]);
						echo '</td>';?>'
						<td><a class="btn" href="update_actors.php?id=<?php echo ($row["actor_id"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td>&nbsp;</td><td>&nbsp;</td>';
				echo '<td><a class="btn btn-success" href="update_actors.php?id=0" style="width: 30%">Add entry</a></td>';
			}
			else if($tid == 5){
				$result1 = $conn->query("Select * from actors");
				$result2 = $conn->query("Select * from use_case_diagrams");
				echo '<center><b>UCD Actor Mapping</b>';
				echo '<th>Actor Name</th>';
				echo '<th>UCD Name</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						foreach($result1 as $row1)
							if($row["actor_id"] == $row1["actor_id"]){
								echo ($row1["actor_name"]);
								break;}
						echo '</td>';
						echo '<td>';
						foreach($result2 as $row2)
							if($row["ucd_id"] == $row2["ucd_id"]){
								echo ($row2["name"]);
								break;}
						echo '</td>';?>
						<td><a class="btn" href="update_ucd_actor_mapping.php?id=<?php echo ($row["serial_no"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td><a class="btn btn-success" href="update_ucd_actor_mapping.php?id=0">Add entry</a></td>';
			}
			else if($tid == 6){
				echo '<center><b>Actor Complexity</b>';
				echo '<th>Serial no.</th>';
				echo '<th>Type</th>';
				echo '<th>Min. Value</th>';
				echo '<th>Max. Value</th>';
				echo '<th>Weight</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						echo ($row["serial_no"]);
						echo '</td>';
						echo '<td>';
						echo ($row["type"]);
						echo '</td>';
						echo '<td>';
						echo ($row["min_value"]);
						echo '</td>';
						echo '<td>';
						echo ($row["max_value"]);
						echo '</td>';
						echo '<td>';
						echo ($row["weight"]);
						echo '</td>';?>
						<td><a class="btn" href="update_actor_complexity.php?id=<?php echo ($row["serial_no"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td><a class="btn btn-success" href="update_actor_complexity.php?id=0" >Add entry</a></td>';
			}
			else if($tid == 7){
				$result1 = $conn->query("Select * from actors");
				echo '<center><b>Unadjusted Actor Weight</b>';
				echo '<th>Serial no.</th>';
				echo '<th>Actor name</th>';				
				echo '<th>Number of Interactions</th>';
				echo '<th>Actor complexity</th>';				
				echo '<th>Multiplying factor</th>';
				echo '<th>UAW</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						echo ($row["serial_no"]);
						echo '</td>';
						echo '<td>';
						foreach($result1 as $row1)
							if($row["actor_id"] == $row1["actor_id"]){
								echo ($row1["actor_name"]);
								break;}
						echo '</td>';
						echo '<td>';
						echo ($row["number_of_interaction"]);
						echo '</td>';
						echo '<td>';
						echo ($row["actor_complexity"]);
						echo '</td>';
						echo '<td>';
						echo ($row["multiplying_factor"]);
						echo '</td>';
						echo '<td>';
						echo ($row["uaw"]);
						echo '</td>';?>
						<td><a class="btn" href="update_uaw.php?id=<?php echo ($row["serial_no"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td><a class="btn btn-success" href="update_uaw.php?id=0">Add entry</a></td>';
			}
			else if($tid == 8){
				echo '<center><b>Use Cases</b>';
				echo '<th>UC ID</th>';
				echo '<th>Name</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						echo ($row["uc_id"]);
						echo '</td>';
						echo '<td>';
						echo ($row["uc_name"]);
						echo '</td>';?>
						<td><a class="btn" href="update_use_cases.php?id=<?php echo ($row["uc_id"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td><a class="btn btn-success" href="update_use_cases.php?id=0">Add entry</a></td>';
			}
			else if($tid == 9){
				$result1 = $conn->query("Select * from use_cases");
				$result2 = $conn->query("Select * from use_case_diagrams");
				echo '<center><b>Use case diagrams - Use case mapping</b>';
				echo '<th>UCD Name</th>';
				echo '<th>UC Name</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						foreach($result2 as $row2)
							if($row["ucd_id"] == $row2["ucd_id"]){
								echo ($row2["name"]);
								break;}
						
						echo '</td>';
						echo '<td>';
						foreach($result1 as $row1)
							if($row["uc_id"] == $row1["uc_id"]){
								echo ($row1["uc_name"]);
								break;}
						echo '</td>';?>
						<td><a class="btn" href="update_uc_ucd_mapping.php?id=<?php echo ($row["serial_no"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td><a class="btn btn-success" href="update_uc_ucd_mapping.php?id=0">Add entry</a></td>';
			}
			else if($tid == 10){
				echo '<center><b>Use Case Complexity</b>';
				echo '<th>Serial No</th>';
				echo '<th>Use case complexity</th>';
				echo '<th>Min. Value</th>';
				echo '<th>Max. Value</th>';
				echo '<th>Weight</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						echo ($row["serial_no"]);
						echo '</td>';
						echo '<td>';
						echo ($row["uc_complexity"]);
						echo '</td>';
						echo '<td>';
						echo ($row["min_value"]);
						echo '</td>';
						echo '<td>';
						echo ($row["max_value"]);
						echo '</td>';
						echo '<td>';
						echo ($row["weight"]);
						echo '</td>';?>
						<td><a class="btn" href="update_use_case_complexity.php?id=<?php echo ($row["serial_no"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td><a class="btn btn-success" href="update_use_case_complexity.php?id=0">Add entry</a></td>';
			}
			else if($tid == 11){
				echo '<center><b>Use Case Scenario Weight</b>';
				echo '<th>Serial No.</th>';
				echo '<th>Type of Scenario</th>';
				echo '<th>Weight</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						echo ($row["serial_no"]);
						echo '</td>';
						echo '<td>';
						echo ($row["type_of_scenario"]);
						echo '</td>';
						echo '<td>';
						echo ($row["weight"]);
						echo '</td>';?>
						<td><a class="btn" href="update_use_case_scenario_weight.php?id=<?php echo ($row["serial_no"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
			}
			else if($tid == 12){
				$result1 = $conn->query("Select * from use_cases");
				echo '<center><b>Unadjusted Use Case Weight</b>';
				echo '<th>Serial No.</th>';
				echo '<th>Use Case Name</th>';
				echo '<th>Normal Scenarios</th>';
				echo '<th>Exceptional Scenarios</th>';
				echo '<th>Complexity</th>';
				echo '<th>Multiplying Factor</th>';
				echo '<th>Use Case weight</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						echo ($row["serial_no"]);
						echo '</td>';
						echo '<td>';
						foreach($result1 as $row1)
							if($row["uc_id"] == $row1["uc_id"]){
								echo ($row1["uc_name"]);
								break;}
						echo '</td>';
						echo '<td>';
						echo ($row["normal_scenarios"]);
						echo '</td>';
						echo '<td>';
						echo ($row["exceptional_scenarios"]);
						echo '</td>';
						echo '<td>';
						echo ($row["complexity"]);
						echo '</td>';
						echo '<td>';
						echo ($row["multiplying_factor"]);
						echo '</td>';
						echo '<td>';
						echo ($row["uc_weight"]);
						echo '</td>';?>
						<td><a class="btn" href="update_uucw.php?id=<?php echo ($row["serial_no"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td><a class="btn btn-success" href="update_uucw.php?id=0">Add entry</a></td>';
			}
			else if($tid == 13){
				echo '<center><b>Technical and Environmental factors</b>';
				echo '<th>Factor Name</th>';
				echo '<th>Description</th>';
				echo '<th>Weight</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						echo ($row["factor_name"]);
						echo '</td>';
						echo '<td>';
						echo ($row["description"]);
						echo '</td>';
						echo '<td>';
						echo ($row["weight"]);
						echo '</td>';?>
						<td><a class="btn" href="update_technical_and_environmental_factors.php?id=<?php echo ($row["factor_id"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td><a class="btn btn-success" href="update_technical_and_environmental_factors.php?id=0">Add entry</a></td>';
			}
			else if($tid == 14){
				?><b>Project: </b><form method="post" action=""><select name = "spro" id = "spro"><?php
				if($select->num_rows > 0){?>
					<option value = "" >Show All</option><?php
					foreach($select as $row){?>
						<option value = "<?php echo $row["pid"]?>"><?php echo $row["name"]?></option><?php
					}
				}?>
				<input name="tblname" type="hidden" id="tblname" value="project_tef_mapping">
				<input type="submit" name="sp"/>
				</select></form><?php
				$result1 = $conn->query("Select * from projects");
				$result2 = $conn->query("Select * from technical_and_environmental_factors");
				echo '<center><b>Project TEF Mapping</b>';
				echo '<th>Project Name</th>';
				echo '<th>Factor Description</th>';
				echo '<th>Value</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						foreach($result1 as $row1)
							if($row["pid"] == $row1["pid"]){
								echo ($row1["name"]);
								break;}
						echo '</td>';
						echo '<td>';
						foreach($result2 as $row2)
							if($row["factor_id"] == $row2["factor_id"]){
								echo ($row2["description"]);
								break;}
						echo '</td>';
						echo '<td>';
						echo ($row["value"]);
						echo '</td>';?>
						<td><a class="btn" href="update_project_tef_mapping.php?id=<?php echo ($row["serial_no"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td><a class="btn btn-success" href="update_project_tef_mapping.php?id=0">Add entry</a></td>';
			}
			else if($tid == 15){
				$result1 = $conn->query("Select * from projects");
				echo '<center><b>Productivity Factor</b>';
				echo '<th>Project Name</th>';
				echo '<th>Productivity Factor</th>';
				echo '<th>Update</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						foreach($result1 as $row1)
							if($row["pid"] == $row1["pid"]){
								echo ($row1["name"]);
								break;}
						echo '</td>';
						echo '<td>';
						echo ($row["productivity_factor"]);
						echo '</td>';?>
						<td><a class="btn" href="update_productivity_factor.php?id=<?php echo ($row["pid"]); ?>" style="width: 30%">Edit</a></td><?php
						echo '</tr>';
					}
				}
				echo '<td><a class="btn btn-success" href="update_productivity_factor.php?id=0">Add entry</a></td>';
			}
			else if($tid == 16){
			$result1 = $conn->query("Select * from projects");
				echo '<center><b>Us Case Point Calculation</b>';
				echo '<th>Project Name</th>';
				echo '<th>UUCW</th>';
				echo '<th>UAW</th>';
				echo '<th>Adjusted UCP</th>';
				echo '<th>Technical and Environmental Factors</th>';
				echo '<th>UCP</th>';
				echo '<th>Productivity Factor</th>';
				echo '<th>Effort</th>';
				echo '<th>Feasibility</th>';
				if($result->num_rows > 0){
					echo '<tr>';
					foreach($result as $row){
						echo '<td>';
						foreach($result1 as $row1)
							if($row["pid"] == $row1["pid"]){
								echo ($row1["name"]);
								break;}
						echo '</td>';
						echo '<td>';
						echo ($row["uucw"]);
						echo '</td>';
						echo '<td>';
						echo ($row["uaw"]);
						echo '</td>';
						echo '<td>';
						echo ($row["aucp"]);
						echo '</td>';
						echo '<td>';
						echo ($row["tef"]);
						echo '</td>';
						echo '<td>';
						echo ($row["ucp"]);
						echo '</td>';
						echo '<td>';
						echo ($row["productivity_factor"]);
						echo '</td>';
						echo '<td>';
						echo ($row["effort"]);
						echo '</td>';
						if($row1["name"]=="Online Book Pubishing and Purchasing"){
							$kloc=1050;
							
						}
						else if($row1["name"]=="DVD Rental System"){
							
						}
						if($row["effort"]>={$bsize*$kloc+$b0}){
							
						echo '<td>';
						echo ("feasible");
                        echo '</td>';						
						}
						else{
						echo '<td>';
						echo ("not feasible");
                        echo '</td>';
						}
						echo '</tr>';
					}
				}
				echo '<tr><td><a class="btn btn-success" href="update_ucp_calculation.php">Calculate</a></td></tr>';
			}
			?>
		</table>
	</div>
	</body>
</html>
