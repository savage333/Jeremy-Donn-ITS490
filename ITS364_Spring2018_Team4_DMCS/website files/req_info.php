<?php
	session_start();
	require_once("dmcs_connect.php");

	/*
	if (isset($_POST["selectProjId"])) {	
		echo "<script>console.log('Current Project Id #: ".$_POST["selectProjId"]."');</script>";
		$_SESSION["currProjId"] = $_POST["selectProjId"];
		$currProjId = $_POST["selectProjId"];
	}
	*/
	if (isset($_POST["selectDisasName"])) {
		$_SESSION["currDisasName"] = $_POST["selectDisasName"];
	}
	
	if (isset($_POST["currDisasName"])) {
		$_SESSION["currDisasname"] = $_POST["currDisasName"];
	}

	if (isset($_GET["currDisasId"])) {
		$currDisasId = mysqli_real_escape_string($conn, $_GET["currDisasId"]);
	}
	
	if (isset($_SESSION["currDisasId"])) {
		$currDisasId = $_SESSION["currDisasId"];
	}
	
	if (isset($_POST["currReqId"])) {
		$currReqId = $_POST["currReqId"];
	}
	
	if (isset($_POST["currDisasId"])) {
		$currDisasId = $_POST["currDisasId"];
	}
	
	if (isset($_POST["currReqDesc"])) {
		$currReqDesc = $_POST["currReqDesc"];
	}
	
	if (isset($_POST["currReqTime"])) {
		$currReqTime = $_POST["currReqTime"];
	}
	
	if (isset($_POST["currReqType"])) {
		$currReqType = $_POST["currReqType"];
	}
	
	
	if (isset($_GET["currReqId"])) {	
		echo "<script>console.log('Current Request Id #: ".$_GET["currReqId"]."');</script>";
		//$_SESSION["currProjId"] = $_POST["selectProjId"];
		$currReqId = mysqli_real_escape_string($conn, $_GET["currReqId"]);
		//echo "<h3 style='color: white;'>".$currReqId."</h3>";

		$sqlCallGetPerson = "Call getPerson2(". $currDisasId .",". $currReqId .");";
		//echo "<h1 style='color: white;'>". $sqlCallGetPerson ."</h1>";
		$results = $conn->query($sqlCallGetPerson);
		if (!$results) {
			echo "<script>alert('There is no record of the specified user!');</script>";
		}
		else {
			$row = $results->fetch_assoc();
			$currClientName = $row["person_name"];
			$currClientId = $row["person_id"];
		}
		
		//$results->close();
		$conn->next_result();
		
		$sqlCallGetRequests = "Call getRequests3(". $currDisasId .",". $currReqId .");";
		//echo "<h1 style='color: white;'>". $sqlCallGetRequests ."</h1>";
		$res2 = $conn->query($sqlCallGetRequests);
		if (!$res2) {
			echo "<script>alert('There is no record for the specified request!');</script>";
		}
		else {
			$row2 = $res2->fetch_assoc();
			$currReqType = $row2["request_type"];
			$currReqDesc = $row2["request_desc"];
			$currReqTime = $row2["request_time"];
			$currReqStat = $row2["request_status"];
		}
		
		$conn->next_result();
	}
	
	if (isset($_POST["btSaveReqStat"])) {
		if ($_POST["reqStatus_dropdown"] == "open") {
			$sqlCallGetEncounter = "Call getEncounter($currReqId);";
			$results = $conn->query($sqlCallGetEncounter);
			if ($results) {
				$row = $results->fetch_assoc();
				$currProjId = $row["project_id"];
				
				$conn->next_result();
				
				$sqlCallDeleteProject = "Call deleteProject($currProjId);";
				$results = $conn->query($sqlCallDeleteProject);
				if ($results) {
					$conn->next_result();
					//echo "<script>alert('Project #$currProjId was deleted!');</script>";
					$sqlCallUpdateRequest = "CALL updateRequests(". $currReqId .",'open');";
					$results = $conn->query($sqlCallUpdateRequest);
					if ($results) {
						echo "<script>location='proj_index.php';</script>";
					}
					else {
						echo "Could not update request status!";
						echo $conn->errno ."--". $conn->error;
					}
				}
				else {
					echo "Could not delete current project!";
					echo $conn->errno ."-". $conn->error;
				}
				
			}
			else {
				echo "Could not retrieve project id for request #$currReqId!";
				echo $conn->errno ."--". $conn->error;
			}

		}
		else {
			$sqlCallUpdateRequest = "CALL updateRequests(". $currReqId .",'". $_POST["reqStatus_dropdown"] ."');";
			$results = $conn->query($sqlCallUpdateRequest);
			if(!$results){
				echo "Update Failed: ".mysqli_error($conn);
			}
			else{
				echo "<script>alert('Request status updated successfully!');</script>";
				echo "<script>location='proj_index.php';</script>";
			}
		}
	}
	
	if (isset($_POST["btDeleteReq"])) {
		//echo "<script>console.log('Delete request was pressed!');</script>";
		// request should be deleted from requests, encounter
		
		$sqlCallDeleteReq = "Call deleteRequests($currReqId);";
		if ($conn->query($sqlCallDeleteReq)) {
			echo "<script>alert('You have successfully deleted Request #$currReqId!');</script>";
			echo "<script>window.location.href='proj_index.php?disaster_dropdown=$currDisasId';</script>";
		}
		else {
			echo "Error deleting record: " . $conn->error;
		}
	
	}	
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="dmcs_styles.css">
		<style>
		table#group_report {
			border-collapse: collapse;
		}
		table#group_report td {
			/* border: 1px solid red; */
		}
		input[type="text"] {
			width: 90%;
			border-radius: 5px;
			border: 1px solid #A9A9A9;
			padding: 0.3em;
		}
		.button {
			width: 1em;
			background-color: #
		}
		.rowHead {
			font-family: "Century Gothic", Arial, sans-serif;
			font-weight: bolder;
			font-size: 0.9em;
			text-align: right;
		}
		#btDeleteProj {
			border: 0; 
			text-decoration: underline; 
			color: #FF8C00; 
			background: none; 
			cursor: pointer; 
			padding: 2em 0 2em 0;
			font-weight: bolder;
		}
		#memberList td {
			/* border: 1px solid blue; */
		}
		#btDeleteReq {
			border: 0; 
			text-decoration: underline; 
			color: #FF8C00; 
			background: none; 
			cursor: pointer; 
			padding: 2em 0 2em 0;
			font-weight: bolder;
		}
		</style>
		<script src="jquery-3.3.1.js"></script>
		<script>
			/*
			$(document).ready(function() {
				$("input[type=text]").attr("readonly", true);
				$("select").attr("disabled", true);
				$("input[type=button]").attr("disabled", true);

				//var acct_type = "vol";
				var acct_type = "<?php echo $_SESSION["currUser"]; ?>";
				$("#editReq").on("click", function() {
					//acct_type = "admin";
					if (acct_type == "admin") {
						$("input[type=text]").removeAttr("readonly");
						$("select").removeAttr("disabled");
						$("input[type=button]").removeAttr("disabled");
					}
					else {
						alert("You do not have administration privileges to edit this project!");
					}
				});
			});
			*/
		</script>
		<title>DMCS - <?php echo $_SESSION["currDisasName"]; ?></title>
	</head>
	<body>
		<div id="body-container">
				<?php 
					include "header.php";
					include "logout_row.php"; 
				?>
				<tr>
					<td style="padding-left: 1.5em; padding-right: 1.5em;">
						<h3 style="font-family: 'Century Gothic', Arial, sans-serif;"><span id="editReq" style="color: #FF8C00; cursor: pointer;">Request #<?php echo $currReqId ?> Details</span></h3>
						<form name="reqDetailsForm" id="regDetailsForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<input type="hidden" name="currReqId" value="<?php echo $currReqId ?>" />
						<input type="hidden" name="currDisasId" value="<?php echo $currDisasId ?>" />
						<table id="request_report" style="width: 100%; background-color: #FFDAB9; border-radius: 20px;">
							<tr>
								<td style="width: 20%;"><!-- used only to set column widths --></td>
								<td style="width: 80%;"><!-- used only to set column widths --></td>
							</tr>
							<tr>
								<td class="rowHead">Requested On</td>
								<td><?php echo $currReqTime ?></td>
								<input type="hidden" name="currReqTime" value="<?php $currReqTime ?>" />
							</tr>
							<tr>
								<td class="rowHead">Client Name</td>
								<td><?php echo $currClientName ?></td>
								<input type="hidden" name="currReqTime" value="<?php $currClientName ?>" />
							</tr>
							<tr>
								<td class="rowHead">Request Type</td>
								<td><?php echo $currReqType ?></td>
								<input type="hidden" name="currReqTime" value="<?php $currReqType ?>" />
							</tr>
							<tr>
								<td class="rowHead">Request Description</td>
								<td><?php echo $currReqDesc ?></td>
								<input type="hidden" name="currReqTime" value="<?php $currReqDesc ?>" />
							</tr>
							<tr>
								<td class="rowHead">Request Status</td>
								<td>
									<?php
										echo "<select name=\"reqStatus_dropdown\" id=\"reqStatus_dropdown\">";
										if ($currReqStat == "open") {
											echo "<option value=\"open\" selected>Open</option>";
											echo "<option value=\"in-progress\">In-Progress</option>";
											echo "<option value=\"closed\">Closed</option>";
										}
										if ($currReqStat == "in-progress") {
											echo "<option value=\"open\">Open</option>";
											echo "<option value=\"in-progress\" selected>In-Progress</option>";
											echo "<option value=\"closed\">Closed</option>";
										}
										if ($currReqStat == "closed") {
											echo "<option value=\"open\">Open</option>";
											echo "<option value=\"in-progress\">In-Progress</option>";
											echo "<option value=\"closed\" selected>Closed</option>";
										}
										echo "</select>";
									?>
									<input type="hidden" name="currReqStat" value="<?php $_POST["reqStatus_dropdown"]; ?>" />
									<input type="submit" class="green-button" name="btSaveReqStat" id="btSaveReqStat" value="Save" />
								</td>
							</tr>
							<tr>
								<td colspan="2"><!-- used as placeholder --></td>
							</tr>
						</table>
						<input type="submit" name="btDeleteReq" id="btDeleteReq" value="Delete this request" />
						</form>
					</td>
				</tr>
				<?php include "footer.php"; ?>
			</table>
		</div>
	</body>
</html>