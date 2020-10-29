
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>

</head>
<body>

    <div id="wrapper">


  <div class="container fluild body-section">
  <div class="row">
  <div class="col-md-3">

  </div>
  <div class="col-md-9">

  <h1><i class="fa fa-plus-square"></i> Add carousel <small> Add New carousel  </small></h1><hr>
  <ol class="breadcrumb">
  <li><a href="#"><i class="fa fa-puls-square"></i>Add carousel</a></li>

</ol>
<?php
require_once "db.php";

if(isset($_POST['submit'])){


    $name= $_POST['name'];

    $message= $_POST['message'];
 $phone =$_POST['phone'];
 $date_book =$_POST['date_book'];


    if(empty($name) or empty($phone) or empty($message)){
        $error= "All (*) Field  Are Required";

    }
    else
    {


            $insert_query="INSERT INTO `books`( `name`, `message`, `phone`, `date_book`) VALUES ('$name','$message','$phone','$date_book')";
        if(mysqli_query($link,$insert_query )){
            $msg = "booking Added";

            $phone = "";
            $message= "";
            $name = "";

          header("refresh:0; url=index.php");
        }
        else
        {
            $error="No Add booking";
        }

    }



}



?>
<!--- clos md-6 lg-3 -->
<div class="row">
    <div class="col-xs-12">
        <?php  if(isset($error))
          {
              echo "<div class='alert alert-danger' role='alert'> $error </div>";



          }
          else if (isset($msg)) {
           echo "<div class='alert alert-success' role='alert'> $msg </div>";


      }
?>

          <form action="" method="post"  enctype="multipart/form-data">
      <div class="form-group">

          <label for ="title">

             name : *
          </label>




          <input type="text"   value="<?php  if(isset($name)){echo $name ;}?>" name="name" class="form-control" placeholder=" Enter your name"/>

      </div>

               <div class="form-group">
                 <label for ="title">

                    message : *
                 </label>

                  <textarea   name="message" class="form-control" cols="30" rows="10"><?php  if(isset($message)){echo $message ;}?></textarea>

      </div>


              <div class="row">

                  <div class="col-sm-6">
                      <div class="form-group">


                                  <label for ="link">

                                   phone : *
                                  </label>



                                  <input type="number"  id="phone"  value="<?php  if(isset($phone)){echo $phone ;}?>" name="phone" class="form-control" placeholder=" Enter Link"/>





      </div>
                  </div>
              </div>

               <div class="row">
                  <div class="col-sm-6">
                      <div class="form-group">

                                  <label for ="link">

                                  date : *
                                  </label>



                                  <input type="date"  id="date"  value="<?php  if(isset($date_book)){echo $date_book ;}?>" name="date_book" class="form-control" placeholder=" Enter Link"/>



      </div>
                  </div>

              </div>




              <input type="submit" value="Add booking" name="submit" class="btn btn-primary"/>



  </form>

    </div>

</div>
  </div>


  </div>

    </div>


    </div>
