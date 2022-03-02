<?php
require('lock.php');
require('../dbconnect.php');

$idproduct = $_GET['idproduct'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $brand = $_POST['brand'];
    $producttype = $_POST['producttype'];
    $spec = $_POST['spec'];
    $price = $_POST['price'];

    // Prepare sql and bind parameters
    $sql = "UPDATE product SET brand = ? , producttype =? , spec = ? , price = ? WHERE idproduct = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssii', $brand,$producttype,$spec,$price,$idproduct);
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
    <?php
        $sql = "select * from product where idproduct = '$idproduct'";
        $res = $conn->query($sql);
        $line = $res->fetch_assoc();
    ?>
    <h1>Thun's shop<small>Edit Product</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="brand">Brand</label>
            <input type="text" name="brand" class="form-control" value="<?php echo $line['brand'] ?>">
        </div>
        <div class="form-group">
            <label for="producttype">Type</label>
            <input type="text" name="producttype" class="form-control" value="<?php echo $line['producttype'] ?>">
        </div>
        <div class="form-group">
            <label for="spec">Spec</label>
            <input type="text" name="spec" class="form-control" value="<?php echo $line['spec'] ?>">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" name="price" class="form-control" value="<?php echo $line['price'] ?>">
        </div>
        <input class="btn btn-primary" type="submit" value="Edit Product"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>