<style>
	#disasList td {
		/* border: 1px solid blue; */
		margin: 0;
		/* background-color: black; */
		text-align: right;
		color: white;
	}
	#disasList td:hover {
		background-color: #D3D3D3;
		color: black;
		font-weight: 600;
		cursor: pointer;
	}
	#disasList {
		position: absolute;
		margin-top: 1.5em;
		margin-left: 0em;
		z-index: 10;
		display: none;
		border-collapse: collapse;
		border-left: 0.1em solid #000000;
		border-right: 0.1em solid #000000;
		border-bottom: 0.1em solid #000000;
		border-top: 0.1em solid #000000;

	}
	#disasList table {
		margin: 0;
		padding: 0;
		border-collapse: collapse;
		font-family: "Century Gothic", Arials, sans-serif;
		font-size: 0.9em;
		min-width: 15em;
		background-color: #000000;

	}
	#disasList-container {
		border: 1px solid blue;
		float: right;
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
	$(document).ready(function() {
		
		$("#disas_dd_arrow").on("mouseover", function() {
			$("#disasList").show();
		});
		
		$("#disasList").on("mouseover", function() {
			$(this).show();
		});
		$("#disasList").on("mouseout", function() {
			$(this).hide();
		});
		
		
		$("#disasList td").on("click", function() {
			//location.href="proj_index.php?disasterId=" + $(this).find("input").attr("value");
			location.href="proj_index.php?disasterId=" + $(this).find("input").attr("value");
		});
		
	});
</script>

<table id="header-container" style="width: 100%; border-collapse: collapse;">
			<tr>
				<td style="background-color: #000000; border-top: 1em solid #DC143C; border-bottom: 0.2em solid #DC143C; margin: 0;">
					<table style="width: 100%; float: left;">
						<tr>
							<td style="padding: 0; margin: 0;"> <!-- style="padding-top: 3.5em; padding-bottom: 3.5em;" -->
								<div style="padding-left: 0.5em; margin-top: 2em; display: inline-block;">
									
									<img src="images/red_chevron_down.png" id="disas_dd_arrow" style="height: 10%; width: auto;" />
									<div id="disasList">
										<table style="float: right; margin: 0; padding: 0;">
										<?php
											require_once("dmcs_connect.php");
											$sqlGetAllDisasters = "SELECT disaster_id, disaster_name 
																	FROM DISASTER
																	WHERE disaster_name != '".$_SESSION["currDisasName"]."';";
											$res4 = $conn4->query($sqlGetAllDisasters);
											if ($res4->num_rows > 0) {
												while ($row = $res4->fetch_assoc()) {
													echo "<tr><td><input type='hidden' value='".$row["disaster_id"]."' />". $row["disaster_name"]."</td></tr>";
												}
											}
										?>
										</table>
									</div>
									&nbsp;
									<span id="disasTitle"><a href="proj_index.php"><?php echo $_SESSION["currDisasName"]; ?></a></span>
								</div>
								<a href="dmcs_index.php?logout=false"><img src="images/dmcs_logo.png" style="margin-right: 1em; height: 15%; width: auto; float: right;" /></a> 
							</td>
						</tr>
					</table>
				</td>
			</tr>