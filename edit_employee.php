<?php
include 'db_connect.php';
$qry = $conn->query("SELECT * FROM employee_list where id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
include 'funcionario_nuevo.php';
?>