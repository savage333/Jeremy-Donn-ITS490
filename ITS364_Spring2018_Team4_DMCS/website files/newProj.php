<?php
	session_start();
	require_once("dmcs_connect.php");

	if (isset($_GET["currReqId"])) {
		//echo "This is an open request!";
		$currReqId = mysqli_real_escape_string($conn, $_GET["currReqId"]);
	}
	
	if (isset($_GET["currDisasId"])) {
		$currDisasId = mysqli_real_escape_string($conn, $_GET["currDisasId"]);
	}
	
	if (isset($_SESSION["currDisasId"])) {
		$currDisasId = $_SESSION["currDisasId"];
	}
	
	if (isset($_POST["currReqId"])) {
		//echo "This is an open request!";
		$currReqId = $_POST["currReqId"];
	}
	
	if (isset($_SESSION["currUser"])) {
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
		
		$results->close();
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
		}
	}

	if (isset($_POST["selectDisasName"])) {
		$_SESSION["currDisasName"] = $_POST["selectDisasName"];
	}
	
	if (isset($_POST["currDisasName"])) {
		$_SESSION["currDisasname"] = $_POST["currDisasName"];
	}

	if (isset($_POST["currProjId"])) {
		$currProjId = $_POST["currProjId"];
	}
	
	if (isset($_POST["selectTaskId"])) {
		$currTaskId = $_POST["selectTaskId"];
	}
	
	if (isset($_POST["btDelTaskPressed"])) {
		if ($_POST["btDelTaskPressed"] == "true") {
			$sqlCallDeleteTasks = "Call deleteTasks(". $currProjId.",". $currTaskId .");";
			//echo "<script>alert('Remove button was pressed for task #". $currTaskId ."');</script>";
			
			$results = $conn->query($sqlCallDeleteTasks);
			if ($results) {
				echo "<script>alert('Task successfully << REMOVED >> from the project!');</script>";
			}
			else {
				echo "Could not remove the task from the project!";
				echo $conn->errno ." - ". $conn->error;
			}
		}
	}
	
	if (isset($_POST["btAddTaskPressed"])) {
		if ($_POST["btAddTaskPressed"] == "true") {
			//echo "<script>alert('Current task description is: ". $_POST["selectTaskDesc"] ."');</script>";
			$esc_selectTaskDesc = mysqli_real_escape_string($conn, $_POST["selectTaskDesc"]);
			$sqlCallInsertTasks = "Call insertTasks('". $esc_selectTaskDesc ."',". $currProjId.", @last_id);";
			$results = $conn->query($sqlCallInsertTasks);
			
			if (!$results) {
				echo "Error inserting into TASKS table!". $conn->errno ."==". $conn->error;
			}
			else {
				$res = $conn->query("Select @last_id as taskId");
				$row = $res->fetch_assoc();
				$lastTaskId = $row["taskId"];
				$esc_selectGroupId = mysqli_real_escape_string($conn, $_POST["selectGroupId"]);
				$sqlCallInsertGroupTasks = "Call insertGroup_Tasks(". $esc_selectGroupId .",". $lastTaskId .");";
				//echo $sqlCallInsertGroupTasks;
				$results = $conn->query($sqlCallInsertGroupTasks);
				if (!$results) {
					echo "Error inserting into GROUP_TASKS table!". $conn->errno ."==". $conn->error;
				}
				else {
					echo "<script>alert('Task successfully << ADDED >> to the project!');</script>";
				}
			}		
		}
	}
	
	if ( isset($_POST["btSaveNewProj"]) ) {
		if ( isset($_POST["projName"]) || isset($_POST["projDesc"]) ) {
			$esc_projName = mysqli_real_escape_string($conn, $_POST["projName"]);
			$esc_projDesc = mysqli_real_escape_string($conn, $_POST["projDesc"]);
			$sqlCallInsertProject = "Call insertProject('". $esc_projName ."','". $esc_projDesc ."', @last_proj_id);";
			//echo "<h1 style='color: orange'>". $sqlCallInsertProject ."</h1>";
			$results = $conn2->query($sqlCallInsertProject);
			if ($results) {
				$res2 = $conn2->query("Select @last_proj_id as projId");
				$row2 = $res2->fetch_assoc();
				$lastProjId = $row2["projId"];
				//echo "<script>alert('New Project #$lastProjId was successfully created! Please click the \"Next\" button below.');</script>";
				
				$conn2->next_result();
				
				$esc_locDesc = mysqli_real_escape_string($conn, $_POST["locDesc"]);
				$esc_locAdd = mysqli_real_escape_string($conn, $_POST["locAdd"]);
				$sqlCallInsertLocation = "Call insertLocation('". $esc_locDesc ."','". $esc_locAdd ."', @last_loc_id);";
				$res2 = $conn2->query($sqlCallInsertLocation);
				if ($res2) {
					//echo "<script>alert('New Project #". $lastProjId ." was successfully created! Please click the \"Next\" button below.');</script>";
					
					$res2 = $conn2->query("SELECT @last_loc_id as locId");
					$row2 = $res2->fetch_assoc();
					$lastLocId = $row2["locId"];
					
					$conn2->next_result();
					
					$sqlCallInsertProjLoc = "Call insertProject_Location(". $lastProjId .",". $lastLocId .");";
					$res2 = $conn2->query($sqlCallInsertProjLoc);
					if ($res2) {
						//echo "<script>New Project information has successfully been saved!</script>";
						
						$conn2->next_result();
						
						//$sqlCallInsertEncounter = "Call insertEncounter(currDisasId, lastProjId, currReqId,  )";
						$sqlCallUpdateRequests = "Call updateRequests(". $currReqId .", 'in-progress');";
						$res2 = $conn2->query($sqlCallUpdateRequests);
						if ($res2) {
							//echo "<script>alert('Request status has been updated!');</script>";
							//header("Location: proj_index.php?disasterId=".$currDisasId);
							$conn2->next_result();
							
							$sqlCallUpdateEncounter = "Call updateEncounter($currDisasId, $lastProjId, $currReqId, $currClientId);";
							//echo "<h1 style='color: white;'>$sqlCallUpdateEncounter</h1>";
							$res2 = $conn2->query($sqlCallUpdateEncounter);
							if ($res2) {
								echo "<script>alert('New project information successfully saved!');</script>";
								echo "<script>location='proj_info.php?currProjId=$lastProjId';</script>";
							}
							else {
								echo "<h3 style='color: orange;'>Error updating table Encounter: ".$conn2->errno ."-->". $conn2->error ."</h3>";
							}
						}
						else {
							echo "<h3 style='color: orange;'>Error updating table Requests: ".$conn2->errno ."-->". $conn2->error ."</h3>";
						}
					}
					else {
						echo "<h3 style='color: orange;'>Error inserting into table Project_Location: ".$conn2->errno ."-->". $conn2->error ."</h3>";
					}
				}
				else {
					echo "<h3 style='color: orange;'>Error inserting into table Location: ".$conn2->errno ."-->". $conn2->error ."</h3>";
				}
			}
			else {
				echo "<h3 style='color: orange;'>Error inserting into table Project: ".$conn2->errno ."-->". $conn2->error ."</h3>";
			}	
		}
	}
		
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="dmcs_styles.css">
		<style>
		table#project_report {
			border-collapse: collapse;
		}
		table#project_report td {
			/* border: 1px solid blue; */
		}
		input[type="text"] {
			width: 90%;
			border-radius: 5px;
			border: 1px solid #A9A9A9;
			padding: 0.3em;
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
		#TaskList td {
			/* border: 1px solid blue; */
		}

		</style>
		<script src="jquery-3.3.1.js"></script>
		<script>
			/*
			$(document).ready(function() {
				$("input[type=text]").attr("readonly", true);
				$("input[type=button]").attr("disabled", true);
				$("select").attr("disabled", true);
				//$(".projLocInfoRow").hide();
				//$(".projTaskGroupRow").hide();

				var acct_type = "<?php echo $_SESSION["currUser"]; ?>";
				$("#editProj").on("click", function() {
					//acct_type = "admin";
					if (acct_type == "admin") {
						$("input[type=text]").removeAttr("readonly");
						$("input[type=button]").removeAttr("disabled");
						$("select").removeAttr("disabled");
					}
					else {
						alert("You do not have administration privileges to edit this project!");
					}
				});
				
				$("#btSaveProjInfo").on("click", function() {
					
					$(".projInfoRow").hide();
					$(".projLocInfoRow").show();
				});
				
				$("#btSaveNewProj").on("click", function() {
					$(".projLocInfoRow").hide();
					$(".projTaskGroupRow").show();
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
						<h3 style="font-family: 'Century Gothic';"><span id="editProj" style="color: #FF8C00; cursor: pointer;">New Project for Request #<?php echo $currReqId; ?></span></h3>
						<table id="project_report" style="width: 100%; background-color: #FFDAB9; border-radius: 20px;">
						<tr>
							<td style="width: 20%;"><!-- used only to set column widths --></td>
							<td style="width: 80%;"><!-- used only to set column widths --></td>
						</tr>
						<form name="projForm" id="projForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<tr>
							<td class="rowHead">Client Name</td>
							<td><?php echo $currClientName ?></td>
						</tr>
						<tr>
							<td class="rowHead">Request Type</td>
							<td><?php echo $currReqType ?></td>
						</tr>
						<tr>
							<td class="rowHead">Request Description</td>
							<td><?php echo $currReqDesc ?></td>
						</tr>
						<tr class="projInfoRow">
							<input type="hidden" name="currReqId" value="<?php echo $currReqId ?>"/>
							<td class="rowHead">Project Name</td>
							<td><input type="text" style='width: 90%;' name="projName" id="projName" /></td>
						</tr>
						<tr class="projInfoRow">
							<td class="rowHead">Project Description</td>
							<td><input type="text" style='width: 90%;' name="projDesc" id="projDesc"></td>
						</tr>
						<tr class="projLocInfoRow">
							<td class="rowHead">Location Address</td>
							<td><input type="text" style='width: 90%;' name="locAdd" id="locAdd"></td>
						</tr>
						<tr class="projLocInfoRow">
							<td class="rowHead">Location Description</td>
							<td><input type="text" style='width: 90%;' name="locDesc" id="locDesc"></td>
						</tr>
						<tr class="projLocInfoRow">
							<td><!-- purposely left empty --></td>
							<td style="padding-top: 0; padding-bottom: 0;">
								<table style="padding: 0; margin: 0; border-collapse: collapse; width: 90%;">
									<tr>
										<td style="text-align: center;">
											<input type="reset" class="red-button" name="btReset" id="btReset" value="Reset" />
											&nbsp;&nbsp;&nbsp;
											<input type="submit" class="green-button" name="btSaveNewProj" id="btSaveNewProj" value="Save" />
										</td>
									</tr>
								</table>
							</td>
						</tr>
						<script>
							$(document).ready(function() {
								$("#btSaveProjName").on("click", function() {
									//alert($("#projName").val() + " " + $("#projDesc").val());
									$("#projInfo").val( $("#projName").val() );
									$("#projForm").submit();
								});
							});
						</script>

						<tr><td colspan="2"><!-- used as placeholder --></td></tr>
						</table>
						</form>
					</td>
				</tr>
				<?php include "footer.php"; ?>
			</table>
		</div>
	</body>
</html>