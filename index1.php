<?php

include_once("db.php");
$sqlQuery = "SELECT name,phone, message  FROM books LIMIT 10";
$resultSet = mysqli_query($link, $sqlQuery) or die("database error:". mysqli_error($link));
$developersData = array();
while( $developer = mysqli_fetch_assoc($resultSet) ) {
	$developersData[] = $developer;
}
?>
<?php
if(isset($_POST["dataExport"])) {
	$fileName = "webdamn_export_".date('Ymd') . ".xls";
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=\"$fileName\"");
	$showColoumn = false;
	if(!empty($developersData)) {
	  foreach($developersData as $developerInfo) {
		if(!$showColoumn) {
		  echo implode("\t", array_keys($developerInfo)) . "\n";
		  $showColoumn = true;
		}
		echo implode("\t", array_values($developerInfo)) . "\n";
	  }
	}
	exit;
}
?>

<div class="container">
	<div class="well-sm col-sm-12">
		<div class="btn-group pull-right">
			<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
				<button type="submit" id="dataExport" name="dataExport" value="Export to excel" class="btn btn-info">Export To Excel</button>
			</form>
		</div>
	</div>
	<table id="" class="table table-striped table-bordered">
		<tr>
			<th>Name</th>
			<th>phone</th>

		</tr>
		<tbody>
			<?php foreach($developersData as $developer) { ?>
			   <tr>
			   <td><?php echo $developer ['name']; ?></td>
			   <td><?php echo $developer ['phone']; ?></td>

			   </tr>
			<?php } ?>
		</tbody>
    </table>
</div>
