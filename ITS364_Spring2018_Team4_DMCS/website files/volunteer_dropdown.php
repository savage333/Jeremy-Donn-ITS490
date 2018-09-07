<?php
	require_once("dmcs_connect.php");
	$sqlCallgetVolunteer = "Call getVolunteer();";
	$res4 = $conn4->query($sqlCallgetVolunteer);
	
	echo "<select name='volunteer_dropdown' id='volunteer_dropdown'>";
	if (!$res4->num_rows > 0) {
		echo "<option>No volunteers</option>";
	}
	else {
		while ($row4 = $res4->fetch_assoc()) {
			echo "<option value='".$row4["person_id"]."'>". $row4["person_name"] ." - ". $row4["availability"] ."</option>";
		}
	}
	echo "</select>";
?>