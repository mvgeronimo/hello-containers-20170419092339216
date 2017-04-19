<?php
date_default_timezone_set('Asia/Manila');
$date_time = date('Y-m-d H:i:s', time());

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: origin, x-requested-with, content-type");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header('Content-Type: application/json');


$data = json_decode($_POST['data'], true);

//OJL Prod Connection
$hostname   = "10.116.22.167";
$username   = "biomedis_user";
$password   = "Qp2h[U,4Ae(R";
$database   = "biomedis_db";


$data_count = count($data);

if (!$dbhandle2 = mysql_connect($hostname, $username, $password)) {
    echo 'Could not connect to mysql';
    exit;
}

if (!mysql_select_db($database, $dbhandle2)) {
    echo 'Could not select database';
    exit;
}


mysql_query('TRUNCATE TABLE ojl_SalesPlan2');
mysql_query("INSERT INTO ojl_c1_connection_logs(date_time,count,status) VALUES('".$date_time."','".$data_count."','1')");

foreach ($data as $key => $value) {
	$psr_id = $value['psr_id'];
	$grossup_ytd_ds = $value['grossup_ytd_ds'];
	$grossup_ytd_is = $value['grossup_ytd_is'];
	$grossup_ytd_st = $value['grossup_ytd_st'];
	$quota_ytd = $value['quota_ytd'];
	$quota_fy = $value['quota_fy'];
	$quota_togo = $value['quota_togo'];

	$save = "INSERT INTO ojl_SalesPlan2(psr_id, grossup_ytd_ds, grossup_ytd_is, grossup_ytd_st, quota_ytd, quota_fy,quota_togo,date_time) VALUES('".$psr_id."','".$grossup_ytd_ds."','".$grossup_ytd_is."','".$grossup_ytd_st."','".$quota_ytd."','".$quota_fy."','".$quota_togo."','".$date_time."')";

	mysql_query($save) or die(mysql_error());

}
mysql_close($dbhandle2);

?>