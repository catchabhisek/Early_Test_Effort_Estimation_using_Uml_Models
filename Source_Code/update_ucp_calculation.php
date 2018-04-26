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
	$sql = "Select * from ucp_calculation";
	$sql_uucw1 = "SELECT * FROM (project_ucd_mapping inner JOIN uc_ucd_mapping on uc_ucd_mapping.ucd_id = project_ucd_mapping.ucd_id)inner join uucw on uucw.uc_id =uc_ucd_mapping.uc_id";
	$sqlp = "Select * from projects";
	$sql_uaw = "SELECT * FROM (project_ucd_mapping inner JOIN ucd_actor_mapping on ucd_actor_mapping.ucd_id = project_ucd_mapping.ucd_id)inner join uaw on uaw.actor_id =ucd_actor_mapping.actor_id";
	$sql_tef = "SELECT * FROM technical_and_environmental_factors inner JOIN project_tef_mapping on technical_and_environmental_factors.factor_id = project_tef_mapping.factor_id";
	$sql_pf = "Select * from productivity_factor";
	//ucp_calculation
	$result = $conn->query($sql);
	$conn->query("delete from ucp_calculation");
	$rows = $result->fetch_assoc();
	
	//uaw_calculation
	$result_uaw = $conn->query($sql_uaw);
	$rows_uaw = $result_uaw->fetch_assoc();
	
	//productivity_factor
	$result_pf = $conn->query($sql_pf);
	$rows_pf = $result_pf->fetch_assoc();
	
	//tef_calculation
	$result_tef = $conn->query($sql_tef);
	$rows_tef = $result_tef->fetch_assoc();
	
	//projects
	$resultp = $conn->query($sqlp);
	$rowsp = $resultp->fetch_assoc();
	
	//uucw
	$result_uucw1 = $conn->query($sql_uucw1);
	$rows_uucw1 = $result_uucw1->fetch_assoc();

	//Calculation
	$uucwc = 0;
	$uawc = 0;
	$tefc = 0;
	foreach($resultp as $rowsp){
		foreach($result_uucw1 as $rows_uucw1){
			if ($rows_uucw1["pid"] == $rowsp["pid"])
				$uucwc += $rows_uucw1["uc_weight"];
		}
		foreach($result_uaw as $rows_uaw){
			if ($rows_uaw["pid"] == $rowsp["pid"])
				$uawc += $rows_uaw["uaw"];
		}
		foreach($result_tef as $rows_tef){
			if ($rows_tef["pid"] == $rowsp["pid"])
				$tefc += $rows_tef["value"] * $rows_tef["weight"];
		}
		foreach($result_pf as $rows_pf){
			if ($rows_pf["pid"] == $rowsp["pid"])
				$pf = $rows_pf["productivity_factor"];
		}
		
		$tef = 0.60 +(0.01 * $tefc);
		$aucp = $uucwc + $uawc;
		$ucp = $aucp * $tef;
		$effort = $ucp * $pf;
		$sqlucp ="insert into ucp_calculation(pid,uucw,uaw,aucp,tef,ucp,productivity_factor,effort) values(".$rowsp["pid"].",".$uucwc.",".$uawc.",".$aucp.",".$tef.",".$ucp.",".$pf.",".$effort.")";
		var_dump ($sqlucp);
		$update = $conn->query($sqlucp);
		$uucwc = 0;
		$uawc = 0;
		$tefc = 0;
	}
	if($update){
		header("location:index.php?id=16");
	}

	else {
		echo "ERROR";
	}
?>