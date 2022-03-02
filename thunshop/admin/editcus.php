<?php
require('lock.php');
require('../dbconnect.php');

$idcustomer = $_GET['idcustomer'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];

    // Prepare sql and bind parameters
    $sql = "UPDATE customer SET name = ? , address =? , city = ? WHERE idcustomer = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('sssi', $name,$address,$city,$idcustomer);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: index.php');
    
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
        $sql = "select * from customer where idcustomer = '$idcustomer'";
        $res = $conn->query($sql);
        $line = $res->fetch_assoc();
    ?>
    <h1>Thun's shop<small>Edit Branch Store</small></h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="name">Customer Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $line['name'] ?>">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo $line['address'] ?>">
        </div>
        <div class="form-group">
            <label for="city">City</label>
            <input type="text" name="city" class="form-control" value="<?php echo $line['city'] ?>">
        </div>
        <input class="btn btn-primary" type="submit" value="Edit Customer"> 
        <a href="index.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>