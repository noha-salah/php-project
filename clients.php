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

<?php

if(isset($_GET['del'])){
    $del_id=$_GET['del'];
//     if($_SESSION['role']=='Admin' ){
  $queryu="SELECT * FROM books WHERE `book_id` ='$del_id'";
  $runu= mysqli_query($link,$queryu);
//  }
//    else if($_SESSION['role']!='Admin'){
//      $queryu ="SELECT * FROM posts WHERE `id` ='$del_id' AND `author ='$session_username'";
//      $runu = mysqli_query($connection, $queryu);
////  }
  if(mysqli_num_rows($runu) > 0){


    $del_query="DELETE FROM `books` WHERE `books`.`book_id` = $del_id";


         if(mysqli_query($link,$del_query))
         {
       $msg= "book  delete";

    }
 else {
     $error1="no delete";
    }

}
 else {
       header('location:index.php');
  }
}
?>
</head>
<body>
    <div id="wrapper">




  <div class="container fluild body-section">
  <div class="row">
  <div class="col-md-3">

  </div>
  <div class="col-md-9">

  <h1><i class="fa fa-image"></i> carousel  <small>View All carousel  </small></h1><hr>
  <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-tachometer"></i> Dashboard</a></li>


</ol>

  <div class="row">

      <div class="col-sm-8">
          <form action="" method="post">
              <div class="row">
                  <div class="col-xs-4">
                      <div class="form-group">
                          <select name="bulk-option"  id ="k" class="form-control">

                              <option value="delete">Delete </option>


                          </select>


                      </div>




                  </div>


                  <div class="col-xs-8">

                         <input type="submit"  class="btn btn-success" value="Apply" name="submit"/>
                         <a   href="add-car.php" class="btn btn-primary"  > Add Image  </a>


                  </div>


              </div>




      </div>
  </div>
    <?php
//  if($_SESSION['role']=='Admin' ){
  $queryu="SELECT * FROM books ";
  $runu= mysqli_query($link,$queryu);
//  }


  if(mysqli_num_rows($runu) >0)
  {



  ?>
  <?php


  if(isset($error1))
  {


        echo "<div class='alert alert-danger' role='alert'> $error1 </div>";
  }
      else if (isset($msg)) {
           echo "<div class='alert alert-success' role='alert'> $msg </div>";


      }
  ?>
  <table class="table table-bordered table-hover table-striped">
      <thead>
          <tr>
              <th> <input type="checkbox" id="selectallboxes"></th>
              <th> #</th>

               <th> name</th>
               <th>phone </th>
               <th>date </th>

               <th>message</th>


                    <th>Edit</th>
                     <th>Del</th>



          </tr>
      </thead>
      <tbody>
          <?php
            while ($rowu = mysqli_fetch_array($runu)) {
           $book_id = $rowu['book_id'];


           $name=$get_row['name'];

           $phone=$get_row['phone'];
           $date_book=$get_row['date_book'];
           $message=$get_row['message'];


        ?>
          <tr>

              <td><?php echo $book_id ;?></td>

                <td><?php echo ucfirst($name) ;?></td>
                    <td><?php echo ucfirst($phone) ;?></td>
                        <td><?php echo ucfirst($date_book) ;?></td>
                <td><?php echo ucfirst($message) ;?></td>




                  <td> <a href="edit_client.php?edit=<?php  echo $book_id;  ?>"><i class="fa fa-pencil"></i></a></td>
              <td> <a   data-toggle="modal" data-target="#car<?php echo $book_id;?>" href=""><i class="fa fa-times"></i></a></td>




          </tr>
            <div class="modal fade" id="car<?php echo  $book_id;?>" role="dialog">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete book </h4>
        </div>
        <div class="modal-body">
          <p style="color:red;">Are You Sure Delete ...?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>


          <a  class="btn btn-danger" href="client.php?del=<?php  echo $book_id ;?>"  >Delete</a>

      </div>
    </div>
  </div>
</div>

            <?php }?>
      </tbody>

  </table>
  <?php

    }else {

      echo "<center> <h2 class='alert alert-info' role='alert'>  NO  Pages  Available NOW  ...</h2></center>";


  }

  ?>
    </form>
  </div>
    </div>
  </div>




    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

</body>


    </html>
