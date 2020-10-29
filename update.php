<?php
// Include config file
require_once "db.php";

// Define variables and initialize with empty values
$name = $phone = $message=$date_book = "";
$name_err = $phone_err = $message_err= $date_book_err= "";

// Processing form data when form is submitted
if(isset($_POST["book_id"]) && !empty($_POST["book_id"])){
    // Get hidden input value
    $book_id = $_POST["book_id"];

    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Please enter a valid name.";
    } else{
        $name = $input_name;
    }

    // Validate address
    $input_phone = trim($_POST["phone"]);
    if(empty($input_phone)){
        $phone_err = "Please enter an phone.";
    } else{
        $phone = $input_phone;
    }

    // Validate salary
    $input_message = trim($_POST["message"]);
    if(empty($input_message)){
        $message_err = "Please enter the salary amount.";
    } elseif(!ctype_digit($input_message)){
        $message_err = "Please enter a positive integer value.";
    } else{
        $message = $input_message;
    }
    $input_date = trim($_POST["date_book"]);
    if(empty($input_date)){
          $date_err = "Please enter the salary amount.";
    } elseif(!ctype_digit($input_date)){
        $date_err = "Please enter a positive integer value.";
    } else{
        $date_book =$input_date;
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($phone_err) && empty($message_err)){
        // Prepare an update statement
        $sql = "UPDATE books SET name=?, phone=?, message=?,date_book=? WHERE book_id=?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_phone, $param_message,$param_date_book, $param_id);

            // Set parameters
            $param_name = $name;
            $param_phone = $phone;
            $param_message = $message;
            $param_date_book=$date_book;
            $param_id = $book_id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["book_id"]) && !empty(trim($_GET["book_id"]))){
        // Get URL parameter
        $book_id =  trim($_GET["book_id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM books WHERE book_id= ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $book_id;

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);

                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    // Retrieve individual field value
                    $name = $row["name"];
                    $phone = $row["phone"];
                    $message = $row["message"];
                    $date_book=$row["date_book"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }

            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
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
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>

                        <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                            <label>phone</label>
                            <input type="number" name="phone" class="form-control" value="<?php echo $phone; ?>">
                            <span class="help-block"><?php echo $phone_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($date_book_err)) ? 'has-error' : ''; ?>">
                            <label>date</label>
                            <input type="date" name="date_book" class="form-control" value="<?php echo $phone; ?>">
                            <span class="help-block"><?php echo $date_book_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($message_err)) ? 'has-error' : ''; ?>">
                            <label>message</label>
                            <textarea name="message" class="form-control"><?php echo $message; ?></textarea>
                            <span class="help-block"><?php echo $message_err;?></span>
                        </div>


                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
