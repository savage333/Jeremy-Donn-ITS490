<?php
	require_once("dmcs_connect.php");
	$sqlGetAllGroups = "SELECT group_id, group_name FROM groups;";
	$groupList = $conn3->query($sqlGetAllGroups);

	echo "<select name='group_dropdown' id='group_dropdown' style='width: 100%;'>";
		while($groupRow = $groupList->fetch_assoc()) {
			echo "<option value='".$groupRow["group_id"]."'";
				
				if (isset($currGrp_Id)) {
					$currGrp_Id == $groupRow["group_id"];
					echo " selected>";
				}	
				else {
					echo ">";
				}
				
			echo $groupRow["group_name"]."</option>";
		}
	echo "</select>";
?>