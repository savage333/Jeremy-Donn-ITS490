<?php
	session_start();
	require_once("dmcs_connect.php");

	if (isset($_POST["selectProjId"])) {	
		echo "<script>console.log('Current Project Id #: ".$_POST["selectProjId"]."');</script>";
		$currProjId = $_POST["selectProjId"];
		//$_SESSION["currProjId"] = $_POST["selectProjId"];
	}
	/*
	if (isset($_SESSION["currProjId"])) {
		$currProjId = $_SESSION["currProjId"];
	}
	*/
	if (isset($_POST["selectDisasName"])) {
		$_SESSION["currDisasName"] = $_POST["selectDisasName"];
	}
	
	if (isset($_POST["currDisasName"])) {
		$_SESSION["currDisasname"] = $_POST["currDisasName"];
	}
	
	if (isset($_POST["btSubmit"])) {
		if ($_POST["isEmpty"] == "false") {
			$name = mysqli_real_escape_string($conn, $_POST['name']);	
			$address = mysqli_real_escape_string($conn, $_POST['address']);
			$phone = mysqli_real_escape_string($conn, $_POST['phone']);
			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$availability = mysqli_real_escape_string($conn, $_POST['availability']);
			$skill1 = mysqli_real_escape_string($conn, $_POST['skill1']);
			//$skill2 = mysqli_real_escape_string($conn, $_POST['skill2']);	
			//$skill3 = mysqli_real_escape_string($conn, $_POST['skill3']);	
			//$skill4 = mysqli_real_escape_string($conn, $_POST['skill4']);	
			//$skill5 = mysqli_real_escape_string($conn, $_POST['skill5']);	
			//$skill6 = mysqli_real_escape_string($conn, $_POST['skill6']);	
			
			//inserting person
			$sqlCallInsertPerson = "Call insertPerson('$name','$address','$phone', '$email', @last_prsn_id);";
			$results = $conn->query($sqlCallInsertPerson);
			if($results) {
				//echo "<script>alert('Successfully inserted into table Person!');</script>";
				$res = $conn->query("SELECT @last_prsn_id as personId");
				$row = $res->fetch_assoc();
				$lastPrsnId = $row["personId"];
				//echo "<script>alert('$lastPrsnId');</script>";
				
				//$results->free();
				$conn->next_result();
				
				//inserting volunteer 
				$sqlCallInsertVolunteer = "Call insertVolunteer($lastPrsnId, '$availability');";
				$results = $conn->query($sqlCallInsertVolunteer);
				if($results) {
					//echo "Volunteer Registered Successfully!";
					
					//$results->free();
					$conn->next_result();
					
					//executing if skill 1 is not blank
					if($skill1 != "") {
						$sqlCallInsertSkills = "Call insertSkills('$skill1', @last_skill_id);";
						$results = $conn->query($sqlCallInsertSkills);
						if($results) {
							//echo "<script>alert('Skill #1 was added successfully!);";
							$res = $conn->query("SELECT @last_skill_id as skillId");
							$row = $res->fetch_assoc();
							$lastSkillId = $row["skillId"];
							
							$conn->next_result();
							
							//inserting volunteer_skills *** this only inserts only the required skill, would follow same format for other 5 ***
							$sqlCallInsertVolunteerSkills = "Call insertVolunteer_Skills($lastPrsnId, $lastSkillId)";
							$results = $conn->query($sqlCallInsertVolunteerSkills);
							if($results) {
								$conn->close();
								echo "<script>alert('Your profile has been added to our records!. Please wait for a confirmation email for the next step.');</script>";
								echo "<script>location='dmcs_index.php?logout=true';</script>";
							}
							else {
								echo "Error: " . $sqlCallInsertVolunteerSkills . "<br>" . mysqli_error($conn);
							}
						}
						else {
							echo "Error: " . $sqlCallInsertSkills . "<br>" . mysqli_error($conn);
						}	
					}
				}
				else {
					echo "Error: " . $sqlCallInsertVolunteer . "<br>" . mysqli_error($conn);
				}
			}
			else {
				echo "Error: " . $sqlCallInsertPerson . "<br>" . mysqli_error($conn);
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
			#vol_form {
				width: 90%;
				margin-left: auto; 
				margin-right: auto; 
				border-collapse: collapse; 
				background-color: #FFDAB9; 
				border-radius: 20px;
				font-family: "Century Gothic", Arial, sans-serif;
			}
			#vol_form td {
				/* border: 1px solid blue; */
				padding-left: 1em;
			}
			label {
				font-weight: bolder;
				font-size: 0.9em;
				color: #DC143C;
			}
			.nl {
				color: #000000;
			}
			input[type="text"] {
				width: 90%;
				border-radius: 5px;
				border: 1px solid #A9A9A9;
				padding: 0.3em;
			}
			
			#contact_info td, #skill_info td, #avail_info td {
				padding: 0.3em; 
				margin: 0;
			}
			h4 {
				border-bottom: 2px solid #FF8C00;margin: 0; padding: 0; color: #FF8C00; font-weight: bolder;
			}
		</style>
		<script src="jquery-3.3.1.js"></script>
		<script>
			$(document).ready(function() {
				$("#btSubmit").on("click", function() {
					$(".required").each(function(){
						if ($.trim($(this).val()) == "") {
							$("#isEmpty").val("true");
							alert("All fields marked in RED are required!");
							return false;
						}
						else {
							$("#isEmpty").val("false");
							$("#volunteerRegistration").submit();
						}
					});
				});
			});
		</script>
		<title> 
			DMCS - Volunteer Registration
		</title>
	</head>
	<body>
		<div id="body-container">
			<table id="header-container" style="width: 100%; border-collapse: collapse;">
				<tr>
					<td style="background-color: #000000; border-top: 1em solid #DC143C; border-bottom: 0.2em solid #DC143C; margin: 0;">
						<table style="width: 100%; float: left;">
							<tr>
								<td style="padding: 0; margin: 0;"> <!-- style="padding-top: 3.5em; padding-bottom: 3.5em;" -->
									<div style="padding-left: 0.5em; margin-top: 2em; display: inline-block;">
										&nbsp;
										<span id="disasTitle"><a>Volunteer Registration</a></span>
									</div>
									<a href="dmcs_index.php?logout=false"><img src="images/dmcs_logo.png" style="margin-right: 1em; height: 15%; width: auto; float: right;" /></a> 
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td style="padding-left: 3em; padding-right: 3em;">
						<br/>
					<!-- START CONTENT HERE -->
						<form id="volunteerRegistration" name="volunteerRegistration" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">	
						<table id="vol_form">
							<tr><td><label>* = Required</label></td></tr>
							<tr><td><h4>Personal Information</h4></td>
							</tr>		
							<tr>
								<td>
									<table id="contact_info" style="border-collapse: collapse;">
										<tr>
											<td><label for="name">*Name:</label></td>
											<td><input type="text" id="name" class="required" name="name"></td>
										</tr>
										<tr>
											<td><label for="address">*Address:</label></td>
											<td><input type="text" id="address" class="required" name="address"></td>
										</tr>
										<tr>
											<td><label for="phone">*Phone:</label></td>
											<td><input type="text" id="phone" class="required" name="phone" value="xxxxxxxxxx"></td>
										</tr>
										<tr>
											<td><label for="email">*E-mail:</label></td>
											<td><input type="text" id="email" class="required" name="email"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr><td><h4>Skill Information</h4></td></tr>
							<tr>
								<td>
									<table id="skill_info" style="border-collapse: collapse;">
										<tr>
											<td><label for="skill1">*Skill 1:</label></td>
											<td><input type="text" id="skill1" class="required" name="skill1"></td>
											<td><label for="skill4" class="nl">Skill 4:</label></td>
											<td><input type="text" id="skill4" name="skill4"></td>
										</tr>
										<tr>							
											<td><label for="skill2" class="nl">Skill 2:</label></td>
											<td><input type="text" id="skill2" name="skill2"></td>
											<td><label for="skill5" class="nl">Skill 5:</label></td>
											<td><input type="text" id="skill5" name="skill5"></td>
										</tr>
										<tr>							
											<td><label for="skill3" class="nl">Skill 3:</label></td>
											<td><input type="text" id="skill3" name="skill3"></td>
											<td><label for="skill6" class="nl">Skill 6:</label></td>
											<td><input type="text" id="skill6" name="skill6"></td>
										</tr>						
									</table>
								</td>
							</tr>
							<tr><td><h4>Availability Information</h4></td></tr>
							<tr>
								<td>
									<table id="avail_info" style="width: 80%; border-collapse: collapse;">
										<tr>
											<td style="width: 1px; white-space: nowrap;"><label for="availability">*Days/Hours</label></td>
											<td><input type="text" style="width: 100%;" id="availability" class="required" name="availability"></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td align="left"><!--
									<input type="reset" class="red-button" value="Reset" id="btReset" name="btReset" />
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-->
									<div style="padding-left:;">
									<input type="submit" class="green-button" value="Submit" id="btSubmit" name="btSubmit" />
									</div>
								</td>
							</tr>
							<tr><td><h5><a href="dmcs_index.php?logout=true">Return to Homepage</a></h5></td></tr>
						</form>
						<input type="hidden" name="isEmpty" id="isEmpty" />
						</table>
					<!-- END CONTENT HERE -->
					</td>
				</tr>
				<?php include "footer.php" ?>
			</table>
		</div>
	</body>
</head>