<?php
	session_start();
	require_once("dmcs_connect.php");

	if (isset($_POST["selectProjId"])) {	
		$currProjId = $_POST["selectProjId"];
		$_SESSION["currProjId"] = $_POST["selectProjId"];
		echo "<script>console.log('Current Project Id #: ".$currProjId."');</script>";
	}
	
	if (isset($_GET["currProjId"])) {
		$currProjId = $_GET["currProjId"];
	}
	
	if (isset($_SESSION["currProjId"])) {
		$currProjId = $_SESSION["currProjId"];
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
	
	if (isset($_SESSION["currDisasId"])) {
		$currDisasId = $_SESSION["currDisasId"];
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
			$conn->next_result();
		}
	}
	
	if (isset($_POST["btAddTaskPressed"])) {
		if ($_POST["btAddTaskPressed"] == "true") {
			//echo "<script>alert('Current task description is: ". $_POST["selectTaskDesc"] ."');</script>";
			$sqlCallInsertTasks = "Call insertTasks('". $_POST["selectTaskDesc"] ."',". $currProjId.", @last_id);";
			$results = $conn->query($sqlCallInsertTasks);
			
			if (!$results) {
				echo "Error inserting into TASKS table!". $conn->errno ."==". $conn->error;
			}
			else {
				$res = $conn->query("Select @last_id as taskId");
				$row = $res->fetch_assoc();
				$lastTaskId = $row["taskId"];
				
				$sqlCallInsertGroupTasks = "Call insertGroup_Tasks(". $_POST["selectGroupId"] .",". $lastTaskId .");";
				//echo $sqlCallInsertGroupTasks;
				$results = $conn->query($sqlCallInsertGroupTasks);
				if (!$results) {
					echo "Error inserting into GROUP_TASKS table!". $conn->errno ."==". $conn->error;
				}
				else {
					echo "<script>alert('Task successfully << ADDED >> to the project!');</script>";
				}
			}	
			$conn->next_result();
		}
	}
	
	if (isset($_POST["btDeleteProj"])) {
		//echo "<script>console.log('Delete project was pressed!');</script>";
		// project should be deleted from PROJECT, PROJECT_LOCATION, TASKS, ENCOUNTER
		$sqlCallGetEncounter2 = "Call getEncounter2($currProjId);";
		$results = $conn->query($sqlCallGetEncounter2);
		if ($results) {
			$row = $results->fetch_assoc();
			$openReqId = $row["request_id"]; 
			
			$conn->next_result();
			
			$sqlCallUpdateRequest = "CALL updateRequests(". $openReqId .",'open');";
			$results = $conn->query($sqlCallUpdateRequest);
			if ($results) {
				$conn->next_result();
				
				$sqlCallDeleteProj = "Call deleteProject(". $currProjId .");";
				$results = $conn->query($sqlCallDeleteProj);
				if ($results) {
					echo "<script>alert('You have successfully deleted Project #$currProjId!');</script>";
					echo "<script>location='proj_index.php?disaster_dropdown=$currDisasId';</script>";
				}
				else {
					echo "Could not delete project!";
					echo $conn->errno ."--". $conn->error;
				}
			}
			else {
				echo "Could not update request status!";
				echo $conn->errno ."--". $conn->error;
			}
		}
		else {
			echo "Could not retrieve request id from encounter table!";
			echo $conn->errno ."--". $conn->error;
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
				font-family: "Century Gothic", Arial, sans-serif;
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
				$("input[type=submit]").attr("disabled", true);
				$("select").attr("disabled", true);
				
				//var acct_type = "vol";
				var acct_type = "<?php echo $_SESSION["currUser"]; ?>";
				$("#editProj").on("click", function() {
					if (acct_type == "admin") {
						$("input[type=text]").removeAttr("readonly");
						$("input[type=button]").removeAttr("disabled");
						$("input[type=submit]").removeAttr("disabled");
						$("select").removeAttr("disabled");
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
						<h3 style="font-family: 'Century Gothic', Arial, sans-serif;"><span id="editProj" style="color: #FF8C00; cursor: pointer;">Edit Project #<?php echo $currProjId ?></span></h3>
						<table id="project_report" style="width: 100%; background-color: #FFDAB9; border-radius: 20px;">
						<tr>
							<td style="width: 20%;"><!-- used only to set column widths --></td>
							<td style="width: 80%;"><!-- used only to set column widths --></td>
						</tr>
						<form name="projForm" id="projForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

						<?php
							$sqlGetProjRecord = "Call getProject_Location2(".$currProjId .");";
							//echo $sqlGetProjRecord;
							$results = $conn->query($sqlGetProjRecord);
							$row = $results->fetch_assoc();
							echo "<tr>
									<td class=\"rowHead\">Project Name</td>
									<td><input type=\"text\" style='width: 35em;' name=\"projName\" id=\"projName\" value='".$row["project_name"]."'/>
									<input type=\"submit\" class=\"green-button\" style=\"margin-left: 1.5em;\" name=\"btSaveProjName\" id=\"btSaveProjName\" value=\"Save\" />
									</td></tr>";
							echo "<tr><td class=\"rowHead\">Project Description</td>
									<td><input type=\"text\" style='width: 35em;' name=\"projDesc\" id=\"projDesc\" value='".$row["project_desc"]."'/>
									<input type=\"submit\" class=\"green-button\" style=\"margin-left: 1.5em;\" name=\"btSaveProjDesc\" id=\"btSaveProjDesc\" value=\"Save\" />
									</td></tr>";
							echo "<tr><td class=\"rowHead\">Project Location</td>
									<td><input type=\"text\" style='width: 35em;' name=\"projLoc\" id=\"projLoc\" value='".$row["location_address"]."' />";
								//	<input type=\"button\" class=\"green-button\" style=\"margin-left: 1.5em;\" name=\"btSaveProjLoc\" id=\"btSaveProjLoc\" value=\"Save\" />
							echo "</td></tr>";
							echo "<input type=\"hidden\" name=\"projInfo\" id=\"projInfo\" />";
							
							//$results->close();
							$conn->next_result();
							
							if ( isset($_POST["btSaveProjName"]) || isset($_POST["btSaveProjDesc"]) ) {
								$esc_projName = mysqli_real_escape_string($conn, $_POST["projName"]);
								$esc_projDesc = mysqli_real_escape_string($conn, $_POST["projDesc"]);
								$sqlCallUpdateProject = "Call updateProject(". $currProjId .",'". $esc_projName ."','". $esc_projDesc ."');";
								$results = $conn->query($sqlCallUpdateProject);
								if ($results) {
									echo "<script>alert('Project information was successfully changed!');</script>";
									echo "<script>location=document.referrer;</script>";
								}
								else {
									echo "<script>alert('error updating!');</script>";
									echo $conn->errno ."-". $conn->error;
								}
							}
						?>
						<tr>
							<td class="rowHead">
								Tasks & Groups<br/>
								<input type="button" style="margin-top: 0.5em; name="btNewTask" id="btNewTask" style="border-radius: 5px;" value="New Task" />
							</td>
							<td>
								<table id="TaskList" style="padding: 0; margin: 0; border-collapse: collapse; width: 90%; border: 1px solid #A9A9A9;">
									<?php
										$noAssignedTasks = 0; // initially false
										$sqlCallGetTasks = "Call getTasks2(".$currProjId .");";
										//echo $sqlCallGetTasks;
										
										$results = $conn->query($sqlCallGetTasks);
										if (!$results->num_rows > 0) {
											$noAssignedTasks = 1; // set true
											echo "There are no tasks assigned to this project.<br/>Click the left button to start adding tasks.";
										}
										else {
											while($row = $results->fetch_assoc()) {
												$sqlCallGetGroupTasks = "Call getGroup_Tasks2(". $row["task_id"] .");";
												$res2 = $conn2->query($sqlCallGetGroupTasks);
												//$res2 = $conn2->query($sqlGetGroupTasks);
												$row2 = $res2->fetch_assoc();
												$currGrp_Id = $row2["group_id"];
												
												echo "
												<tr>
													<td>
														<input type=\"text\" style=\"width: 100%;\" id=\"taskId\" name=\"".$row["task_id"]."\" value=\"". $row["task_desc"] ."\" />
													</td>
													<td style=\"width: 1px; white-space: nowrap;\">
												";
													
												if ($row2["group_id"] == null || $row2["group_name"] == null) {
													echo "<input type=\"button\" style=\"width: 10em;\" name=\"task". $row["task_id"] ."\" value=\"Assign Team\" onclick=\"location.href='group_info.php'\" />";
												}
												else {
													echo "<input type=\"button\" style=\"width: 10em;\" name=\"grp". $row2["group_id"] ."\" value=\"" . $row2["group_name"] ."\" onclick=\"location.href='group_info.php?currProjId=".$currProjId."&groupId=".$row2["group_id"]."'\" />";
												}
												echo "</td>
													<td style=\"text-align: left; width: 1px; white-space: nowrap;\"><input type=\"button\" class=\"red-button btDelTask\" name=\"".$row["task_id"]."\" value=\"Remove\" /></td>
												
												</tr>";
												
												$conn2->next_result();
											}	
											
											$conn->next_result();
										}
										echo "<input type=\"hidden\" name=\"currProjId\" id=\"currProjId\" value=\"". $currProjId."\" />";
										echo "<input type=\"hidden\" name=\"btDelTaskPressed\" id=\"btDelTaskPressed\" />";
									?>
								</table>
								
								<input type="hidden" name="selectTaskId" id="selectTaskId" />
								<input type="hidden" name="selectTaskDesc" id="selectTaskDesc" />
								<input type="hidden" name="selectGroupId" id="selectGroupId" />
								
								<script>
									var noTasks = "<?php echo $noAssignedTasks; ?>";
									function addCurrTask() {
										if (document.getElementById("currTaskDesc").value == null || document.getElementById("currTaskDesc").value == "" ) {
											alert("Please enter a task description!");
											return false;
										}
										else {
											document.getElementById("selectTaskDesc").value = document.getElementById("currTaskDesc").value;
											document.getElementById("selectTaskId").value = 1;
											document.getElementById("selectGroupId").value = document.getElementById("group_dropdown").value;
											//alert("the group id is: "+document.getElementById("selectGroupId").value);
											document.getElementById("btAddTaskPressed").value = "true";
											document.getElementById("projForm").submit();
										}
									}
									
									$(document).ready(function() {
										// adds new task row
										$("#btNewTask").on("click", function() {
											$("#TaskList").append("<tr><td><input type=\"text\" name=\"currTaskDesc\" id=\"currTaskDesc\" style=\"width: 100%;\" /></td><td><?php include 'group_dropdown.php'; ?></td><td><input type=\"button\" style=\"width: 100%;\" class=\"green-button\" value=\"Save\" onclick=\"addCurrTask()\" /></td></tr>");
										});
										
										// removes task 
										$(".btDelTask").on("click", function() {
											var hiddenTaskId = $(this).attr("name");
											console.log(hiddenTaskId);
											$("#btDelTaskPressed").val("true");
											$("#selectTaskId").val(hiddenTaskId);
											$("#projForm").submit();
										});
									});
								</script>
								<input type="hidden" name="btAddTaskPressed" id="btAddTaskPressed" />
							</td>
						</tr>
						<tr><td colspan="2"><!-- used as placeholder --></td></tr>
						</table>
						<!-- <h4><span id="delProj" style="text-decoration: underline; color: blue; cursor: pointer;">Delete this Project</span></h4> -->
						<input type="submit" name="btDeleteProj" id="btDeleteProj" value="Delete this project"></input>
						</form>
					</td>
				</tr>
				<?php include "footer.php"; ?>
			</table>
		</div>
	</body>
</html>