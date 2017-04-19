<?php
	define('db_host','10.116.22.167');
	define('db_name','biomedis_db');
	define('db_user','biomedis_user');
	define('db_pass','Qp2h[U,4Ae(R');
	 
	$dbConnection = mysqli_connect(db_host, db_user, db_pass, db_name);

	$email = $_POST["email"];

	$stmt = $dbConnection->prepare("SELECT empid FROM ojl_user WHERE email = ?");
	$stmt->bind_param("s", $email);
	$stmt->execute();

    $result = $stmt->bind_result($empid);

	$row = array();
	
	while ($stmt->fetch()) {
		$row_item = array(
			'emp_id' => $empid
		);
		array_push($row, $row_item);
	}
	
	echo (json_encode(array("result"=>$row)));
?>		