<?php
    require('dbconnect.php');
    require('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Thun's shop : Order</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body class="container">
<?php
$name = isset($_GET['name']) ? $_GET['name'] : "";
if ($name != "") {
    $sql = "SELECT * FROM customer_order LEFT JOIN customer ON customer.idcustomer=customer_order.idcustomer LEFT JOIN product ON product.idproduct=customer_order.idproduct LEFT JOIN branch_store ON branch_store.idbranch_store = customer_order.idbranch_store WHERE customer.name = '$name'";
}
else {
    $sql = "SELECT * FROM customer_order LEFT JOIN customer ON customer.idcustomer=customer_order.idcustomer LEFT JOIN product ON product.idproduct=customer_order.idproduct LEFT JOIN branch_store ON branch_store.idbranch_store = customer_order.idbranch_store";
}
    $results = $conn->query($sql);
?>

    <h1>Order</h1>
    <form method="get" class="form-inline">
        Customer: &nbsp;
        <input type="text" name="name" class="form-control" placeholder="name">
        <input class="btn btn-primary" type="submit" value="Filter">
    </form>

    <table class="table table-bordered" style="margin-top: 20px">
        <thead>
            <tr>
                <th>Product</th>
                <th>Store</th>
                <th>Customer Name</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $results->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['spec'] ?></td>
                <td><?php echo $row['storename'] ?></td>
                <td><?php echo $row['name'] ?></td>
                <td><?php echo $row['date'] ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
<?php
require('footer.php');
?>
</body>
</html>