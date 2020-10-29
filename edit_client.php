



 <?php
 require_once "db.php";

 if(isset($_GET['book_id'])){

$book_id =$_GET['book_id'];
//if($session_role== 'admin'){
$get_query ="SELECT  * FROM books WHERE book_id= $book_id";
$get_run = mysqli_query($link, $get_query);

if(mysqli_num_rows($get_run) >0){
    $get_row= mysqli_fetch_array($get_run);
    $name=$get_row['name'];

    $phone=$get_row['phone'];
    $date_book=$get_row['date_book'];
    $message=$get_row['message'];



}else{


header('location:index.php'); }
 }

?>
<?php
if(isset($_POST['update'])){

    $up_name= mysqli_real_escape_string($link,$_POST['name']);
        $up_message = mysqli_real_escape_string($link,$_POST['message']);


    $up_phone=$_POST['phone'];
    $up_date_book=$_POST['date_book'];

    if(empty($up_name)  or empty($up_phone)  or empty($up_message)){
        $error= "All (*) Field  Are Required";

    }
    else
    {


      $update_query="UPDATE `books` SET `name`= '$up_name',`phone`='$up_phone',`message`='$up_message',`date_book`='$up_date_book'WHERE book_id='$book_id'";


        if(mysqli_query($link,$update_query )){
            $msg = "book  update";


            header("refresh:0; url=index.php");
        }
        else
        {
            $error="No update books ";
        }

    }



}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="" method="post">

                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">

                        </div>


                            <label>phone</label>
                            <input type="number" name="phone" class="form-control" value="<?php echo $phone; ?>">

                        </div>

                            <label>date</label>
                            <input type="date" name="date_book" class="form-control" value="<?php echo $date_book; ?>">

                        </div>

                            <label>message</label>
                            <textarea name="message" class="form-control"><?php echo $message; ?></textarea>

                        </div>


                        <input type="hidden" name="book_id" value="<?php echo $book_id; ?>"/>
                        <input type="submit" name="update" class="btn btn-primary" value="update">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
