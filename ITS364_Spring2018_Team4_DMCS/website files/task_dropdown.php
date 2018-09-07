<?php
	require_once("dmcs_connect.php");
	$sqlGetAllTasks = "SELECT task_id, task_desc, project_id
						FROM TASKS";
	$taskList = $conn3->query($sqlGetAllTasks);

	echo "<select name='task_dropdown' style='width: 100%;'>";
		while($taskRow = $taskList->fetch_assoc()) {
			echo "<option value='".$taskRow["task_id"]."'>";
			
				if ($currGrp_Id == $taskRow["group_id"]) {
					echo " selected>";
				}	
				else {
					echo ">";
				}
			
			echo $taskRow["task_desc"]."</option>";
		}
	echo "</select>";
?>