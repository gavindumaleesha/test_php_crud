<?php

    $servername = "localhost";
    $username = 'root';
    $password = "";
    $database = "myshop";

    // make db connection
    $connection = new mysqli($servername,$username,$password,$database);

    $name = "";
    $email = "";
    $phone = "";
    $address = "";


    $errorMessage = "";
    $successMessage = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)){
            $errorMessage = "Fill All Fields";
            break;
        }

        //add new client to DB

        $sql = "INSERT INTO clients (name,email,phone,address )".
            "VALUES ('$name','$email','$phone','$address')";
            $result = $connection->query($sql);

            if(!$result){ // Corrected from if(!result)
                $errorMessage = 'Invalid Query: '. $connection->error;
                break;
        }


        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $successMessage = "Client added correctly";
        if (!headers_sent()) {
            header('Location: /myshop/index.php');
            exit;
        } else {
            echo '<script>window.location.href="/myshop/index.php";</script>';
            exit;
        }
        
    } while(false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Client</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"/>
</head>
<body>
<div class="container my-5">
    <h2>Add New User</h2>

    <?php
    if(!empty($errorMessage)){
        echo "$errorMessage";
    }
    ?>

    <form method='post'>
        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="email" value="<?php echo $email; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Phone</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Address</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
            </div>
        </div>

        <?php
        if(!empty($successMessage)){
            echo "$successMessage";
        }
        ?>

        <div class="row mb-3">
            <div class="offset-sm-3 col-sm-3 d-grid">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

            <div class="col-sm-3 d-grid">
                <a class="btn btn-outline-primary" href="/myshop/index.php" role="button">Cancel</a>
            </div>
        </div>
    </form>
</div>
</body>
</html>
