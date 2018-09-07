<?php
	require_once("dmcs_connect.php");
	$sqlCallgetEmployees = "Call getEmployee2();";
	$res3 = $conn3->query($sqlCallgetEmployees);
	
	echo "<select style='width: 73%;' name='employee_dropdown' id='employee_dropdown'>";
	if (!$res3->num_rows > 0) {
		echo "<option>No Employees</option>";
	}
	else {
		while ($row3 = $res3->fetch_assoc()) {
			echo "<option value='".$row3["person_id"]."'";
				if ($currGrpLead == $row3["person_id"]) {
					echo " selected>";
				}	
				else {
					echo ">";
				}
			echo $row3["person_name"] ." - ". $row3["department"] ."</option>";
		}
	}
	echo "</select>";
?>