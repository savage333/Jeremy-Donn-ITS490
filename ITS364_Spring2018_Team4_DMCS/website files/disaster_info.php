<?php
	session_start();
	
	if (isset($_POST["currUser"]) && isset($_POST["currUser_pw"])) {
		$_SESSION["currUser"] = $_POST["currUser"];
		$_SESSION["currUser_pw"] = $_POST["currUser_pw"];
	}
?>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="dmcs_styles.css">
		<style>
			#body-container {
				font-family: "Century Gothic", Arial, sans-serif;
			}
			h3 {
				font-family: "Century Gothic", Arial, sans-serif;
				font-weight: bold;
				color: #DC143C;
			}
			#disasTitle {
				color: #D3D3D3; 
				font-family: 'Century Gothic', Arial; 
				font-weight: lighter; 
				font-size: 2em;
				text-decoration: none;
				color: #D3D3D3;
				margin-top: 1.5em;
				float: left;
			}
			#news_report td {
				/* border: 1px solid blue; */
			}
		</style>
		<script>
			
		</script>
		
	</head>
	<body>
		<div id="body-container">
			<table id="news_report" style="border-collapse: collapse; width: 100%;">
				<tr>
					<td colspan="2" style="background-color: #000000; border-top: 0.5em solid #DC143C; border-bottom: 0.2em solid #DC143C;">
						<span id="disasTitle">Hurricane Irma hits Florida</a></span>
						<a href="dmcs_index.php?logout=false"><img src="images/dmcs_logo.png" style="margin-right: 1em; height: 15%; width: auto; float: right;" /></a>
					</td>
				</tr>
				<tr>
					<td style="width: 75%; font-size: 1em; text-align: justify;">
						<!-- <h2>Hurricane Irma batters Florida</h2> -->
						<img src="images/hurricane_irma1.jpg" style="float: left; width: 45%; height: auto; padding-right: 0.9em; margin-bottom: 0.3em;" />
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Curabitur sodales ligula in libero. Sed dignissim lacinia nunc.</p>
						<p>Curabitur tortor. Pellentesque nibh. Aenean quam. In scelerisque sem at dolor. Maecenas mattis. Sed convallis tristique sem. Proin ut ligula vel nunc egestas porttitor. Morbi lectus risus, iaculis vel, suscipit quis, luctus non, massa. Fusce ac turpis quis ligula lacinia aliquet. Mauris ipsum. Nulla metus metus, ullamcorper vel, tincidunt sed, euismod in, nibh.
						<p>Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam nec ante. Sed lacinia, urna non tincidunt mattis, tortor neque adipiscing diam, a cursus ipsum ante quis turpis. Nulla facilisi. Ut fringilla. Suspendisse potenti. Nunc feugiat mi a tellus consequat imperdiet. Vestibulum sapien. Proin quam. Etiam ultrices. Suspendisse in justo eu magna luctus suscipit. Sed lectus.</p>
						<p>Integer euismod lacus luctus magna. Quisque cursus, metus vitae pharetra auctor, sem massa mattis sem, at interdum magna augue eget diam. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Morbi lacinia molestie dui. Praesent blandit dolor. Sed non quam. In vel mi sit amet augue congue elementum. Morbi in ipsum sit amet pede facilisis laoreet. Donec lacus nunc, viverra nec, blandit vel, egestas et, augue. Vestibulum tincidunt malesuada tellus. Ut ultrices ultrices enim. Curabitur sit amet mauris.</p>
						<h5><a href="dmcs_index.php?logout=false">Return to homepage</a></h5>
					</td>
					<td id="sidebar" style="width: 30%;">
						<h3 style="margin-bottom: 5px;">Related News</h3>
						<ul id="relatedNewsLinks">
							<a href=#"><li>Link 1</li></a>
							<a href=#"><li>Link 2</li></a>
							<a href=#"><li>Link 3</li></a>
							<a href=#"><li>Link 4</li></a>
							<a href=#"><li>Link 5</li></a>
						</ul>
					</td>
				</tr>
				<?php include "footer.php"; ?>
			</table>
		</div>
	</body>
</html>