<?php

include_once("db.php");
$sqlQuery = "SELECT name,phone, message  FROM books LIMIT 10";
$resultSet = mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));
$developersData = array();
while( $developer = mysqli_fetch_assoc($resultSet) ) {
	$developersData[] = $developer;
}
?>
