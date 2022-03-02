<?php
require('lock.php');
require('../dbconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $brand = $_POST['brand'];
    $producttype = $_POST['producttype'];
    $spec = $_POST['spec'];
    $price = $_POST['price'];

    // Prepare sql and bind parameters
    $sql = "INSERT INTO product(brand,producttype,spec,price) VALUES(?,?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssi', $brand,$producttype,$spec,$price);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: product.php');
    
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

    <h1>Thun's shop: <small>Add Product</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" name="brand" class="form-control">
        </div>
        <div class="form-group">
            <label for="producttype">Type</label>
            <input type="text" name="producttype" class="form-control">
        </div>
        <div class="form-group">
            <label for="spec">Spec</label>
            <input type="text" name="spec" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control">
        </div>
        <input class="btn btn-primary" type="submit" value="Add Product"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>