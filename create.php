<?php
// Include config file
require_once "db.php";

// Define variables and initialize with empty values
$name = $date_book = $phone = $message= "";
$name_err = $phone_err = $date_err=$massage_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
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
        $phone_err = "Please enter an address.";
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
    $input_date = trim($_POST["date"]);
    if(empty($input_salary)){
          $date_err = "Please enter the salary amount.";
    } elseif(!ctype_digit($input_salary)){
        $date_err = "Please enter a positive integer value.";
    } else{
        $date_book =$input_date;
    }
    // Check input errors before inserting in database
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO books(name, phone, date_book,message) VALUES (?, ?, ?,?,?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_phone, $param_date,$param_message);

            // Set parameters
            $param_name = $name;
            $param_phone = $phone;
            $param_date = $date;
           $param_message = $message;
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>

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
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                            <label>phone</label>
                        <input type="number" name="phone" class="form-control" value="<?php echo $name; ?>">
                            <span class="help-block"><?php echo $phone_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($date_err)) ? 'has-error' : ''; ?>">
                            <label>date</label>
                            <input type="date" name="date" class="form-control" value=" ">
                            <span class="help-block"><?php echo $date_err;?></span>
                        </div>
                        <div class="form-group">
              <label for="exampleInputEmail1">Message :</label>
              <textarea   name="message" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>
              </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
