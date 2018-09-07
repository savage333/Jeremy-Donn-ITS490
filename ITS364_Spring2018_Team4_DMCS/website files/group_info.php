<?php
	session_start();
	require_once("dmcs_connect.php");

	if (isset($_POST["selectProjId"])) {	
		echo "<script>console.log('Current Project Id #: ".$_POST["selectProjId"]."');</script>";
		$_SESSION["currProjId"] = $_POST["selectProjId"];
		$currProjId = mysqli_real_escape_string($conn, $_POST["selectProjId"]);
	}

	if (isset($_POST["selectDisasName"])) {
		$_SESSION["currDisasName"] = $_POST["selectDisasName"];
	}
	
	if (isset($_POST["currDisasName"])) {
		$_SESSION["currDisasname"] = $_POST["currDisasName"];
	}
	
	if (isset($_POST["currProjId"])) {
		$currProjId = $_POST["currProjId"];
		//echo "<script>alert('Current Project id is: " .$currProjId ."');</script>";
	}
	
	if (isset($_GET["currProjId"])) {
		$currProjId = $_GET["currProjId"];
		echo "<script>console.log('Current Proj Id is: $currProjId');</script>";
	}
	
	if (isset($_SESSION["currProjId"])) {
		$currProjId= $_SESSION["currProjId"];
	}
	
	if (isset($_GET["groupId"])) {
		echo "<script>console.log('Group id is: ". $_GET["groupId"] ."');</script>";
		$currGroupId = mysqli_real_escape_string($conn, $_GET["groupId"]);
	}
	
	if (isset($_POST["currGrpId"])) {
		$currGroupId = mysqli_real_escape_string($conn, $_POST["currGrpId"]);
	}
	
	if (isset($_POST["selectMemberId"])) {
		$currPrsnId = mysqli_real_escape_string($conn, $_POST["selectMemberId"]);
	}
	
	if (isset($_POST["btLeavePressed"])) {
		if ( $_POST["btLeavePressed"] == "true") {
			//echo "<script>alert('Leave button was pressed!');</script>";
			
			$sqlCallDeleteVolunteerGroups = "Call deleteVolunteer_Groups(". $currGroupId .",". $currPrsnId .");";
			//echo "<script>console.log('".$sqlCallDeleteVolunteerGroups."');</script>";
			$results = $conn->query($sqlCallDeleteVolunteerGroups);
			if ($results) {
				echo "<script>alert('Member successfully << REMOVED >> from the group!');</script>";
			}
			else {
				echo "Could not delete member from group!";
				echo $conn->errno ." - ". $conn->error;
			}
			
		}
	}
	
	if (isset($_POST["btJoinPressed"])) {
		if ( $_POST["btJoinPressed"] == "true") {
			//echo "<script>alert('Join button was pressed!');</script>";
			
			$sqlCallInsertVolunteerGroups = "Call insertVolunteer_Groups(". $currGroupId .",". $currPrsnId  .");";
			$results = $conn->query($sqlCallInsertVolunteerGroups);
			if ($results) {
				echo "<Script>alert('Member successfully << ADDED >> to the group!');</script>";
			}
			else {
				//echo "Could not add member from group!";
				//echo $conn->errno ." - ". $conn->error;
				echo "<script>alert('That individual is already a member of this group!');</script>";
			}
		}
	}
	if (isset($_POST["selectGrpLead"])) {
		$currGrpLead = $_POST["selectGrpLead"];
	}
	
	if (isset($_POST["btSaveChangePressed"])) {
		if ($_POST["btSaveChangePressed"]) {
			//echo "<h2 style='color: white;'>$currGrpLead</h2>";
			$sqlCallUpdateGroups = "Call updateGroups(". $currGroupId .",". $currGrpLead .");";
			//echo "<h2 style='color: white;'>$sqlCallUpdateGroups</h2>";
			$results = $conn->query($sqlCallUpdateGroups);
			if ($results) {
				echo "<Script>alert('New group leader successfully << CHANGED >>!');</script>";
			}
			else {
				echo "Could not change the group leader!";
				echo $conn->errno ." - ". $conn->error;
			}
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
		</style>
		<script src="jquery-3.3.1.js"></script>
		<script>
			/*
			$(document).ready(function() {
				$("input[type=text]").attr("readonly", true);
				$("select").attr("disabled", true);
				$("#btSaveProj").attr("disabled", true);
				$("#btDeleteProj").attr("disabled", true);
				
				$("input[type=button]").attr("disabled", true);
				$("#btAddMember").attr("disabled",true);
				$("#btDelTask").attr("disabled", true);
				
				//var acct_type = "vol";
				var acct_type = "<?php echo $_SESSION["currUser"]; ?>";
				$("#editGroup").on("click", function() {
					//acct_type = "admin";
					if (acct_type == "admin") {
						$("input[type=text]").removeAttr("readonly");
						$("select").removeAttr("disabled");
						$("#btSaveProj").removeAttr("disabled");
						$("#btDeleteProj").removeAttr("disabled");
						
						$("input[type=button]").removeAttr("disabled");
						$("#btAddMember").removeAttr("disabled");
						$("#btDelTask").removeAttr("disabled");
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
						<?php
							$sqlCallgetGroups = "Call getGroups(". $currGroupId .");";
							$results = $conn->query($sqlCallgetGroups);
							$row = $results->fetch_assoc();
						?>
						<h3 style="font-family: 'Century Gothic', Arial, sans-serif;"><span id="editGroup" style="color: #FF8C00; cursor: pointer;"><?php echo $row["group_name"] ?></span></h3>
						<table id="group_report" style="width: 100%; background-color: #FFDAB9; border-radius: 20px;">
						<tr>
							<td colspan="2"><!-- used only to set column widths --></td>
						</tr>
						<form name="groupForm" id="groupForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<input type="hidden" name="currProjId" value="<?php echo $currProjId ?>" /> 
						
						
						<!-- <input type="hidden" name="currDisaster" value="<?php //echo $currDisasName; ?>" /> -->
						<?php
							$currGrpLead = mysqli_real_escape_string($conn, $row["person_id"]);
							echo "<input type=\"hidden\" name=\"currGrpLead\" value=". $currGrpLead ." />";
							$sqlCallgetGroup_Location = "Call getGroup_Location(". $currGroupId .");";
							$res2 = $conn2->query($sqlCallgetGroup_Location);
							$row2 = $res2->fetch_assoc();

							echo "<tr><td class=\"rowHead\">Description</td><td><input type=\"text\" name=\"grpDesc\" value='".$row["group_desc"]."'/></td></tr>";
							echo "<tr><td class=\"rowHead\">Location</td><td><input type=\"text\" name=\"grpLoc\" value='". $row2["location_address"]."'/></td></tr>";
							echo "<tr>
									<td class=\"rowHead\">Leader<br/></td>
									<td>"; 
									include "employee_dropdown.php";
							
							echo "<input type=\"button\" class=\"green-button\" style=\"margin-left: 1.5em;\" name=\"btChangeLead\" id=\"btChangeLead\" value=\"Change\" />";
							echo "</td>
								</tr>";
							
							// <input type=\"text\" style=\"width: 16em; margin-right: 1.5em;\" name=\"grpLead\" value='".$row["person_name"]."'/>";
							$results->close();
							//$res2->close();
							$conn->next_result();
							//$conn2->next_result();
							
						?>
						<input type="hidden" name="selectGrpLead" id="selectGrpLead" />
						<input type="hidden" name="btSaveChangePressed" id="btSaveChangePressed" />
						<script>
							$(document).ready(function() {
								$("#btChangeLead").on("click", function() {
									$("#selectGrpLead").val($("#employee_dropdown").val());
									//alert($("#selectGrpLead").val());
									$("#btSaveChangePressed").val("true");
									$("#groupForm").submit();
								});
							});
						</script>
						<tr>
							<td class="rowHead">
								Members<br/>
								<input type="button" style="margin-top: 0.5em;" name="btAddMember" id="btAddMember" style="border-radius: 5px;" value="Add" />
							</td>
							<td>
								<table id="memberList" style="width: 90%; padding: 0; margin: 0; border-collapse: collapse; border: 1px solid #A9A9A9;">
									<?php
										$sqlCallgetVolunteerGroups = "Call getVolunteer_Groups(". $currGroupId .");";
										//echo $sqlCallgetVolunteerGroups;
										$results = $conn->query($sqlCallgetVolunteerGroups);

										if (!$results->num_rows > 0) {
											echo "<tr><td colspan='2'>No members found for this group!</td></tr>";
										}
										else {
											while($row = $results->fetch_assoc()) {
												echo "
												<tr>
													<td style=\"width: 95%;\">
														<input type=\"text\" name=\"".$row["person_id"]."\" style=\"width: 100%;\" value=\"". $row["person_name"] ."\" />
													</td>
													<td>
														<input type=\"button\" class=\"red-button btLeave\" id=\"btLeave\" name=\"". $row["person_id"] ."\" value=\"Remove\"  />
													</td>
												</tr>";
											}
										}
										
										echo "<input type=\"hidden\" name=\"currGrpId\" id=\"currGrpId\" value=\"". $currGroupId ."\" />";
										echo "<input type=\"hidden\" name=\"btLeavePressed\" id=\"btLeavePressed\" />";
										
										//$results->close();
										//$conn->next_result();
									?>
								</table>
								
								<input type="hidden" name="selectMemberId" id="selectMemberId" />

								<script>
									function memberJoin() {
										//var selectMemberId = document.getElementById("volunteer_dropdown").value;
										document.getElementById("selectMemberId").value = document.getElementById("volunteer_dropdown").value;
										//console.log("current member id is: "+document.getElementById("selectMemberId").value);
										document.getElementById("btJoinPressed").value = "true";
										document.getElementById("groupForm").submit();
									}

									$(document).ready(function() {
										// add a new member row
										$("#btAddMember").on("click", function() {
											$("#memberList").append("<tr><td><?php include 'volunteer_dropdown.php'; ?></td><td><input type='button' class='green-button btJoin' name='btJoin' value='Join' onclick='memberJoin()' /></td></tr>");
										});

										// removes current member from the group
										$(".btLeave").on("click", function() {
											//var hiddenPersonId = $(this).attr("name");
											var hiddenPersonId = $(this).attr("name");
											console.log(hiddenPersonId);
											//alert(hiddenPersonId);
											$("#btLeavePressed").val("true");
											$("#selectMemberId").val(hiddenPersonId);
											$("#groupForm").submit();
										});
										
									});
								</script>
								<input type="hidden" name="btJoinPressed" id="btJoinPressed" />
							</td>
						</tr>
						<tr><td colspan="2"><!-- used as placeholder --></td></tr>
						</table>
						</form>
						<br/><br/>
					</td>
				</tr>
				<?php include "footer.php"; ?>
			</table>
		</div>
	</body>
</html>