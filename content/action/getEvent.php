<?php
	require '../dbase/dbconfig.php';
	$sql = "SELECT * FROM schedule";
	$stm = $con->prepare($sql);
	$stm->execute();
	$result = $stm->fetchAll();
	foreach($result as $rowSched) {
		$id = $rowSched['id'];
		$title = $rowSched['title'];
		$color = $rowSched['color'];
		$status = $rowSched['status'];
		if ($status == 0) { $color = "#000000"; }
		$requestby = $rowSched['requestby'];
		$dept = $rowSched['dept'];
		$description = $rowSched['description'];
		$starttime = $rowSched['starttime'];
		$endtime = $rowSched['endtime'];
		$datesent = $rowSched['datesent'];
		$data[] = array(
			'id'   			=> $id,
			'title'   		=> $title,
			'start'   		=> $starttime,
			'end'			=> $endtime,
			'color' 		=> $color,
			'className' 	=> "pointer",
			'requestby' 	=> $dept . " - " . $requestby,
			'silid'			=> $description
		);
	}
	echo json_encode($data);
?>