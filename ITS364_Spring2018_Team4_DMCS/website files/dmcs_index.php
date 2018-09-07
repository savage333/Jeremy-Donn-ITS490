<?php
	session_start();

	if (isset($_GET["logout"])) {
		if ($_GET["logout"] == "true") {
			session_unset();
			session_destroy();
		}
		
		if ($_GET["logout"] == "false") {
			if (isset($_SESSION["currUser"]) && isset($_SESSION["currUser_pw"])) {
				$user_id = $_SESSION["currUser"];
				$user_pw = $_SESSION["currUser_pw"];
				//echo "<script>console.log('".$_SESSION["currUser"]."');</script>";
				//echo "<script>console.log('".$_SESSION["currUser_pw"]."');</script>";
			}
		}	
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="dmcs_styles.css">
		<style>
			h3 {
				font-family: "Century Gothic", Arial, sans-serif;
				font-weight: bold;
				color: #DC143C;
			}
			h3 a {
				text-decoration: none;
				color: #DC143C;
			}
			input {
				width: 100px;
			}
			#disaster_dropdown {
				border-radius: 5px;
				background-color: #DC143C;
				color: #FFFFFF;
				padding: 0.3em;
			}
			#client_help {
				padding: 0.1em;
				border-radius: 10px;
				border: 2px solid red;
				text-align: center;
				font-weight: bold;
				background-color: #DC143C;
				color: white;
				margin-top: 0;
				margin-left: auto;
				margin-right: auto;
				width: 10.5em;
			}
			#client_help:hover{
				background-color: #FF8C00;
				border: 2px solid #FF8C00;
			}
			#disaster_dropdown option {
				background-color: #FFFFFF;
				color: #000000;
			}
			body {
				font-family: "Century Gothic", Arial, sans-serif;
			}
			#sidebar_login, #sidebar_login td {
				padding: 0.4em;
				/* border: 1px solid blue; */
			}
			#disas_form {
				display: none;
				position: absolute;
				z-index: 10;
				margin-top: 2em;
				margin-left: 39em;
				border-top: 1px solid #F5F5DC;
			}
			#loginTable {
				border-bottom-left-radius: 10px;
				border-bottom-right-radius: 10px;
				border-top-left-radius: 0;
				border-top-right-radius: 0;
				border-top-width: 0;
				border-left-width: 0;
				border-right-width: 0;
				border-bottom-width: 0;
				border-top-color: #F5F5DC;
				/* border-left-color: #DC143C; */
				/* border-right-color: #DC143C; */
				border-collapse: collapse;
			}
			#loginTable td {
				/* border: 1px solid blue; */
				padding: 0.5em;
			}
			
			#btlogin_container {
				margin-right: 1em;
			}
			#btTopLogin {
				font-weight: bold;
				color: green;
				padding-top: 0.5em;
				text-align: center; 
				margin-right: 0;
				font-size: 0.9em;
				float: right;
			}
			#dmcsTitle {
				font-family: 'Century Gothic', Arial, sans-serif; 
				font-size: 1.5em; 
				font-weight: bolder; 
				color: #DC143C;
				width: 50%;
				float: left;
			}
			.noButton {
				border: 0;
				background-color: #DC143C;
				font-weight: bold;
				color: white;
				font-family: "Century Gothic", Arial, sans-serif;
				font-size: 1em;
				width: 100%;
			}
			.noButton:hover {
				background-color: #FF8C00;
			}
			#btRegister:hover, #btLogin:hover {
				border: 1px solid #FFFFFF;
			}
		</style>
		<script src="jquery-3.3.1.js"></script>
		<script>
			var hidden = true;
			$(document).ready(function() {
				$("#btTopLogin").on("click", function() {
					if (hidden) {
						$("#arrow").attr("src", "images/up_red_arrow.png");
						hidden = false;
					}
					else {
						$("#arrow").attr("src", "images/down_red_arrow.png");
						hidden = true;
					}
					$("#disas_form").toggle();
				});
			});
		</script>
		<title>Disaster Management Communication System</title>
	</head>
	<body>
		<div id="body-container">
			<table style="border-collapse: collapse; width: 100%; margin: 0; padding: 0;">
				<tr>
					<td colspan="2" style="padding-bottom: 0.2em; background-color: #F5F5DC; border-bottom: 0.7em solid #DC143C;">
						<div id="dmcsTitle">DMCS</div>
						<div id="btlogin_container">
							<div id="btTopLogin">Volunteer | Employee | Client <img id="arrow" src="images/down_red_arrow.png" style="height: 3%; width: auto;" /></div>
							<form id="disas_form" name="disas_form" action="login_route.php" method="post">
							<table id="loginTable" style="background-color: #F5F5DC; padding: 0; margin: 0;">
								<tr>
									<td colspan="2" style="text-align: right;">
										<select name="disaster_dropdown" id="disaster_dropdown">
											<option value="default" selected hidden>Select a disaster</option>
											<?php	
												require_once("dmcs_connect.php");
												$sqlGetDisasterList = "SELECT disaster_id, disaster_name FROM DISASTER";
												
												if(!$results = $conn->query($sqlGetDisasterList)) {
													return $conn->errno."-".$conn->error;
												}
												else {
													if ($results->num_rows > 0) {
														while($row = $results->fetch_assoc()) {
															echo "<option value='".$row["disaster_id"]."'>".$row["disaster_name"]."</option>";
														}
													}
													else {
														return $conn->errno."-".$conn->error;
														echo "<script>alert('There are no records for any disaster in the database!');</script>";
													}
												}
											?>
										</select>
									</td>
								</tr>
								<tr>
									<td style="padding-right: -2em; text-align: right;"><span style="font-size: 0.9em;">Username</span></td>
									<td>
										<input type="text" name="login_id" id="login_id" value="<?php if (isset($_SESSION["currUser"])) echo $user_id; ?>" />
									</td>
								</tr>
								<tr>
									<td style="text-align: right;"><span style="font-size: 0.9em;">Password</span></td>
									<td>
										<input type="password" name="login_pw" id="login_pw" value="<?php if (isset($_SESSION["currUser_pw"])) echo $user_pw; ?>" />
									</td>
								</tr>
								<tr>
									<td colspan="2" style="text-align: center;">
										<div style="margin-left: auto; margin-right: auto;">
										<input type="submit" class="button" style="width: 35%; background-color: #000080; padding: 0.3em;" name="btRegister" id="btRegister" value="Register" />
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										<?php 
											if(isset($_SESSION["currUser"])) {
												echo "<input type=\"submit\" class=\"button\" style=\"width: 35%; background-color: #006400; padding: 0.3em;\" name=\"btLogout\" id=\"btLogout\" value=\"Logout\" />";
											}
											else {
												echo "<input type=\"submit\" class=\"button\" style=\"width: 35%; background-color: #006400; padding: 0.3em;\" name=\"btLogin\" id=\"btLogin\" value=\"Login\" />";
											}
										?>
										</div>
									</td>
								</tr>
								<tr>
									<td colspan="2" style="text-align: right; padding-top: 0;">
										<div id="client_help"><input type="submit" class="noButton" name="btReqHelp" id="btReqHelp" value="Request Help" /></div>
									</td>
								</tr>
							</table>
							<script>
								$(document).ready(function () {
									$("#btLogin, #btReqHelp").on("click", function() {
										if ($("#disaster_dropdown").val() == "default") {
											alert("Please select a disaster!");
											return false;
										}
										if ($("#login_id").val().length == 0 || $("#login_pw").val().length == 0) {
											alert("Please enter your account information!");
											return false;
										}
										else {
											//return true;
											$("#disas_form").submit();
										}
									});
								});
							</script>
							</form>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="border-bottom: 0.2em solid #DC143C; padding: 0; margin: 0; text-align: center; background-color: black;">
						<img src="images/dmcs_nologo.png" style="width: auto; height: 50%;" />
					</td>
				</tr>
				<tr>
					<td style="width: 75%;">
						<table style="font-family: Arial; font-size: 14px;">
							<tr>
								<td style="width: 15%; font-size: 0.9em; padding-top: 1.2em;">15 April</td>
								<td><h3><a href="#">Forest Fire rages in California</a></h3>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</td>
							</tr>
							<tr>
								<td style="width: 15%; font-size: 0.9em; padding-top: 1.2em;">21 March</td>
								<td><h3><a href="disaster_info.php">Hurricane Irma hits Florida</a></h3>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</td>
							</tr>
							<tr>
								<td style="width: 15%; font-size: 0.9em; padding-top: 1.2em;">07 February</td>
								<td><h3><a href="#">Tornado pummels the Midwest</a></h3>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. y</td>
							</tr>
							<tr>
								<td style="width: 15%; font-size: 0.9em; padding-top: 1.2em;">18 January
								</td><td><h3><a href="#">Earthquake shakes up Alaska</a></h3>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</td>
							</tr>
							<tr>
								<td style="width: 15%; font-size: 0.9em; padding-top: 1.2em;">02 January</td>
								<td><h3><a href="#">Severe floods submerge parts of Wyoming</a></h3>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi.</td>
							</tr>
						</table>
					</td>
					<td id="sidebar" style="width: 25%; background-color: #F5F5DC;"> <!-- pale yellow: #FFFFE0 -->
						<table id="sidebar_login" style="border-collapse: collapse; margin-right: 1em;">
							<!--
							<tr>
								<td colspan="2" style="text-align: center; padding: 0;">
									<div style="padding: 0.5em; background-color: #FFA500; border: 2px solid #D3D3D3;">
									<h4 style="margin-bottom: 0.5em; margin-top: 0;">Need Assistance?</h4>
										<span style="text-decoration: none;"><div id="client_help">Request Help</div></span>
									</div>
								</td>
							</tr>
							<tr><td></td></tr>
							-->
							<tr>
								<td>
								<!-- START CONTAINER: RSS feed, Twitter timeline, etc. --->
									<!-- start sw-rss-feed code --> 
									<!-- start sw-rss-feed code --> 
									<script type="text/javascript"> 
									<!-- 
									rssfeed_url = new Array(); 
									rssfeed_url[0]="https://www.fema.gov/feeds/news.rss";  
									rssfeed_frame_width="180"; 
									rssfeed_frame_height="600"; 
									rssfeed_scroll="off"; 
									rssfeed_scroll_step="6"; 
									rssfeed_scroll_bar="on"; 
									rssfeed_target="_blank"; 
									rssfeed_font_size="12"; 
									rssfeed_font_face="Arial"; 
									rssfeed_border="on"; 
									rssfeed_css_url=""; 
									rssfeed_title="on"; 
									rssfeed_title_name="FEMA News Releases"; 
									rssfeed_title_bgcolor="#DC143C"; 
									rssfeed_title_color="#fff"; 
									rssfeed_title_bgimage=""; 
									rssfeed_footer="off"; 
									rssfeed_footer_name="rss feed"; 
									rssfeed_footer_bgcolor="#ff0000"; 
									rssfeed_footer_color="#333"; 
									rssfeed_footer_bgimage=""; 
									rssfeed_item_title_length="50"; 
									rssfeed_item_title_color="#000"; 
									rssfeed_item_bgcolor="#fff"; 
									rssfeed_item_bgimage=""; 
									rssfeed_item_border_bottom="on"; 
									rssfeed_item_source_icon="off"; 
									rssfeed_item_date="off"; 
									rssfeed_item_description="on"; 
									rssfeed_item_description_length="120"; 
									rssfeed_item_description_color="#666"; 
									rssfeed_item_description_link_color="#333"; 
									rssfeed_item_description_tag="off"; 
									rssfeed_no_items="0"; 
									rssfeed_cache = "29f7b64b7f0f11f0236c5e4b7266d8f3"; 
									//--> 
									</script> 
									<script type="text/javascript" src="//feed.surfing-waves.com/js/rss-feed.js"></script> 
									<!-- The link below helps keep this service FREE, and helps other people find the SW widget. Please be cool and keep it! Thanks. --> 
									<!-- <div style="text-align:right; width:200px;">powered by <a href="http://www.surfing-waves.com" rel="noopener" target="_blank" style="color:#ccc;font-size:10px">Surfing Waves</a></div> -->
									<!-- end sw-rss-feed code -->
								<!-- END CONTAINER -->
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php include "footer.php"; ?>
			</table>
		</div>
	</body>
</html>