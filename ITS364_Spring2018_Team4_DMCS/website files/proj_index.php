<?php
	session_start();
	require_once("dmcs_connect.php");
	
	if (isset($_GET["disasterId"])) {
		$_SESSION["currDisasId"] = $_GET["disasterId"];
		$currDisasId = mysqli_real_escape_string($conn, $_GET["disasterId"]);
	}
	
	if (isset($_SESSION["currDisasId"])) {
		$currDisasId = $_SESSION["currDisasId"];
		$sqlgetDisasterName = "SELECT disaster_name FROM DISASTER WHERE disaster_id =". mysqli_real_escape_string($conn, $_SESSION['currDisasId']).";";
		$results = $conn->query($sqlgetDisasterName);
		$row = $results->fetch_assoc();
		$_SESSION["currDisasName"] = $row["disaster_name"];
		$results->close();
		$conn->next_result();
	}
	
	if (isset($_POST["currDisasName"])) {
		$_SESSION["currDisasName"] = $_POST["currDisasName"];
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="dmcs_styles.css">
		<style>
			#currProj, #currReq {
				border-collapse: collapse;
				border: 1px solid #D3D3D3;
				width: 100%;
			}
			table#currProj, table#currReqList {
				border-collapse: collapse;
			}
			#currProj, #currReq {
				font-family: Arial, sans-serif;
				font-size: 0.9em;
			}
			#currProj tr:hover td, #currReq tr:hover td {
				background-color: #D3D3D3;
			}
			#currProj td:hover, #currReq td:hover {
				cursor: pointer;
			}
			#currProj a {
				text-decoration: none;
				font-weight: bolder;
				color: #000000;
			}
			h4 a {
				color: #FF8C00;
				font-family: "Century Gothic", Arial, sans-serif;
			}
			#btNewProj {
				border: 0; 
				text-decoration: underline; 
				color: #FF8C00; 
				background: none; 
				cursor: pointer; 
				padding: 2em 0 2em 0;
				font-weight: bolder;
				font-size: 1em;
			}
			#currProj td, #currProj tr {
				/* border: 1px solid black; */
			} 
			#currReq td, #currReq tr {
				/* border: 1px solid black; */
			}
			#currProj th, #currReq th {
				padding: 0.5em;
			}
			.noButton {
				border: 0;
				color: green;
				font-size: 1em;
				font-weight: bolder;
			}
			#reqTitle, #projTitle, #grpTitle {
				margin: 0;
				padding: 0.3em;
				font-family: 'Century Gothic', Arial, sans-serif;
				color: #FF8C00;
			}
			#reqTitle:hover, #projTitle:hover {
				background-color: #FF8C00;
				color: white;
			}
		</style>
		<script src="jquery-3.3.1.js"></script>
		<script>
			$(document).ready(function() {
				//$("#currReqList").hide();
				//$("#currProjList").hide();
				
				$("#reqTitle").on("click", function() {
						$("#currReqList").toggle();;
				});
				
				$("#projTitle").on("click", function() {
					$("#currProjList").toggle();
				});
			});
		</script>
		<title>DMCS - <?php echo $_SESSION["currDisasName"]; ?></title>
	</head>
	<body>
		<div id="body-container">
				<?php 
					include "header.php";
					include "logout_row.php"; ?>
				<tr>
					<td style="padding-left: 1.5em; padding-right: 1.5em; padding-top: 0;">
						<h3 id="reqTitle">Requests</h3>
						<form name="currReqList" id="currReqList" method="post">
							<table id="currReq">
								<th style="text-align: left; background-color: #DC143C; color: white; font-weight: bold;">Request ID - Time</th>
								<th style="text-align: left; background-color: #DC143C; color: white; font-weight: bold;">Request Type</th>
								<th style="text-align: left; background-color: #DC143C; color: white; font-weight: bold;">Requested By</th>
								<th style="text-align: left; background-color: #DC143C; color: white; font-weight: bold;">Request Status</th>
								<!-- <tr class="projRow"><td>Ticket Number</td><td>Request Desc</td><td>Request Stat</td></tr> -->
								<?php
									$sqlCallGetRequests = "Call getRequests2(". $currDisasId .")";
									$results = $conn->query($sqlCallGetRequests);

									if (!$results) {
										echo "Error retrieving requests!" . $conn->errno ."-". $conn->error;
									}
									else {
										$row_count = 0;
										if (!$results->num_rows > 0) {
											$NoReqResults = true;
											echo "<tr class='projRow' disabled><td colspan=\"4\" style='text-align: center; font-weight: bold; background-color: #FFFFFF;'>There are no existing requests for this disaster!</td></tr>";
										}
										else {
											while ($row = $results->fetch_assoc()) {
												$NoReqResults = false;
												$row_count++;
												if ($row_count % 2 == 0) {
													$rowBgColor = "#FFDAB9";
												}
												else {
													$rowBgColor = "#FFFFFF";
												}
												
												echo "<tr class=\"projRow\" style='background-color:$rowBgColor;'>
												<td><input type=\"hidden\" class=\"reqId\" name=\"". $row["request_id"] ."\" />". $row["request_id"] ." - ". $row["request_time"] ."</td>
												<td>". $row["request_type"] ."</td>
												<td>". $row["person_name"] ."</td>
												<td>";
												
												/*
												if ($row["request_status"] == null) {
													echo "open";
												}
												else {*/
													echo "<input type=\"hidden\" class=\"reqStat\" name=\"". $row["request_status"] ."\" />". $row["request_status"];
												//}
												if ($row["request_status"] == "open") {
													$isOpenReq = true;
												}
												
												echo "</td></tr>";
											}
										}
									}
									
									$results->close();
									$conn->next_result();
								?>
								<input type="hidden" name="selectReqId" id="selectReqId" />
								<input type="hidden" name="selectReqStat" id="selectReqStat" />
								<input type="hidden" name="currDisasId" id="currDisasId" value="<?php echo $currDisasId ?>" />
								<input type="hidden" name="selectReqPrsn" id="selectReqPrsn" />
								
								<script>
									var NoReqResults = "<?php echo $NoReqResults; ?>";
									$(document).ready(function() {
										if (!NoReqResults) {
											$("#currReq tr:has(td)").on("click", function() {
												var currReqId = $(this).find(".reqId").attr("name");
												var currDisasId = $("#currDisasId").val();
												var currReqStat = $(this).find(".reqStat").attr("name");
												
												//alert(currReqId + " is " + currReqStat);
												//console.log(selectedReqId);
												$("#selectReqId").val(currReqId);
												//console.log($("#selectReqId").val());
												
												if (currReqStat == "open") {
													$(location).attr("href", "newProj.php?currReqId="+currReqId+"&currDisasId="+currDisasId);
													
												}
												else {
													$(location).attr("href", "req_info.php?currReqId="+ currReqId);
												}													
											});
										}
										
									});
								</script>
							</table>
						</form>
						<input type="hidden" name="currReqId" id="currReqId" />
					</td>
				</tr>
				<tr>
					<td style="padding-left: 1.5em; padding-right: 1.5em; padding-top: 0;">
						<h3 id="projTitle">Projects</h3>
						<form name="currProjList" id="currProjList" method="post" action="proj_info.php">
							<table id="currProj">
								<th style="text-align: left; background-color: #DC143C; color: white; font-weight: bold;">Project ID - Name</th>
								<th style="text-align: left; background-color: #DC143C; color: white; font-weight: bold;">Project Description</th>
								<th style="text-align: left; background-color: #DC143C; color: white; font-weight: bold;">Project Status</th>
								<?php
									$sqlCallGetProject = "Call getProject(". $currDisasId .");";
									//echo $sqlCallGetProject;
									if(!$res = $conn->query($sqlCallGetProject)) {
										return $conn->errno."-".$conn->error;
										//echo "no results found!";
									}
									else {
										//echo "results found!";
										$row_count = 0;
										if ($res->num_rows > 0) { 
											while($row = $res->fetch_assoc()) {
												$row_count++;
												if ($row_count % 2 == 0) {
													$rowBgColor = "#FFDAB9";
												}
												else {
													$rowBgColor = "#FFFFFF";
												}
												$NoResults = false;
												echo "
												<tr class='projRow' style='background-color:$rowBgColor;'>
													<td style='width: 25%;'>". $row["project_id"] ." - ". $row["project_name"]."</td>
													<td>".$row["project_desc"]."<input type='hidden' value='".$row["project_id"]."'/></td>
													<td style='width: 20%;'>".$row["request_status"]."</td>
												</tr>";
											} // <td style='width: 20%;'>".$row["project_status"]."</td>
										}
										else {
											$NoResults = true;
											echo "<tr class='projRow' disabled><td colspan=\"3\" style='text-align: center; font-weight: bold; background-color: #FFFFFF;'>There are no existing projects for this disaster!</td></tr>";
										} 
									}	 
								?>
								<input type="hidden" name="selectProjId" id="selectProjId" value="" />
								<script>
									var noResults = "<?php echo $NoResults; ?>";
									$(document).ready(function() {
										if (!noResults) {
											$("#currProj tr:has(td)").on("click", function() {
												var selectedProjId = $(this).find("input").attr("value");
												//console.log(selectedProjId);
												$("#selectProjId").val(selectedProjId);
												//console.log($("#currProjId").val());
												$("#currProjList").submit();
											});
										}
									});
								</script>
							</table>
							<!-- <input type="button" name="btNewProj" id="btNewProj" value="Create New Project"/> -->
							<script>
								$(document).ready(function() {
									$("#btNewProj").on("click", function() {
										location.href = "new_proj.php";
									});
								});
							</script>
						</form>
					</td>
				</tr>
				<!-- THIS SECTION is incomplete; ideally should be implemented to allow admin to create a new group and set its location,
					 assign it members, and assign it tasks	-->
				<!--
				<tr>
					<td style="padding-left: 1.5em; padding-right: 1.5em; padding-top: 0;">
						<h3 id="grpTitle">Groups</h3>
						<form name="currGroupList" id="currGroupList" method="post" action="group_info.php">
							<table id="currProj">
								<th style="text-align: left; background-color: #DC143C; color: white; font-weight: bold;">Group ID - Name</th>
								<th style="text-align: left; background-color: #DC143C; color: white; font-weight: bold;">Group Description</th>
								<th style="text-align: left; background-color: #DC143C; color: white; font-weight: bold;">Group Location</th>
								<?php
									// code for managing groups 
								?>
								<script>
									// javascript/jQuery code for managing groups
								</script>
							</table>
						</form>
					</td>
				</tr>
				-->
				<?php include "footer.php"; ?>
			</table>
		</div>
	</body>
</html>