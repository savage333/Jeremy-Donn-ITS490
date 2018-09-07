<?php
	session_start();
	require_once("dmcs_connect.php");
	
	if (isset($_SESSION["currDisasId"])) {
		$currDisasId = $_SESSION["currDisasId"];
		
		$sqlgetDisasterName = "SELECT disaster_name FROM DISASTER WHERE disaster_id =". $currDisasId .";";
		$results = $conn->query($sqlgetDisasterName);
		$row = $results->fetch_assoc();
		
		$currDisasName = $row["disaster_name"];
		$_SESSION["currDisasName"] = $currDisasName;
		
		$results->close();
		$conn->next_result();
	}

	if (isset($_SESSION["currUser"])) {
		$sqlCallGetPerson = "Call getPerson('". $_SESSION["currUser"] ."');";
		$results = $conn->query($sqlCallGetPerson);
		if (!$results) {
			echo "<script>alert('There is no record of the specified user!');</script>";
		}
		else {
			$row = $results->fetch_assoc();
			$currClientName = $row["person_name"];
			$currPrsnId = $row["person_id"];
		}
		
		$results->close();
		$conn->next_result();
	}
	
	if (isset($_POST["btSubmitReq"])) {
		$date = date('Y-m-d H:i:s');
		$sqlCallInsertRequest = "Call insertRequests('". $date ."','". $_POST["reqTypeDropdown"] ."','". $_POST["reqDesc"]. "','open', @last_req_id);";
		//echo "<h1 style='color: white'>$sqlCallInsertRequest</h1>";
		
		$results = $conn->query($sqlCallInsertRequest);
		if(!$results){
			echo "Insert Failed: ".mysqli_error($conn);
		}
		else {
			$res2 = $conn->query("SELECT @last_req_id as reqId");
			$row2 = $res2->fetch_assoc();
			$lastReqId = $row2["reqId"];
			//echo "<h1 style='color: white'>". $sqlCallInsertRequest ."=". $lastReqId ."</h1>";
			
			$conn->next_result();
			
			//Insert into the encounter table
			$sqlCallInsertEncounter = "Call insertEncounter(". $currDisasId .",null,". $lastReqId .",". $currPrsnId .",@last_enc_id);";
			//echo "<h1 style='color: white'>$sqlCallInsertEncounter</h1>";
			
			$results = $conn->query($sqlCallInsertEncounter);
			if(!$results){
				echo "Encounter Insert Failed: ".mysqli_error($conn);
			}
			else{
				//echo "Encounter Inserted Successfully";
				echo "<script>alert('Your request has been successfully received! Please wait for a follow-up email to get the next steps.');</script>";
				echo "<script>location='dmcs_index.php?logout=true';</script>";
			}
		}
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="dmcs_styles.css">
		<style>
			.rowHead {
				font-family: "Century Gothic", Arial, sans-serif;
				font-weight: bolder;
				font-size: 0.9em;
				text-align: right;
			}
			#disasTitle a {
				color: #D3D3D3; 
				font-family: 'Century Gothic', Arial; 
				font-weight: lighter; 
				font-size: 2.5em;
				text-decoration: none;
				color: #D3D3D3;
			}	
		</style>
		<script src="jquery-3.3.1.js"></script>
		<script>
			// custom document level javascript/jquery here //
		</script>
		<title> 
			<?php echo $currDisasName ?>
		</title>
	</head>
	<body>
		<div id="body-container">
			<!-- <table style="width: 100%;"> -->
			<table id="header-container" style="width: 100%; border-collapse: collapse;">
				<tr>
					<td style="background-color: #000000; border-top: 1em solid #DC143C; border-bottom: 0.2em solid #DC143C; margin: 0;">
						<table style="width: 100%; float: left;">
							<tr>
								<td style="padding: 0; margin: 0;"> <!-- style="padding-top: 3.5em; padding-bottom: 3.5em;" -->
									<div style="padding-left: 0.5em; margin-top: 2em; display: inline-block;">
										&nbsp;
										<span id="disasTitle"><a href="proj_index.php"><?php echo $_SESSION["currDisasName"]; ?></a></span>
									</div>
									<a href="dmcs_index.php?logout=false"><img src="images/dmcs_logo.png" style="margin-right: 1em; height: 15%; width: auto; float: right;" /></a> 
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php include "logout_row.php"; ?>
				<tr>
					<td style="padding-left: 1.5em; padding-right: 1.5em;">
					<!-- START CONTENT HERE -->
						<h3 style="font-family: 'Century Gothic', Arial, sans-serif; color: #FF8C00;">
							Welcome <?php echo $currClientName ?>
						</h3>
						<form name="reqForm" id="reqForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<table id="project_report" style="border-collapse: collapse; width: 100%; background-color: #FFDAB9; border-radius: 20px;">
							<tr>
								<td style="width: 20%;"><!-- used only to set column widths --></td>
								<td style="width: 80%;"><!-- used only to set column widths --></td>
							</tr>
							<tr>
								<td class="rowHead">Please select your type of need:</td>
								<td>
									<select name="reqTypeDropdown" id="reqTypeDropdown">
										<option value="Rescue">Rescue</option>
										<option value="Medical">Medical</option>
										<option value="Supply">Supply</option>
										<option value="Other">Other</option>
									</select>
								</td>
							</tr>
							<tr>
								<td class="rowHead">Please explain or describe your need:</td>
								<td>
									<textarea style="width: 90%;" rows="5" name="reqDesc" id="reqDesc"></textarea>
								</td>
							</tr>
							<tr>
								<td><!-- purposely left empty --></td>
								<td style="padding-top: 0; padding-bottom: 0;">
									<table style="padding: 0; margin: 0; border-collapse: collapse; width: 90%;">
										<tr>
											<td style="text-align: center;">
												<input type="reset" class="red-button" name="btReset" id="btReset" value="Reset" />
												&nbsp;&nbsp;&nbsp;
												<input type="submit" class="green-button" name="btSubmitReq" id="btSubmitReq" value="Submit" />
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<tr><td><!-- purposely left empty --></td></tr>
						</table>
						</form>
					<!-- END CONTENT HERE -->
					</td>
				</tr>
				<?php include "footer.php" ?>
			</table>
		</div>
	</body>
</head>