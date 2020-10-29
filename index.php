<?php

include_once("db.php");
$sqlQuery = "SELECT name,phone, message  FROM books ";
$resultSet = mysqli_query($link, $sqlQuery) or die("database error:". mysqli_error($link));
$developersData = array();
while( $developer = mysqli_fetch_assoc($resultSet) ) {
	$developersData[] = $developer;
}
?>
<?php

if(isset($_POST["dataExport"])) {



$conn = new mysqli('localhost', 'root', '');
mysqli_select_db($conn, 'booking');
mysqli_query($conn, "set names 'utf8'");
$sql = "SELECT `message`,`name` FROM `books`";
$setRec = mysqli_query($conn, $sql);
$columnHeader = '';
$columnHeader = "User Id" . "\t" . "First Name" . "\t" . "Last Name" . "\t";
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
?>
















<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Employees Details</h2>
                        <a href="add_client.php" class="btn btn-success pull-right">Add New book</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "db.php";

                    // Attempt select query execution
                    $sql = "SELECT * FROM books";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Name</th>";
                                        echo "<th>phone</th>";
                                        echo "<th>date</th>";
                                        echo "<th>Message</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['book_id'] . "</td>";
                                        echo "<td>" . $row['name'] . "</td>";
                                        echo "<td>" . $row['phone'] . "</td>";
                                          echo "<td>" . $row['date_book'] . "</td>";
                                        echo "<td>" . $row['message'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='read.php?book_id=". $row['book_id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='edit_client.php?book_id=". $row['book_id'] ."' title='Update Record' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='delete.php?book_id=". $row['book_id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No records were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }?>
                    <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
              				<button type="submit" id="dataExport" name="dataExport" value="Export to excel" class="btn btn-info">Export To Excel</button>
              			</form>
                    // Close connection
                  <?php  mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
