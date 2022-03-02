<?php
require('lock.php');
require('../dbconnect.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the posted data
    $idproduct = $_POST['idproduct'];
    $idbranch_store = $_POST['idbranch_store'];
    $idcustomer = $_POST['idcustomer'];
    $date = $_POST['date'];

    // Prepare sql and bind parameters
    $sql = "INSERT INTO customer_order(idproduct,idbranch_store,idcustomer,date) VALUES(?,?,?,?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param('iiis', $idproduct,$idbranch_store,$idcustomer,$date);
    $result = $statement->execute();

    // Execute sql and check for failure
    if (!$result) {
        die('Execute failed: ' . $statement->error);
    }

    // Redirect
    header('Location: order.php');
    
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

    <h1>Thun's shop: <small>Add Order</small></h1>
    <form method="post" class="form">
        <div class="form-group">
            <label for="idproduct">Product</label>
            <select name="idproduct" class="form-control" value="<?php echo $row['idbranch_store'] ?>" required>
                <?php
                $idproduct = $conn->query('select idproduct, spec from product');
                while($row = $idproduct->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['idproduct'] ?>"><?php echo $row['spec'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="idbranch_store">Branch Store Name</label>
            <select name="idbranch_store" class="form-control" value="<?php echo $row['idbranch_store'] ?>" required>
                <?php
                $idbranch_store = $conn->query('select idbranch_store, storename from branch_store');
                while($row = $idbranch_store->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['idbranch_store'] ?>"><?php echo $row['storename'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="spec">Customer Name</label>
            <select name="idcustomer" class="form-control" value="<?php echo $row['idcustomer'] ?>" required> 
                <?php
                $idcustomer = $conn->query('select idcustomer, name from customer');
                while($row = $idcustomer->fetch_assoc()) {
                    ?>
                    <option value="<?php echo $row['idcustomer'] ?>"><?php echo $row['name'] ?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control">
        </div>
        <input class="btn btn-primary" type="submit" value="Add Product"> 
        <a href="order.php" class="btn btn-default">Cancel</a>
    </form>
    <?php
        $conn->close();
    ?>
</body>
</html>