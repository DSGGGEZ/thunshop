<?php
require('lock.php');
require('../dbconnect.php');

$idcustomer_order = $_GET['idcustomer_order'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Prepare sql and bind parameters
    $sql = "delete from customer_order where idcustomer_order = ?";
    $statement = $conn->prepare($sql);
    $statement->bind_param('i', $idcustomer_order);
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

    <h1>Thun's shop: <small>Delete Order</small></h1>

    <?php
    $name = $conn->query("SELECT customer.name FROM customer_order LEFT JOIN customer ON customer.idcustomer=customer_order.idcustomer LEFT JOIN product ON product.idproduct=customer_order.idproduct LEFT JOIN branch_store ON branch_store.idbranch_store = customer_order.idbranch_store WHERE customer_order.idcustomer_order = '$idcustomer_order'");
    $row = $name->fetch_assoc();
    ?>
    <p>Are you sure you want to delete order of '<?php echo $row['name'] ?>'?</p>

    <form method="post" class="form">
        <input class="btn btn-danger" type="submit" value="Delete">
        <a href="order.php" class="btn btn-default">Cancel</a>
    </form>

<?php
$conn->close();
?>
</body>
</html>