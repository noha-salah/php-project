<?php

if(isset($_POST["dataExport"])) {


$conn = new mysqli('localhost', 'root', '');
mysqli_select_db($conn, 'booking');
mysqli_query($conn, "set names 'utf8'");
$sql = "SELECT `message`,`name` FROM `books`";
$setRec = mysqli_query($conn, $sql);
$columnHeader = '';
$columnHeader = "الرقم " . "\t" . "First Name" . "\t" . "Last Name" . "\t";
$setData = '';
while ($rec = mysqli_fetch_row($setRec)) {
    $rowData = '';
    foreach ($rec as $value) {
        $value = '"' . $value . '"' . "\t";
        $rowData .= $value;
    }
    $setData .= trim($rowData) . "\n";
}
// convert to UTF-16 and add BOM
$setData = chr(255) . chr(254) . mb_convert_encoding($setData, "UTF-16LE", "UTF-8");
// add encoding in headers
header("Content-Encoding: UTF-16LE");
header("Content-type: text/csv; charset=UTF-16LE");

header("Content-Disposition: attachment; filename=User_Detail.xls");
header("Pragma: no-cache");
header("Expires: 0");
echo ucwords($columnHeader) . "\n" . $setData . "\n";

}
?>

<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
  <button type="submit" id="dataExport" name="dataExport" value="Export to excel" class="btn btn-info">Export To Excel</button>
</form>
