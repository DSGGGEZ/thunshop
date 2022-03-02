<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $storename = $_POST['storename'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    // Prepare sql and bind parameters
    $sql = "INSERT INTO branch_store(storename,address,city) VALUES(?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sss', $storename,$address,$city,);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: store.php');
    
    exit();
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <title>Thun's shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">

    <h1>Thun's shop: <small>Add Branch Store</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="storename">Storename</label>
            <input type="text" name="storename" class="form-control">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control">
        </div>
        <input class="btn btn-primary" type="submit" value="Add Product"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>